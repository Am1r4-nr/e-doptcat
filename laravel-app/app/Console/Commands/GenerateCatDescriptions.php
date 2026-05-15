<?php

namespace App\Console\Commands;

use App\Models\Cat;
use App\Services\OpenAIService;
use Illuminate\Console\Command;

class GenerateCatDescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ai:generate-descriptions {--all : Generate for all cats} {--cat-id= : Generate for specific cat}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate cat descriptions using OpenAI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $openaiService = new OpenAIService();

        if ($this->option('cat-id')) {
            $cat = Cat::find($this->option('cat-id'));
            if (!$cat) {
                $this->error('Cat not found');
                return 1;
            }
            $cats = [$cat];
        } elseif ($this->option('all')) {
            $cats = Cat::all();
        } else {
            $cats = Cat::whereNull('description')->orWhere('description', '')->get();
        }

        if ($cats->isEmpty()) {
            $this->info('No cats to generate descriptions for.');
            return 0;
        }

        $this->info("Generating descriptions for {$cats->count()} cat(s)...");
        $bar = $this->output->createProgressBar($cats->count());

        $updated = 0;
        $errors = [];

        foreach ($cats as $cat) {
            try {
                $description = $openaiService->generateCatDescription(
                    $cat->name,
                    $cat->breed ?? 'Unknown',
                    $cat->color ?? 'Unknown',
                    $cat->description
                );

                $cat->update(['description' => $description]);
                $updated++;
            } catch (\Exception $e) {
                $errors[] = [
                    'cat' => $cat->name,
                    'error' => $e->getMessage(),
                ];
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("✅ Successfully updated {$updated} cat(s)");

        if (!empty($errors)) {
            $this->newLine();
            $this->error('Errors occurred:');
            foreach ($errors as $error) {
                $this->line("  • {$error['cat']}: {$error['error']}");
            }
        }

        return 0;
    }
}

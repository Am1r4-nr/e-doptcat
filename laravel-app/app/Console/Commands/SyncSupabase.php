<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SyncSupabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:sync-supabase {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize local MySQL database data to Supabase PostgreSQL database';

    /**
     * The list of tables to synchronize in dependency order.
     *
     * @var array
     */
    protected array $tables = [
        'users',
        'cache',
        'jobs',
        'messages',
        'cats',
        'adoptions',
        'events',
        'donations',
        'reports',
        'event_registrations',
        'incidents',
        'gps_devices',
        'gps_location_histories',
        'user_ai_preferences',
        'adoption_feedback',
        'volunteers',
        'expenses',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('==================================================');
        $this->info('      E-doptcat Supabase Database Synchronizer     ');
        $this->info('==================================================');

        // 1. Test database connections
        $this->info('Checking database connections...');

        try {
            DB::connection('mysql')->getPdo();
            $this->info('✓ Local MySQL connection: OK');
        } catch (\Exception $e) {
            $this->error('✗ Local MySQL connection failed: ' . $e->getMessage());
            return 1;
        }

        try {
            DB::connection('supabase')->getPdo();
            $this->info('✓ Supabase PostgreSQL connection: OK');
        } catch (\Exception $e) {
            $this->error('✗ Supabase PostgreSQL connection failed: ' . $e->getMessage());
            return 1;
        }

        // 2. Prepare summary and count rows
        $this->newLine();
        $this->info('Analyzing local MySQL database tables...');

        $summary = [];
        $totalRows = 0;

        foreach ($this->tables as $table) {
            if (!Schema::connection('mysql')->hasTable($table)) {
                $this->warn("  • Table '{$table}' does not exist in local MySQL. Skipping.");
                continue;
            }

            $count = DB::connection('mysql')->table($table)->count();
            $summary[] = [
                'table' => $table,
                'rows' => $count,
            ];
            $totalRows += $count;
        }

        // Display summary table
        $this->table(['Table Name', 'Rows to Sync'], $summary);
        $this->info("Total rows to synchronize: {$totalRows}");
        $this->newLine();

        // 3. Confirm operation
        if (!$this->option('force')) {
            if (!$this->confirm('WARNING: This will empty the listed tables in Supabase and replace them with your local MySQL data. Do you want to continue?', false)) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        // 4. Perform synchronization
        $this->info('Starting database synchronization...');
        $progressBar = $this->output->createProgressBar(count($summary));
        $progressBar->start();

        foreach ($summary as $item) {
            $table = $item['table'];
            $rowCount = $item['rows'];

            try {
                // A. Clear table on Supabase using CASCADE to handle foreign key dependencies cleanly
                DB::connection('supabase')->statement("TRUNCATE TABLE \"{$table}\" CASCADE;");

                // B. Sync data in chunks if there are rows
                if ($rowCount > 0) {
                    DB::connection('mysql')->table($table)->orderBy('id')->chunk(200, function ($chunk) use ($table) {
                        $insertData = [];
                        foreach ($chunk as $row) {
                            $rowArray = (array)$row;
                            
                            // PostgreSQL boolean conversion safety check
                            // Standard MySQL tinyint(1) fields might have 0/1, let's cast them to actual booleans
                            foreach ($rowArray as $column => $value) {
                                if (($table === 'cats' && $column === 'vaccinated') || 
                                    ($table === 'adoptions' && $column === 'ai_match_score') || // score is int, not bool, don't touch
                                    (is_bool($value))
                                ) {
                                    if ($column === 'vaccinated') {
                                        $rowArray[$column] = (bool)$value;
                                    }
                                }
                            }
                            
                            $insertData[] = $rowArray;
                        }

                        DB::connection('supabase')->table($table)->insert($insertData);
                    });
                }

                // C. Reset the serial sequence in PostgreSQL so subsequent inserts don't collision on primary key
                if (Schema::connection('supabase')->hasColumn($table, 'id')) {
                    // Check if there are rows to reset sequence to, otherwise reset to 1
                    if ($rowCount > 0) {
                        DB::connection('supabase')->statement("SELECT setval(pg_get_serial_sequence('{$table}', 'id'), coalesce(max(id), 1)) FROM \"{$table}\";");
                    } else {
                        // Reset empty table sequence to 1
                        DB::connection('supabase')->statement("ALTER SEQUENCE \"{$table}_id_seq\" RESTART WITH 1;");
                    }
                }

            } catch (\Exception $e) {
                $this->newLine();
                $this->error("✗ Error syncing table '{$table}': " . $e->getMessage());
                if (!$this->confirm('Do you want to continue syncing other tables?', true)) {
                    $this->info('Synchronization aborted.');
                    return 1;
                }
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->newLine();
        $this->info('==================================================');
        $this->info('🎉 SUCCESS: Database synchronization completed! 🎉');
        $this->info('==================================================');

        return 0;
    }
}

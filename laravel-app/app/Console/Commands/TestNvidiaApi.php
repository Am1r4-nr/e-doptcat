<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestNvidiaApi extends Command
{
    protected $signature = 'test:nvidia';
    protected $description = 'Test Nvidia API connection';

    public function handle()
    {
        $apiKey = env('NVIDIA_API_KEY');
        $apiBase = env('NVIDIA_API_BASE', 'https://api.nim.nvidia.com');
        $model = env('NVIDIA_MODEL', 'meta-llama/llama-2-7b');

        $this->info('=== Testing Nvidia API ===');
        $this->info('API Key: ' . substr($apiKey, 0, 20) . '...');
        $this->info('API Base: ' . $apiBase);
        $this->info('Model: ' . $model);
        $this->newLine();

        $testPrompt = "What is 2+2? Answer briefly.";
        
        $this->info('Sending test prompt: "' . $testPrompt . '"');
        $this->info('Making request to: ' . $apiBase . '/v1/completions');
        $this->newLine();

        try {
            $response = Http::withToken($apiKey)
                ->timeout(30)
                ->post($apiBase . '/v1/completions', [
                    'model' => $model,
                    'prompt' => $testPrompt,
                    'max_tokens' => 100,
                    'temperature' => 0.7,
                ]);

            $this->info('Status: ' . $response->status());
            $this->info('Successful: ' . ($response->successful() ? 'YES ✓' : 'NO ✗'));
            $this->newLine();
            
            $this->info('Full Response Body:');
            $this->line($response->body());
            
            if ($response->successful()) {
                $data = $response->json();
                $this->newLine();
                $this->info('Parsed JSON:');
                $this->line(json_encode($data, JSON_PRETTY_PRINT));
                
                if (isset($data['choices'][0]['text'])) {
                    $this->newLine();
                    $this->info('✓ Got response from API!');
                    $this->line('Response: ' . $data['choices'][0]['text']);
                }
            } else {
                $this->error('API returned error: ' . $response->status());
            }
        } catch (\Exception $e) {
            $this->error('ERROR: ' . $e->getMessage());
            $this->error('Code: ' . $e->getCode());
            $this->error('Trace: ' . $e->getTraceAsString());
        }
    }
}

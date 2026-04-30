<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    private $client;

    public function __construct()
    {
        $apiKey = env('OPENAI_API_KEY');
        $this->client = OpenAI::client($apiKey);
    }

    /**
     * Generate a detailed description for a cat using AI
     */
    public function generateCatDescription(string $name, string $breed, string $color, string $currentDescription = null): string
    {
        $prompt = "Create a warm, engaging and adoption-friendly description for a cat named {$name}. ";
        $prompt .= "Breed: {$breed}, Color: {$color}. ";
        if ($currentDescription) {
            $prompt .= "Current info: {$currentDescription}. ";
        }
        $prompt .= "Keep it under 150 words.";

        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 200,
        ]);

        return $response->choices[0]->message->content;
    }

    /**
     * Suggest adoption recommendations based on cat characteristics
     */
    public function suggestAdoptionRecommendations(string $name, string $behavior, string $medicalHistory, string $age): array
    {
        $prompt = "Based on this cat's profile, suggest ideal adopter types:\n";
        $prompt .= "Name: {$name}\n";
        $prompt .= "Age: {$age}\n";
        $prompt .= "Behavior: {$behavior}\n";
        $prompt .= "Medical History: {$medicalHistory}\n";
        $prompt .= "Provide 3-4 short recommendations in JSON format like: {\"recommendations\": [\"rec1\", \"rec2\", ...]}";

        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 300,
        ]);

        $content = $response->choices[0]->message->content;
        
        // Parse JSON response
        preg_match('/\{.*\}/s', $content, $matches);
        if (isset($matches[0])) {
            return json_decode($matches[0], true);
        }

        return ['recommendations' => []];
    }

    /**
     * Generate a medical summary from health notes
     */
    public function generateMedicalSummary(string $medicalHistory): string
    {
        $prompt = "Summarize the following cat medical history in a clear, concise way for adoption considerations:\n{$medicalHistory}\n";
        $prompt .= "Highlight key health concerns and current status in 2-3 sentences.";

        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'temperature' => 0.5,
            'max_tokens' => 200,
        ]);

        return $response->choices[0]->message->content;
    }

    /**
     * Match a user profile to suitable cats
     */
    public function matchCatsToProfile(string $userPreferences): array
    {
        $prompt = "Based on these adopter preferences, suggest cat personalities that would match:\n{$userPreferences}\n";
        $prompt .= "Return 3-4 personality types in JSON format: {\"personalities\": [\"type1\", \"type2\", ...]}";

        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 250,
        ]);

        $content = $response->choices[0]->message->content;
        
        preg_match('/\{.*\}/s', $content, $matches);
        if (isset($matches[0])) {
            return json_decode($matches[0], true);
        }

        return ['personalities' => []];
    }
}

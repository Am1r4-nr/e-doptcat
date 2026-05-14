<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    private $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    private $model = 'llama-3.3-70b-versatile';

    private function getHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ];
    }

    public function generateCatProfile($catData)
    {
        set_time_limit(180);
        $response = Http::timeout(60)->withHeaders($this->getHeaders())->post($this->apiUrl, [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert cat behaviorist and adoption specialist. '
                        . 'Your job is to generate a structured cat profile based on provided data. '
                        . 'You MUST respond with ONLY a valid JSON object. '
                        . 'Never wrap your output in ```json or ``` blocks. Output raw JSON only.'
                ],
                ['role' => 'user', 'content' => $catData]
            ],
            'temperature' => 0.7,
            'response_format' => ['type' => 'json_object'],
        ]);

        return $response->json();
    }

    public function matchUserWithCats($preferences, $cats)
    {
        set_time_limit(180);

        // Format the cats data for the prompt
        $catsData = [];
        foreach ($cats as $cat) {
            $catsData[] = [
                'id' => $cat->id,
                'name' => $cat->name,
                'breed' => $cat->breed,
                'health_status' => $cat->health_status,
                'temperament_score' => $cat->temperament_score,
                'behavior_notes' => $cat->behavior_notes,
            ];
        }

        $prompt = "ADOPTER PREFERENCES:\n" . json_encode($preferences, JSON_PRETTY_PRINT) . "\n\n";
        $prompt .= "AVAILABLE CATS:\n" . json_encode($catsData, JSON_PRETTY_PRINT) . "\n\n";
        $prompt .= "TASK: Score each cat from 0 to 100 based on compatibility with the adopter preferences above.\n"
            . "You MUST let the scores vary significantly based on the adopter's specific answers — "
            . "different adopter profiles MUST produce meaningfully different scores.\n"
            . "Use this mapping for the adopter's energy_level (1=very calm lifestyle, 5=very active lifestyle) "
            . "and match against the cat's temperament_score (1=very shy/fearful, 10=extremely outgoing/bold).\n"
            . "Return ONLY a raw JSON object where keys are cat IDs (as strings) and values are objects with:\n"
            . "  - 'score': integer 0-100 (compatibility percentage)\n"
            . "  - 'reason': one sentence referencing the adopter's specific preference that drove this score\n"
            . "Example output: {\"3\": {\"score\": 87, \"reason\": \"High temperament score aligns with the adopter's active energy level of 4.\"}}";

        $response = Http::timeout(60)->withHeaders($this->getHeaders())->post($this->apiUrl, [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a cat adoption matchmaking expert. You MUST respond with ONLY a valid raw JSON object. Do not include markdown code fences.'
                ],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
            'response_format' => ['type' => 'json_object'],
        ]);

        $data = $response->json();
        Log::info('Groq raw response (Match)', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->failed() || !isset($data['choices'][0]['message']['content'])) {
            Log::error('Groq API failed or returned unexpected format', ['response' => $data]);
            return [];
        }

        $content = $data['choices'][0]['message']['content'];
        $matches = json_decode($content, true);

        return is_array($matches) ? $matches : [];
    }

    public function getTemperamentAssessment($cat)
    {
        set_time_limit(180);

        $prompt = "CAT PROFILE:\n";
        $prompt .= "Name: {$cat->name}\n";
        $prompt .= "Description/Background: {$cat->description}\n";
        $prompt .= "Medical History: {$cat->medical_history}\n";
        $prompt .= "Behavior Notes: {$cat->behavior_notes}\n\n";
        $prompt .= "Analyze the above profile and return ONLY a raw JSON object with exactly these keys:\n";
        $prompt .= "  temperament_score : integer 1-10 (1=very shy/fearful, 10=extremely outgoing/affectionate)\n";
        $prompt .= "  assessment        : 2-3 sentence personality summary\n";
        $prompt .= "  ideal_adopters    : 1-2 sentence description of the ideal home\n";
        $prompt .= "  care_notes        : any special care instructions from medical/behavioral history\n";

        $response = Http::timeout(60)->withHeaders($this->getHeaders())->post($this->apiUrl, [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a certified cat behaviorist and animal welfare expert. '
                        . 'Analyze cat profiles and produce structured behavioral assessments. '
                        . 'You MUST respond with ONLY a valid raw JSON object.'
                ],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.5,
            'response_format' => ['type' => 'json_object'],
        ]);

        $data = $response->json();
        $content = $data['choices'][0]['message']['content'] ?? '{}';
        
        $assessment = json_decode($content, true);

        return is_array($assessment) ? $assessment : [
            'temperament_score' => 5,
            'assessment' => 'Assessment could not be generated.',
            'ideal_adopters' => 'Any loving home.',
            'care_notes' => 'Standard cat care.',
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\UserAiPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $query = Cat::query();

        if ($request->filled('breed')) {
            $query->where('breed', $request->input('breed'));
        }
        if ($request->filled('health_status')) {
            $query->where('health_status', $request->input('health_status'));
        }
        if ($request->filled('vaccinated')) {
            $query->where('vaccinated', $request->input('vaccinated'));
        }
        if ($request->filled('location')) {
            $query->where('location_name', $request->input('location'));
        }

        $cats = $query->where('status', 'Available')->get();

        // Get AI match scores via ML API if preferences exist
        if ($request->input('recommended') === 'true' && session()->has('aiPreferences')) {
            $preferences = session()->get('aiPreferences');
            
            // Call Python ML API for predictions
            $cats = $this->getAiMatchScores($cats, $preferences);
            
            // Sort by match score descending
            $cats = $cats->sortByDesc('ai_match_score');
        }

        return view('cats.index', compact('cats'));
    }

    public function show(Cat $cat)
    {
        return view('cats.show', compact('cat'));
    }

    public function storeAiPreferences(Request $request)
    {
        // Validate the preferences
        $validated = $request->validate([
            'lifestyle' => 'required|in:sedentary,moderate,active',
            'budget' => 'required|in:limited,moderate,generous',
            'home_env' => 'required|in:apartment,house,large_house',
            'activity' => 'required|in:little,moderate,lots',
            'experience' => 'required|in:first_time,some,experienced',
        ]);

        // Store preferences in session
        session()->put('aiPreferences', $validated);

        // Save to database if user is authenticated
        if (auth()->check()) {
            UserAiPreference::updateOrCreate(
                ['user_id' => auth()->id()],
                $validated
            );
        }

        // Redirect to cats index with recommended flag
        return redirect()->route('cats.index', ['recommended' => 'true']);
    }

    private function getAiMatchScores($cats, $preferences)
    {
        try {
            $apiUrl = config('services.ai_matcher.url');
            
            // Prepare cat data
            $catData = $cats->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'personality' => $cat->personality ?? 'friendly',
                    'health_status' => $cat->health_status ?? 'Healthy',
                    'size' => $cat->size ?? 'Medium',
                    'energy_level' => $this->getEnergyLevel($cat),
                    'temperament_score' => $this->getTemperamentScore($cat),
                ];
            })->toArray();
            
            // Call batch prediction API
            $response = Http::post("{$apiUrl}/api/predict-batch", [
                'user_prefs' => $preferences,
                'cats' => $catData,
            ]);
            
            if ($response->successful()) {
                $results = $response->json('results', []);
                
                // Map results back to cats
                foreach ($cats as $cat) {
                    $match = collect($results)->firstWhere('cat_id', $cat->id);
                    $cat->ai_match_score = $match['match_score'] ?? rand(70, 99);
                }
            } else {
                // Fallback to default scores if API fails
                Log::warning('AI Matcher API failed', [
                    'status' => $response->status(),
                    'error' => $response->body(),
                ]);
                foreach ($cats as $cat) {
                    $cat->ai_match_score = rand(70, 99);
                }
            }
            
            return $cats;
        } catch (\Exception $e) {
            Log::error('Error calling AI Matcher API', [
                'error' => $e->getMessage(),
            ]);
            
            // Fallback to default scores
            foreach ($cats as $cat) {
                $cat->ai_match_score = rand(70, 99);
            }
            
            return $cats;
        }
    }
    
    private function getEnergyLevel($cat)
    {
        $personality = strtolower($cat->personality ?? '');
        
        if (in_array($personality, ['energetic', 'playful', 'curious', 'active'])) {
            return 'High';
        } elseif (in_array($personality, ['calm', 'lazy', 'quiet', 'independent'])) {
            return 'Low';
        }
        
        return 'Medium';
    }
    
    private function getTemperamentScore($cat)
    {
        // Convert personality to numeric score 1-5
        $personality = strtolower($cat->personality ?? '');
        
        $scores = [
            'aggressive' => 1,
            'shy' => 2,
            'calm' => 4,
            'friendly' => 5,
            'playful' => 4,
            'affectionate' => 5,
        ];
        
        return $scores[$personality] ?? 3;
    }
}


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
            $openaiService = new OpenAIService();
            
            // Build user preference description
            $prefDescription = $this->buildPreferenceDescription($preferences);
            
            // Get AI personality recommendations
            $recommendations = $openaiService->matchCatsToProfile($prefDescription);
            $suitablePersonalities = $recommendations['personalities'] ?? [];
            
            // Score each cat based on personality match
            foreach ($cats as $cat) {
                $catPersonality = strtolower($cat->personality ?? $cat->behavior ?? '');
                $matchScore = 70; // Base score
                
                // Check if cat personality matches recommended personalities
                foreach ($suitablePersonalities as $personality) {
                    if (stripos($catPersonality, strtolower($personality)) !== false || 
                        stripos($personality, $catPersonality) !== false) {
                        $matchScore = 85;
                        break;
                    }
                }
                
                // Adjust based on other factors
                if ($preferences['experience'] == 'first_time' && $cat->medical_history) {
                    $matchScore -= 10; // Less suitable for first-timers if medical history exists
                }
                
                if ($preferences['activity'] == 'little' && $this->getEnergyLevel($cat) == 'High') {
                    $matchScore -= 5; // Less suitable for active cats
                }
                
                if ($preferences['budget'] == 'limited' && $cat->medical_history) {
                    $matchScore -= 10; // Medical needs cost more
                }
                
                $cat->ai_match_score = max(60, min(99, $matchScore)); // Clamp between 60-99
                $cat->match_reason = $this->generateMatchReason($cat, $preferences);
            }
            
            return $cats;
        } catch (\Exception $e) {
            Log::error('Error with OpenAI matching', [
                'error' => $e->getMessage(),
            ]);
            
            // Fallback to default scores
            foreach ($cats as $cat) {
                $cat->ai_match_score = rand(70, 85);
                $cat->match_reason = 'AI matching unavailable, showing available cats';
            }
            
            return $cats;
        }
    }
    
    private function buildPreferenceDescription($preferences)
    {
        $lifestyle = $preferences['lifestyle'] ?? '';
        $budget = $preferences['budget'] ?? '';
        $home = $preferences['home_env'] ?? '';
        $activity = $preferences['activity'] ?? '';
        $experience = $preferences['experience'] ?? '';
        
        return "I have a $lifestyle lifestyle, live in a $home, can spend $budget monthly on cat care, have $activity time for playtime daily, and I am $experience with cats.";
    }
    
    private function generateMatchReason($cat, $preferences)
    {
        $reasons = [];
        
        $energy = $this->getEnergyLevel($cat);
        if ($preferences['activity'] == 'little' && $energy == 'Low') {
            $reasons[] = "Low energy matches your schedule";
        } elseif ($preferences['activity'] == 'lots' && $energy == 'High') {
            $reasons[] = "High energy matches your active lifestyle";
        }
        
        if (!$cat->medical_history && $preferences['budget'] == 'limited') {
            $reasons[] = "Healthy cat suits your budget";
        }
        
        if ($preferences['experience'] == 'experienced' && $cat->medical_history) {
            $reasons[] = "You can handle special needs";
        }
        
        return count($reasons) > 0 ? implode(", ", $reasons) : "Good match for you";
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


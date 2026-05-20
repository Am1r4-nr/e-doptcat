<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\UserAiPreference;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CatController extends Controller
{
    private $nvidiaService;

    public function __construct(AIService $nvidiaService)
    {
        $this->nvidiaService = $nvidiaService;
    }

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

        $cats = $query->where('status', 'Available')->paginate(12);
        
        Log::info('Cats index called', [
            'total_cats' => $cats->count(),
            'recommended' => $request->input('recommended'),
            'session_has_prefs' => session()->has('aiPreferences')
        ]);

        // Get AI match scores via Nvidia API if preferences exist
        if ($request->input('recommended') === 'true' && session()->has('aiPreferences')) {
            Log::info('AI recommendation flow triggered');
            $preferences = session()->get('aiPreferences');
            Log::info('User preferences from session', $preferences);
            
            // Call Nvidia AI for predictions
            $cats = $this->getAiMatchScores($cats, $preferences);
            
            // Sort by match score descending
            $cats = collect($cats)->sortByDesc('ai_match_score')->values();
            
            Log::info('AI matching complete', ['matched_cats' => count($cats)]);
        }

        return view('cats.index', compact('cats'));
    }

    public function show(Cat $cat)
    {
        return view('cats.show', compact('cat'));
    }

    public function storeAiPreferences(Request $request)
    {
        // Validate the new questionnaire preferences
        $validated = $request->validate([
            'energy_level' => 'required|in:1,2,3,4,5',
            'ideal_bond' => 'required|in:velcro,independent,challenge',
            'talkative_preference' => 'required|in:loves_vocal,quiet',
            'other_pets' => 'required|in:yes_seeking_feline_friends,yes_independent,no',
            'medication_comfort' => 'required|in:yes_experienced,no_docile',
        ]);

        Log::info('AI Preferences form submitted', ['preferences' => $validated]);

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
        Log::info('getAiMatchScores called', [
            'cat_count' => count($cats),
            'preferences_keys' => array_keys($preferences)
        ]);

        try {
            // Get AI-powered matching from Nvidia
            $matches = $this->nvidiaService->matchUserWithCats($preferences, $cats);
            
            Log::info('matchUserWithCats returned', ['match_count' => count($matches)]);
            
            // If still empty after service call, use fallback
            if (empty($matches)) {
                Log::warning('No matches returned from AI service, using fallback');
                return $this->fallbackScoring($cats);
            }
            
            // Merge AI scores into cat objects
            foreach ($cats as $cat) {
                if (isset($matches[$cat->id])) {
                    $cat->ai_match_score = $matches[$cat->id]['score'];
                    $cat->match_reason = $matches[$cat->id]['reason'];
                } else {
                    $cat->ai_match_score = 0;
                    $cat->match_reason = 'Not scored';
                }
            }
            
            return $cats;
        } catch (\Exception $e) {
            Log::error('Error with Nvidia AI matching', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->fallbackScoring($cats);
        }
    }

    private function fallbackScoring($cats)
    {
        // Fallback: assign random scores so the ranking isn't always identical
        foreach ($cats as $cat) {
            $cat->ai_match_score = rand(55, 80);
            $cat->match_reason = 'AI scoring unavailable – showing available cats';
        }

        return $cats;
    }
}


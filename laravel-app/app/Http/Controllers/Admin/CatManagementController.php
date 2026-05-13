<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Services\OpenRouterAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CatManagementController extends Controller
{
    private $nvidiaService;

    public function __construct(OpenRouterAIService $nvidiaService)
    {
        $this->nvidiaService = $nvidiaService;
    }

    public function index()
    {
        $cats = Cat::paginate(15);
        return view('admin.cats.index', compact('cats'));
    }

    public function create()
    {
        return view('admin.cats.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'status' => 'required|in:Available,Adopted,Lost',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'personality' => 'nullable|string',
            'behavior_notes' => 'nullable|string',
            'health_status' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cats', 'public');
        }

        // Create cat record
        $cat = Cat::create($validated);

        // Generate AI temperament assessment
        $this->generateAIProfile($cat);

        return redirect()->route('admin.cats.index')->with('success', 'Cat created successfully and AI profile generated.');
    }

    public function show(Cat $cat)
    {
        return view('admin.cats.show', compact('cat'));
    }

    public function edit(Cat $cat)
    {
        return view('admin.cats.edit', compact('cat'));
    }

    public function update(Request $request, Cat $cat)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'status' => 'required|in:Available,Adopted,Lost',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'personality' => 'nullable|string',
            'behavior_notes' => 'nullable|string',
            'health_status' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($cat->image) {
                Storage::disk('public')->delete($cat->image);
            }
            $validated['image'] = $request->file('image')->store('cats', 'public');
        }

        $cat->update($validated);

        // Regenerate AI profile if key fields changed
        if ($request->filled('personality') || $request->filled('behavior_notes') || $request->filled('health_status')) {
            $this->generateAIProfile($cat);
        }

        return redirect()->route('admin.cats.index')->with('success', 'Cat updated successfully.');
    }

    public function destroy(Cat $cat)
    {
        $cat->delete();
        return redirect()->route('admin.cats.index')->with('success', 'Cat deleted successfully.');
    }

    /**
     * Generate AI temperament assessment for the cat
     */
    private function generateAIProfile(Cat $cat)
    {
        try {
            $assessment = $this->nvidiaService->getTemperamentAssessment($cat);
            
            $cat->update([
                'temperament_score' => $assessment['temperament_score'] ?? 5,
                'ai_profile' => $assessment['assessment'] ?? '',
                'ideal_adopters' => $assessment['ideal_adopters'] ?? '',
                'care_notes' => $assessment['care_notes'] ?? '',
            ]);

            Log::info("AI profile generated for cat: {$cat->name}", ['score' => $assessment['temperament_score']]);
        } catch (\Exception $e) {
            Log::error("Failed to generate AI profile for cat: {$cat->name}", ['error' => $e->getMessage()]);
            // Don't fail the cat creation if AI service fails
        }
    }
}

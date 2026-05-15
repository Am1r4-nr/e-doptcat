<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;

class AIIntegrationController extends Controller
{
    private OpenAIService $openaiService;

    public function __construct(OpenAIService $openaiService)
    {
        $this->openaiService = $openaiService;
    }

    /**
     * Generate AI description for a specific cat
     */
    public function generateDescription($catId): JsonResponse
    {
        try {
            $cat = Cat::findOrFail($catId);

            $description = $this->openaiService->generateCatDescription(
                $cat->name,
                $cat->breed ?? 'Unknown',
                $cat->color ?? 'Unknown',
                $cat->description
            );

            return response()->json([
                'success' => true,
                'cat_id' => $catId,
                'generated_description' => $description,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Generate adoption recommendations for a cat
     */
    public function getAdoptionRecommendations($catId): JsonResponse
    {
        try {
            $cat = Cat::findOrFail($catId);

            $recommendations = $this->openaiService->suggestAdoptionRecommendations(
                $cat->name,
                $cat->behavior ?? 'Unknown',
                $cat->medical_history ?? 'None',
                $cat->age ?? 'Unknown'
            );

            return response()->json([
                'success' => true,
                'cat_id' => $catId,
                'cat_name' => $cat->name,
                'recommendations' => $recommendations,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Generate medical summary for a cat
     */
    public function getMedicalSummary($catId): JsonResponse
    {
        try {
            $cat = Cat::findOrFail($catId);

            if (!$cat->medical_history) {
                return response()->json([
                    'success' => true,
                    'cat_id' => $catId,
                    'message' => 'No medical history available',
                ]);
            }

            $summary = $this->openaiService->generateMedicalSummary($cat->medical_history);

            return response()->json([
                'success' => true,
                'cat_id' => $catId,
                'cat_name' => $cat->name,
                'medical_summary' => $summary,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get AI-matched cats based on adopter preferences
     */
    public function matchCats(string $preferences): JsonResponse
    {
        try {
            $personalities = $this->openaiService->matchCatsToProfile($preferences);

            // Get all cats and their personality descriptions
            $cats = Cat::all();

            return response()->json([
                'success' => true,
                'adopter_preferences' => $preferences,
                'suitable_personalities' => $personalities,
                'total_cats_available' => $cats->count(),
                'cats' => $cats->map(fn ($cat) => [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'age' => $cat->age,
                    'gender' => $cat->gender,
                    'description' => $cat->description,
                ]),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Bulk update descriptions for all cats with AI
     */
    public function bulkGenerateDescriptions(): JsonResponse
    {
        try {
            $cats = Cat::whereNull('description')->orWhere('description', '')->get();

            if ($cats->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'All cats already have descriptions',
                ]);
            }

            $updated = 0;
            $errors = [];

            foreach ($cats as $cat) {
                try {
                    $description = $this->openaiService->generateCatDescription(
                        $cat->name,
                        $cat->breed ?? 'Unknown',
                        $cat->color ?? 'Unknown'
                    );

                    $cat->update(['description' => $description]);
                    $updated++;
                } catch (\Exception $e) {
                    $errors[] = [
                        'cat_id' => $cat->id,
                        'cat_name' => $cat->name,
                        'error' => $e->getMessage(),
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'updated' => $updated,
                'errors' => $errors,
                'message' => "{$updated} cats updated successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}

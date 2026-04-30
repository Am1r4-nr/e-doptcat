<?php

use App\Http\Controllers\AIIntegrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    // Public AI endpoints
    Route::post('/match-cats', [AIIntegrationController::class, 'matchCats']);

    // Protected AI endpoints (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/cats/{catId}/description', [AIIntegrationController::class, 'generateDescription']);
        Route::get('/cats/{catId}/recommendations', [AIIntegrationController::class, 'getAdoptionRecommendations']);
        Route::get('/cats/{catId}/medical-summary', [AIIntegrationController::class, 'getMedicalSummary']);
        Route::post('/cats/bulk-generate-descriptions', [AIIntegrationController::class, 'bulkGenerateDescriptions']);
    });
});

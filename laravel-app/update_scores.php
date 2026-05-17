<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = app(App\Services\AIService::class);
$cats = App\Models\Cat::all();
foreach ($cats as $cat) {
    echo "Processing " . $cat->name . "...\n";
    $assessment = $service->getTemperamentAssessment($cat);
    $cat->update([
        'temperament_score' => $assessment['temperament_score'] ?? 5,
        'ai_profile' => $assessment['assessment'] ?? '',
        'ideal_adopters' => $assessment['ideal_adopters'] ?? '',
        'care_notes' => $assessment['care_notes'] ?? '',
    ]);
    echo "Done! Score: " . ($assessment['temperament_score'] ?? 5) . "\n";
}
echo "All cats processed successfully.\n";

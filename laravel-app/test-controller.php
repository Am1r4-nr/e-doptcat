<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "===== Testing Dashboard Controller =====\n\n";

try {
    $controller = new \App\Http\Controllers\AdminDashboardController();
    
    // Create a mock request
    $request = \Illuminate\Http\Request::create('/admin/dashboard', 'GET');
    $request = $request->setUserResolver(function() {
        return \App\Models\User::find(2); // Admin user
    });
    
    // Call the index method through reflection to get the view data
    $reflectionMethod = new ReflectionMethod($controller, 'index');
    $result = $reflectionMethod->invoke($controller);
    
    echo "Dashboard returned: " . get_class($result) . "\n";
    
    if (method_exists($result, 'getData')) {
        $data = $result->getData();
        echo "\nView Data:\n";
        if (isset($data['stats'])) {
            echo json_encode($data['stats'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

echo "\n===== End Test =====\n";

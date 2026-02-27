<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "===== Admin Dashboard Diagnostic =====\n\n";

// Test 1: Check database connection
echo "1. Database Connection:\n";
try {
    $users = \App\Models\User::count();
    echo "   ✓ Connected successfully. Total users: $users\n";
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// Test 2: Check admin user
echo "\n2. Admin User:\n";
try {
    $admin = \App\Models\User::where('role', 'admin')->first();
    if ($admin) {
        echo "   ✓ Found admin user: {$admin->email} (ID: {$admin->id})\n";
    } else {
        echo "   ✗ No admin user found\n";
    }
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// Test 3: Check other models
echo "\n3. Database Tables:\n";
try {
    echo "   - Cats: " . \App\Models\Cat::count() . "\n";
    echo "   - Adoptions: " . \App\Models\Adoption::count() . "\n";
    echo "   - Donations: " . \App\Models\Donation::count() . "\n";
    echo "   - Reports: " . \App\Models\Report::count() . "\n";
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// Test 4: Controller logic
echo "\n4. Dashboard Controller Test:\n";
try {
    $controller = new \App\Http\Controllers\AdminDashboardController();
    $request = \Illuminate\Http\Request::capture();
    $request->setUserResolver(function() { return null; });
    
    echo "   ✓ Controller instantiated successfully\n";
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n===== End Diagnostic =====\n";

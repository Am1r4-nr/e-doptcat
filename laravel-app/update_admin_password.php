<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Load Composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel application
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Update admin user password
$user = User::where('email', 'admin@example.com')->first();

if ($user) {
    $user->update(['password' => Hash::make('admin123')]);
    echo "✅ Password updated successfully!\n";
    echo "Email: " . $user->email . "\n";
    echo "New password: admin123\n";
} else {
    echo "❌ Admin user not found\n";
}

<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Load Composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel application
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create admin user
$user = User::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Admin User',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]
);

echo "✅ Admin user ready!\n";
echo "Email: " . $user->email . "\n";
echo "Password: password\n";
echo "Role: " . $user->role . "\n";
echo "User ID: " . $user->id . "\n";

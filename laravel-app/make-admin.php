<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Create database connection
require __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// If there are existing users, make the first one admin
$user = User::first();
if ($user) {
    $user->update(['role' => 'admin']);
    echo "✅ User '{$user->name}' ({$user->email}) is now ADMIN\n";
} else {
    // Create an admin user
    $user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]);
    echo "✅ Admin user created!\n";
    echo "Email: admin@example.com\n";
    echo "Password: password\n";
}

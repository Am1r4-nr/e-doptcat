<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = \App\Models\User::where('role', 'admin')->first();

if ($user) {
    echo "✅ Admin user found: {$user->name} ({$user->email})\n";
    echo "Role: {$user->role}\n";
} else {
    echo "❌ No admin user found\n";
    echo "Total users: " . \App\Models\User::count() . "\n";
}

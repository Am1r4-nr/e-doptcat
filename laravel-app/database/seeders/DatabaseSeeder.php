<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'               => 'Admin User',
                'password'           => Hash::make('password'),
                'role'               => 'admin',
                'email_verified_at'  => now(),
            ]
        );

        // Real AHC cat records
        $this->call(AHCCatSeeder::class);
    }
}

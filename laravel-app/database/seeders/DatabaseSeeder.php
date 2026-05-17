<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cat;
use App\Models\Event;
use App\Models\Donation;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Standard User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Seed cats from AHC Cats Database
        $this->call(CatsSeeder::class);

        // Event::factory(10)->create();

        // Create reports tied to random users
        User::factory(10)->create()->each(function ($user) {
            Report::factory(rand(1, 3))->create(['user_id' => $user->id]);
            Donation::factory(rand(1, 5))->create(['user_id' => $user->id]);
        });
    }
}

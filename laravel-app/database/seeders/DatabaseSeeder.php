<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Report;
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

        // Standard User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Seed cats from the available datasets
        $this->call(AHCCatSeeder::class);
        $this->call(CatsSeeder::class);

        // Seed volunteers
        $this->call(VolunteerSeeder::class);

        // Seed mock adoption applications
        $this->call(AdoptionSeeder::class);

        // Event::factory(10)->create();

        // Create reports tied to random users
        User::factory(10)->create()->each(function ($user) {
            Report::factory(rand(1, 3))->create(['user_id' => $user->id]);
            Donation::factory(rand(1, 5))->create(['user_id' => $user->id]);
        });
    }
}

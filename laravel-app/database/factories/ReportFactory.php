<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'reporter_name' => $this->faker->name(),
            'reporter_contact' => $this->faker->phoneNumber(),
            'type' => $this->faker->randomElement(['Injury', 'Missing', 'Stray']),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'status' => 'Pending',
        ];
    }
}

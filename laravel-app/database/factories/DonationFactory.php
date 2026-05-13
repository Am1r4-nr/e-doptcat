<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'payment_method' => $this->faker->randomElement(['fpx', 'card']),
            'status' => 'Completed',
            'transaction_id' => 'TXN-' . strtoupper($this->faker->bothify('??####')),
        ];
    }
}

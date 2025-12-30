<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $venues = [
            'Main Auditorium, IIUM Gombak',
            'CAC Main Hall',
            'Mahallah Ali Open Hall',
            'Kulliyyah of Engineering',
            'Rectory Building',
            'SHAS Mosque',
            'IIiBF Seminar Room',
            'Kulliyyah of ICT',
            'Mahallah Faruq Multipurpose Hall',
            'IIUM Sports Complex'
        ];

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'event_date' => $this->faker->dateTimeBetween('now', '+3 months'),
            'location' => $this->faker->randomElement($venues),
            'status' => 'Upcoming',
            'image' => 'https://images.unsplash.com/photo-' . $this->faker->randomElement(['1511871893393-82e9c16b8d13', '1543852089-cbab3ba015a9', '1516382101-1b2257626943']) . '?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
        ];
    }
}

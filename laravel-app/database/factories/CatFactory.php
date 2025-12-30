<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    public function definition(): array
    {
        $breeds = ['Siamese', 'Persian', 'Maine Coon', 'Bengal', 'British Shorthair', 'Sphynx', 'Ragdoll', 'Domestic Shorthair'];
        $colors = ['White', 'Black', 'Orange', 'Calico', 'Tabby', 'Gray', 'Tuxedo'];

        // IIUM Gombak Approximate Bounding Box
        // Lat: 3.2450 to 3.2580
        // Lng: 101.7300 to 101.7450
        $lat = $this->faker->randomFloat(6, 3.2450, 3.2580);
        $lng = $this->faker->randomFloat(6, 101.7300, 101.7450);

        $descriptions = [
            'Found near Mahallah Ali, this friendly cat loves attention and food. Currently under observation by AHC volunteers.',
            'Rescued from the Engineering building drain. A bit shy but warms up quickly. Needs a loving home.',
            'A campus veteran often seen at the library. Very calm and great with students. Looking for a retirement home.',
            'Kitten found abandoned at the main gate. Playful, energetic, and full of life. Vaccinated by AHC team.',
            'Injured leg treated at the vet. Recovering well at the shelter. A gentle soul who needs a quiet environment.',
            'Friendly ginger cat from the Educafe area. loves to sit on laps. Neutered and ready for adoption.',
            'A beautiful stray found wandering near the Rectory. Healthy and active. Good with other cats.',
            'Rescued during a thunderstorm near the stadium. Scared but sweet. Needs patient owners.'
        ];

        return [
            'name' => $this->faker->firstName(),
            'breed' => $this->faker->randomElement($breeds),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'age' => $this->faker->numberBetween(1, 15) . ' ' . $this->faker->randomElement(['months', 'years']),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'color' => $this->faker->randomElement($colors),
            'description' => $this->faker->randomElement($descriptions),
            'medical_history' => 'Vaccinated and Dewormed by AHC Vet Team.',
            'status' => $this->faker->randomElement(['Available', 'Available', 'Available', 'Adopted']),
            'image' => 'https://images.unsplash.com/photo-' . $this->faker->randomElement(['1514888286974-6c03e2ca1dba', '1573865526339-1200dbae5e5a', '1495360019614-da048b831f51', '1533738363-b7f9aef128ce', '1529778873929-fa87327c11ad']) . '?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80',
            'gps_lat' => $lat,
            'gps_lng' => $lng,
        ];
    }
}

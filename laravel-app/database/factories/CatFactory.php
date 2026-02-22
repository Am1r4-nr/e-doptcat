<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    public function definition(): array
    {
        $breeds = ['Siamese', 'Persian', 'Maine Coon', 'Bengal', 'British Shorthair', 'Sphynx', 'Ragdoll', 'Domestic Shorthair'];
        $colors = ['White', 'Black', 'Orange', 'Calico', 'Tabby', 'Gray', 'Tuxedo'];
        $locations = ['Cafe Asiah', 'AIKOL Building', 'IRK Building', 'Medical Center', 'Library Dar Al-Hikmah'];
        $healthStatus = ['Healthy', 'Recovering', 'Treated', 'Under Observation'];
        $personalities = [
            'Friendly, Playful',
            'Calm, Affectionate',
            'Active, Energetic',
            'Shy, Gentle',
            'Loving, Loyal',
            'Curious, Intelligent',
            'Playful, Cuddly',
            'Independent, Sweet',
        ];

        // Collection of guaranteed cat images from Unsplash
        $catImages = [
            'https://images.unsplash.com/photo-1574158622682-e40e69881006?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=70', // Orange cat face
            'https://images.unsplash.com/photo-1519052537078-e6302a4968d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=70', // Gray tabby cat
            'https://images.unsplash.com/photo-1533738363-b7f9aef128ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=70', // Calico cat
            'https://cdn.omlet.com/images/originals/breed_abyssinian_cat.jpg', // Black cat
            'https://i.pinimg.com/736x/2c/a6/e8/2ca6e8d16ed23f066332aba3ec0c99e6.jpg', // White cat
            'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=70', // Tuxedo cat
            'https://media.newyorker.com/photos/5e49bf473399bf0008132231/master/pass/Kenseth-CatProfile.jpg', // Siamese cat
            'https://i0.wp.com/sassykoonz.com/wp-content/uploads/2021/06/maine-coon-adult-orange-male-i-am-legned-4-years-old-683x1024.jpg?resize=683%2C1024&ssl=1', // Maine Coon 
            ];

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
            'image' => $this->faker->randomElement($catImages),
            'gps_lat' => $lat,
            'gps_lng' => $lng,
            'ai_match_score' => $this->faker->numberBetween(60, 100),
            'location_name' => $this->faker->randomElement($locations),
            'vaccinated' => $this->faker->boolean(70),
            'health_status' => $this->faker->randomElement($healthStatus),
            'personality' => $this->faker->randomElement($personalities),
        ];
    }
}

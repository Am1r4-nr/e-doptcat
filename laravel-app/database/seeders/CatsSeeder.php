<?php

namespace Database\Seeders;

use App\Models\Cat;
use Illuminate\Database\Seeder;

class CatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cats = [
            [
                'name' => 'Bits',
                'gender' => 'Female',
                'age' => 'N/A',
                'breed' => 'Domestic short hair',
                'size' => 'Small',
                'color' => 'Domestic short hair',
                'description' => 'Domestic short hair - Found near KICT',
                'medical_history' => 'Visited vet due to incomplete birth (suspected kitten still in stomach), so she received injection to induce delivery. No improvement; remained weak after several days. Follow-up scan revealed maggot infection, later underwent surgery for maggot removal. Blood test confirmed anemia (required transfusion; developed jaundice). Doctor suspected FIP, Bits started on medication, though Post-FIPV test showed low/negative indication. Blood condition also improved.',
                'status' => 'Available',
            ],
            [
                'name' => 'Santan',
                'gender' => 'Female',
                'age' => 'N/A',
                'breed' => 'Unknown',
                'size' => 'Medium',
                'color' => 'Unknown',
                'description' => 'Rescued with a large open wound on her left arm. Been at shelter since Jan 19th, 2026.',
                'medical_history' => 'Open wound has fully healed. Currently undergoing treatment for fungal infection on her face.',
                'status' => 'Available',
            ],
            [
                'name' => 'Loki',
                'gender' => 'Unknown',
                'age' => 'N/A',
                'breed' => 'Unknown',
                'size' => 'Medium',
                'color' => 'Unknown',
                'description' => 'Was recovering from ulcers and had someone taking care of him. Very playful, especially with other cats.',
                'medical_history' => 'Infected area around the ulcers could not be saved and the dead tissues had to be removed. Took about a month to recover at the vet with intensive care. Ongoing routine wound cleaning. Now awaiting approval from vet to release him.',
                'status' => 'Available',
            ],
            [
                'name' => 'Tiger',
                'gender' => 'Male',
                'age' => 'Adult',
                'breed' => 'Domestic short hair',
                'size' => 'Large',
                'color' => 'Orange Tabby',
                'description' => 'Friendly and affectionate male cat from shelter',
                'medical_history' => 'Healthy, routine vaccines up to date',
                'status' => 'Available',
            ],
            [
                'name' => 'Luna',
                'gender' => 'Female',
                'age' => 'Young Adult',
                'breed' => 'Domestic short hair',
                'size' => 'Small',
                'color' => 'Gray',
                'description' => 'Sweet and calm female cat, good with children',
                'medical_history' => 'Spayed, all health checks passed',
                'status' => 'Available',
            ],
            [
                'name' => 'Milo',
                'gender' => 'Male',
                'age' => 'Kitten',
                'breed' => 'Domestic short hair',
                'size' => 'Small',
                'color' => 'Black and white',
                'description' => 'Energetic and playful kitten looking for a loving home',
                'medical_history' => 'Initial vaccines completed, deworming done',
                'status' => 'Available',
            ],
            [
                'name' => 'Whiskers',
                'gender' => 'Female',
                'age' => 'Senior',
                'breed' => 'Domestic short hair',
                'size' => 'Medium',
                'color' => 'Calico',
                'description' => 'Gentle senior cat with a calm demeanor, perfect for quiet homes',
                'medical_history' => 'Senior health screening completed, medications as needed',
                'status' => 'Available',
            ],
        ];

        foreach ($cats as $cat) {
            Cat::create($cat);
        }
    }
}

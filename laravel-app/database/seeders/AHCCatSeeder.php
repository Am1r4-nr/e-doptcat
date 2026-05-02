<?php

namespace Database\Seeders;

use App\Models\Cat;
use Illuminate\Database\Seeder;

class AHCCatSeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            // ── Shelter Aminah, Left Compartment ────────────────────────────
            [
                'name'           => 'Bits',
                'breed'          => 'Domestic Short Hair',
                'gender'         => 'Female',
                'age'            => null,
                'color'          => null,
                'size'           => null,
                'description'    => 'Found near KICT. Recently gave birth, though no kittens survived. Initially very weak and had a strong odor.',
                'medical_history'=> 'Visited vet due to incomplete birth (suspected kitten still in stomach); received injection to induce delivery. Remained weak with no improvement. Follow-up scan revealed maggot infection — underwent surgery for maggot removal. Blood test confirmed anemia (required transfusion; developed jaundice). Doctor suspected FIP; started on medication though Post-FIPV test showed low/negative indication. Blood condition has since improved.',
                'personality'    => null,
                'health_status'  => 'Recovering',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Left Compartment',
            ],

            // ── Shelter Aminah, Middle Compartment ──────────────────────────
            [
                'name'           => 'Santan',
                'breed'          => null,
                'gender'         => 'Female',
                'age'            => null,
                'color'          => null,
                'size'           => null,
                'description'    => 'Rescued with a large open wound on her left arm, caused by fighting with other cats. Been at shelter since Jan 19th, 2026.',
                'medical_history'=> 'Open wound has fully healed. Currently undergoing treatment for fungal infection on her face.',
                'personality'    => 'Docile, Vocal, Clingy',
                'health_status'  => 'Recovering',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Middle Compartment',
            ],
            [
                'name'           => 'Loki',
                'breed'          => null,
                'gender'         => null,
                'age'            => null,
                'color'          => null,
                'size'           => null,
                'description'    => 'Was recovering from ulcers and had someone taking care of him. Escaped and was later found with an infection around the untreated ulcer area. Been at shelter since Dec 31st, 2025.',
                'medical_history'=> 'Infected area around the ulcers could not be saved — dead tissues had to be removed. Took about a month to recover at the vet with intensive care. Ongoing routine wound cleaning. Now awaiting approval from vet to be released.',
                'personality'    => 'Playful, Quiet, Affectionate',
                'health_status'  => 'Recovering',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Middle Compartment',
            ],
            [
                'name'           => 'Ciciko',
                'breed'          => null,
                'gender'         => null,
                'age'            => '~5 months',
                'color'          => null,
                'size'           => 'Small',
                'description'    => 'Found at 7E around Dec 31st, 2025. Estimated to be about one month old at the time. Had a severe fungal infection and showed signs of malnutrition.',
                'medical_history'=> 'Treated for fungal infection and malnutrition. Recovered well. Planned for spaying once she reaches approximately 6 months old, before adoption.',
                'personality'    => 'Playful, Energetic, Vocal, Mischievous, Social',
                'health_status'  => 'Healthy',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Middle Compartment',
            ],

            // ── Shelter Aminah, Right Compartment ───────────────────────────
            [
                'name'           => 'Toteh',
                'breed'          => null,
                'gender'         => null,
                'age'            => null,
                'color'          => null,
                'size'           => null,
                'description'    => 'Found with an injured paw, likely caused by a vehicle accident. Recently admitted to the shelter.',
                'medical_history'=> 'Currently receiving treatment for injured paw. Undergoing daily bandage changes.',
                'personality'    => 'Affectionate, Attention-seeking, Expressive',
                'health_status'  => 'Recovering',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Right Compartment',
            ],
            [
                'name'           => 'Ren',
                'breed'          => null,
                'gender'         => null,
                'age'            => null,
                'color'          => null,
                'size'           => null,
                'description'    => 'First found at Mahallah Safiyyah. Was previously being cared for by someone before being taken to the vet.',
                'medical_history'=> 'Infection in the left eye; given Nicol and Systane eyedrops, multivitamin, and anti-inflammation medicine. Recently started wheezing and sneezing — now on chlorpheniramine and tobramycin.',
                'personality'    => 'Active, Playful, Vocal, Social',
                'health_status'  => 'Recovering',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Right Compartment',
            ],
            [
                'name'           => 'Muezza',
                'breed'          => null,
                'gender'         => 'Female',
                'age'            => '3-4 years',
                'color'          => null,
                'size'           => null,
                'description'    => 'Found at Mahallah Safiyyah in July 2025. Her paw was reportedly crushed by a car. Been at shelter since September 2025.',
                'medical_history'=> 'Paw crushed by a car; infected wound developed maggots. Underwent paw amputation. After months of recovery, skin at the amputated area has fully regenerated. Has undergone spaying and paw suturing surgery.',
                'personality'    => 'Affectionate, Manja, Loves chin rubs',
                'health_status'  => 'Healthy',
                'status'         => 'Available',
                'vaccinated'     => true,
                'location_name'  => 'Shelter Aminah, Right Compartment',
            ],
            [
                'name'           => 'Tom',
                'breed'          => 'Domestic Short Hair',
                'gender'         => 'Male',
                'age'            => null,
                'color'          => 'Tabby',
                'size'           => null,
                'description'    => 'Tabby cat with green eyes. Found at Mahallah Ruqayyah.',
                'medical_history'=> 'Inflamed tooth due to kidney disease (no anesthesia used). Warded for 1+ month on fluids and renal diet. Now stable but requires weekly subcutaneous fluids, monthly blood tests, and lifetime renal food.',
                'personality'    => 'Quiet, Calm, Dislikes being caged',
                'health_status'  => 'Recovering',
                'status'         => 'Available',
                'vaccinated'     => false,
                'location_name'  => 'Shelter Aminah, Right Compartment',
            ],
        ];

        foreach ($cats as $data) {
            Cat::firstOrCreate(['name' => $data['name']], $data);
        }

        $this->command->info('AHC cats seeded: ' . count($cats) . ' records.');
    }
}

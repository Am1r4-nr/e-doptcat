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
                'name' => 'Ciciko',
                'gender' => 'Unknown',
                'age' => 'N/A',
                'breed' => 'Unknown',
                'size' => 'Medium',
                'color' => 'Unknown',
                'description' => 'Found at 7E around Dec 31st, 2025. Estimated to be around one month old at the time. Had a severe fungal infection and showed signs of malnutrition. Very playful and energetic, also very vocal. Playfully mischievous, tends to bite. Social with both humans and other cats and climbs on them.',
                'medical_history' => 'Treated for fungal infection and malnutrition. Recovered well. Planned for spaying once she reaches approximately 6 months old before adoption.',
                'status' => 'Available',
            ],
            [
                'name' => 'Toteh',
                'gender' => 'Unknown',
                'age' => 'N/A',
                'breed' => 'Unknown',
                'size' => 'Medium',
                'color' => 'Unknown',
                'description' => 'Found with an injured paw, likely caused by a vehicle accident. Recently admitted to the shelter. Very affectionate and seeks attention. Loves being petted. Expressive and makes a distinctive "cute" face when wanting something.',
                'medical_history' => 'Currently receiving treatment for injured paw. Undergoing daily bandage changes.',
                'status' => 'Available',
            ],
            [
                'name' => 'Ren',
                'gender' => 'Unknown',
                'age' => 'N/A',
                'breed' => 'Unknown',
                'size' => 'Medium',
                'color' => 'Unknown',
                'description' => 'First found at Mahallah Safiyyah. Was previously being cared for by someone before being taken to the vet. Very active and playful cat, loves to play with the other cats. Very vocal and enjoys being picked up.',
                'medical_history' => 'Infection in the left eye, was given bagi eyedrop nicol and systane, multivitamin and anti-inflammation medicine. Recently has started wheezing and sneezing, so Ren has started new medication, which is chrolpheramine and torbraynmcin.',
                'status' => 'Available',
            ],
            [
                'name' => 'Muezza',
                'gender' => 'Female',
                'age' => '3-4 years old',
                'breed' => 'Unknown',
                'size' => 'Medium',
                'color' => 'Unknown',
                'description' => 'Found at Safiyyah July 2025, was under the care of reporter. Her paw was reportedly crushed by a car. Been at shelter since Sept 2025 (7 months). Very grumpy but now very affectionate, manja and loves chin rubs.',
                'medical_history' => 'Muezza had her paw crushed by a car, her infected wound started growing maggots. Forced to amputate her paw. After months of recovery, skin at the amputated area has fully regenerated. Muezza has already undergone spaying and paw suturing surgery.',
                'status' => 'Available',
            ],
            [
                'name' => 'Tom',
                'gender' => 'Male',
                'age' => 'N/A',
                'breed' => 'Tabby',
                'size' => 'Medium',
                'color' => 'Tabby with green eyes',
                'description' => 'Tabby cat with green eyes. Found at Mahallah Ruqayyah. Quiet, chill old boy. Does not like being caged, Tom needs an occasional breath of fresh air.',
                'medical_history' => 'Inflamed tooth due to kidney disease (no anesthesia). Warded 1 month+ (fluids/renal diet). Now stable but needs weekly sub-cut, monthly blood test & lifetime renal food.',
                'status' => 'Available',
            ],
        ];

        foreach ($cats as $cat) {
            Cat::create($cat);
        }
    }
}

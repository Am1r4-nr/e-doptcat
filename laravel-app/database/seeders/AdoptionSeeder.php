<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdoptionSeeder extends Seeder
{
    public function run(): void
    {
        $adopters = [
            ['name' => 'Aisha Rahman',       'email' => 'aisha.rahman@gmail.com'],
            ['name' => 'Hafiz Zulkifli',     'email' => 'hafiz.zulk@gmail.com'],
            ['name' => 'Nurul Ain Binti Ali','email' => 'nurulain@gmail.com'],
            ['name' => 'Syafiq Hamdan',      'email' => 'syafiq.hamdan@gmail.com'],
            ['name' => 'Liyana Mustafa',     'email' => 'liyana.mustafa@gmail.com'],
            ['name' => 'Zulaikha Idris',     'email' => 'zulaikha.idris@gmail.com'],
            ['name' => 'Iqbal Norzaidi',     'email' => 'iqbal.norzaidi@gmail.com'],
            ['name' => 'Farhana Roslan',     'email' => 'farhana.roslan@gmail.com'],
            ['name' => 'Danish Azrin',       'email' => 'danish.azrin@gmail.com'],
            ['name' => 'Siti Hajar Yusof',  'email' => 'sitihajar@gmail.com'],
            ['name' => 'Arif Hazwan',        'email' => 'arif.hazwan@gmail.com'],
            ['name' => 'Nabilah Zainudin',   'email' => 'nabilah.zain@gmail.com'],
        ];

        $createdUsers = [];
        foreach ($adopters as $data) {
            $createdUsers[] = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make('password'),
                    'role'              => 'user',
                    'email_verified_at' => now(),
                ]
            );
        }

        $cats = Cat::inRandomOrder()->take(20)->get();
        if ($cats->isEmpty()) {
            $this->command->warn('No cats found — run CatsSeeder first.');
            return;
        }

        $pipelineStages = ['Inquiry', 'Inquiry', 'Inquiry', 'Inquiry', 'Screening', 'Screening', 'Matching', 'Matching', 'Approved', 'Approved', 'Approved', 'Approved'];
        $environments   = ['Apartment', 'House', 'Condo', 'Terrace House', 'Landed Property'];
        $occupations    = ['Student', 'Engineer', 'Teacher', 'Nurse', 'Software Developer', 'Accountant', 'Lecturer'];
        $reasons        = [
            'Looking for a calm companion for our family.',
            'My child has been wanting a cat for years.',
            'I live alone and want a furry friend.',
            'We have always been cat lovers.',
            'Rescue and give a loving home.',
        ];

        // Partial checklist completions to make seeded data look realistic
        $checklistVariants = [
            fn($d) => $d, // all false
            function ($d) { $d['Inquiry']['enquiry_received'] = true; return $d; },
            function ($d) { foreach ($d['Inquiry'] as $k => &$v) $v = true; return $d; },
            function ($d) {
                foreach ($d['Inquiry'] as $k => &$v) $v = true;
                $d['Screening']['application_form'] = true;
                $d['Screening']['id_verification']  = true;
                return $d;
            },
            function ($d) {
                foreach ($d['Inquiry']   as $k => &$v) $v = true;
                foreach ($d['Screening'] as $k => &$v) $v = true;
                foreach ($d['Matching']  as $k => &$v) $v = true;
                foreach ($d['Approved']  as $k => &$v) $v = true;
                return $d;
            },
        ];

        $catCount = $cats->count();
        foreach ($createdUsers as $i => $user) {
            $cat           = $cats[$i % $catCount];
            $pipelineStage = $pipelineStages[$i % count($pipelineStages)];
            $checklist     = $checklistVariants[$i % count($checklistVariants)](Adoption::defaultChecklist());

            Adoption::firstOrCreate(
                ['user_id' => $user->id, 'cat_id' => $cat->id],
                [
                    'status'              => 'Pending',
                    'pipeline_stage'      => $pipelineStage,
                    'checklist'           => $checklist,
                    'application_details' => [
                        'environment'  => $environments[$i % count($environments)],
                        'occupation'   => $occupations[$i % count($occupations)],
                        'reason'       => $reasons[$i % count($reasons)],
                        'has_children' => ($i % 3 === 0) ? 'Yes' : 'No',
                        'other_pets'   => ($i % 4 === 0) ? 'Yes' : 'No',
                    ],
                ]
            );
        }

        $this->command->info('AdoptionSeeder: ' . count($createdUsers) . ' adopters and adoption records created.');
    }
}

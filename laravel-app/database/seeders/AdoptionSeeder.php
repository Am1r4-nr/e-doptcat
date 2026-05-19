<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdoptionSeeder extends Seeder
{
    public function run(): void
    {
        $adopters = [
            ['name' => 'Aisha Rahman',        'email' => 'aisha.rahman@gmail.com'],
            ['name' => 'Hafiz Zulkifli',      'email' => 'hafiz.zulk@gmail.com'],
            ['name' => 'Nurul Ain Binti Ali',  'email' => 'nurulain@gmail.com'],
            ['name' => 'Syafiq Hamdan',        'email' => 'syafiq.hamdan@gmail.com'],
            ['name' => 'Liyana Mustafa',       'email' => 'liyana.mustafa@gmail.com'],
            ['name' => 'Zulaikha Idris',       'email' => 'zulaikha.idris@gmail.com'],
            ['name' => 'Iqbal Norzaidi',       'email' => 'iqbal.norzaidi@gmail.com'],
            ['name' => 'Farhana Roslan',       'email' => 'farhana.roslan@gmail.com'],
            ['name' => 'Danish Azrin',         'email' => 'danish.azrin@gmail.com'],
            ['name' => 'Siti Hajar Yusof',     'email' => 'sitihajar@gmail.com'],
            ['name' => 'Arif Hazwan',          'email' => 'arif.hazwan@gmail.com'],
            ['name' => 'Nabilah Zainudin',     'email' => 'nabilah.zain@gmail.com'],
            ['name' => 'Raihan Othman',        'email' => 'raihan.othman@gmail.com'],
            ['name' => 'Suraya Halim',         'email' => 'suraya.halim@gmail.com'],
            ['name' => 'Azri Kamarudin',       'email' => 'azri.kamarudin@gmail.com'],
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

        $environments = ['Apartment', 'House', 'Condo', 'Terrace House', 'Landed Property'];
        $occupations  = ['Student', 'Engineer', 'Teacher', 'Nurse', 'Software Developer', 'Accountant', 'Lecturer'];
        $icNumbers    = [
            '901215-14-5678', '880304-10-1234', '950820-07-3312', '030612-05-8876',
            '971130-12-4451', '001005-08-6632', '860718-06-2219', '920401-11-7743',
            '990922-04-5561', '040217-09-9924', '011128-13-3387', '870603-03-8814',
            '930815-02-1145', '050330-16-7763', '980714-01-4429',
        ];
        $reasons      = [
            'Looking for a calm companion for our family.',
            'My child has been wanting a cat for years.',
            'I live alone and want a furry friend.',
            'We have always been cat lovers.',
            'I want to rescue and give a loving home.',
        ];

        // Each entry: [pipeline_stage, which checklist items are done]
        // Format: stage => [item_key => true/false overrides]
        $scenarios = [
            // --- NEW stage: just submitted, nothing reviewed yet ---
            ['stage' => 'New', 'done' => []],
            ['stage' => 'New', 'done' => ['New.identity_confirmed' => true]],
            ['stage' => 'New', 'done' => ['New.identity_confirmed' => true, 'New.contact_verified' => true]],
            ['stage' => 'New', 'done' => ['New.identity_confirmed' => true, 'New.contact_verified' => true, 'New.terms_acknowledged' => true]],

            // --- INQUIRY stage: credentials passed, inquiry started ---
            ['stage' => 'Inquiry', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true,
            ]],
            ['stage' => 'Inquiry', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true,
            ]],

            // --- SCREENING stage: inquiry complete ---
            ['stage' => 'Screening', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true,
            ]],
            ['stage' => 'Screening', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true, 'Screening.id_verification' => true,
                'Screening.home_survey' => true,
            ]],

            // --- MATCHING stage: screening complete ---
            ['stage' => 'Matching', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true, 'Screening.id_verification' => true,
                'Screening.home_survey' => true, 'Screening.reference_checks' => true,
                'Matching.animal_selected' => true, 'Matching.meet_and_greet' => true,
            ]],
            ['stage' => 'Matching', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true, 'Screening.id_verification' => true,
                'Screening.home_survey' => true, 'Screening.reference_checks' => true,
                'Matching.animal_selected' => true, 'Matching.meet_and_greet' => true,
                'Matching.trial_visit' => true,
            ]],

            // --- APPROVED stage: all done ---
            ['stage' => 'Approved', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true, 'Screening.id_verification' => true,
                'Screening.home_survey' => true, 'Screening.reference_checks' => true,
                'Matching.animal_selected' => true, 'Matching.meet_and_greet' => true,
                'Matching.trial_visit' => true, 'Matching.compatibility_confirmed' => true,
                'Approved.agreement_signed' => true, 'Approved.fee_paid' => true,
                'Approved.handover_done' => true, 'Approved.follow_up_scheduled' => true,
            ]],
            ['stage' => 'Approved', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true, 'Screening.id_verification' => true,
                'Screening.home_survey' => true, 'Screening.reference_checks' => true,
                'Matching.animal_selected' => true, 'Matching.meet_and_greet' => true,
                'Matching.trial_visit' => true, 'Matching.compatibility_confirmed' => true,
                'Approved.agreement_signed' => true, 'Approved.fee_paid' => true,
                'Approved.handover_done' => true,
            ]],
            ['stage' => 'Approved', 'done' => [
                'New.identity_confirmed' => true, 'New.contact_verified' => true,
                'New.terms_acknowledged' => true, 'New.profile_reviewed' => true,
                'Inquiry.enquiry_received' => true, 'Inquiry.acknowledgement_sent' => true,
                'Inquiry.basic_eligibility_check' => true, 'Inquiry.interview_session' => true,
                'Screening.application_form' => true, 'Screening.id_verification' => true,
                'Screening.home_survey' => true, 'Screening.reference_checks' => true,
                'Matching.animal_selected' => true, 'Matching.meet_and_greet' => true,
                'Matching.trial_visit' => true, 'Matching.compatibility_confirmed' => true,
                'Approved.agreement_signed' => true, 'Approved.fee_paid' => true,
            ]],
        ];

        $catCount = $cats->count();
        foreach ($createdUsers as $i => $user) {
            $cat      = $cats[$i % $catCount];
            $scenario = $scenarios[$i % count($scenarios)];

            // Build checklist from default, apply the scenario's done items
            $checklist = Adoption::defaultChecklist();
            foreach ($scenario['done'] as $dotKey => $val) {
                [$stage, $item] = explode('.', $dotKey);
                $checklist[$stage][$item] = $val;
            }

            Adoption::create([
                'user_id'             => $user->id,
                'cat_id'              => $cat->id,
                'status'              => 'Pending',
                'pipeline_stage'      => $scenario['stage'],
                'checklist'           => $checklist,
                'application_details' => [
                    'ic_number'    => $icNumbers[$i % count($icNumbers)],
                    'environment'  => $environments[$i % count($environments)],
                    'occupation'   => $occupations[$i % count($occupations)],
                    'reason'       => $reasons[$i % count($reasons)],
                    'has_children' => ($i % 3 === 0) ? 'Yes' : 'No',
                    'other_pets'   => ($i % 4 === 0) ? 'Yes' : 'No',
                ],
            ]);
        }

        $this->command->info('AdoptionSeeder: ' . count($createdUsers) . ' adoption records seeded across all 5 stages.');
    }
}

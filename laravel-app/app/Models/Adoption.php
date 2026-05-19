<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cat_id',
        'status',
        'application_details',
        'pipeline_stage',
        'checklist',
    ];

    protected $casts = [
        'application_details' => 'array',
        'checklist'           => 'array',
    ];

    public static function defaultChecklist(): array
    {
        return [
            'New' => [
                'identity_confirmed'    => false,
                'contact_verified'      => false,
                'terms_acknowledged'    => false,
                'profile_reviewed'      => false,
            ],
            'Inquiry' => [
                'enquiry_received'        => false,
                'acknowledgement_sent'    => false,
                'basic_eligibility_check' => false,
                'interview_session'       => false,
            ],
            'Screening' => [
                'application_form' => false,
                'id_verification'  => false,
                'home_survey'      => false,
                'reference_checks' => false,
            ],
            'Matching' => [
                'animal_selected'         => false,
                'meet_and_greet'          => false,
                'trial_visit'             => false,
                'compatibility_confirmed' => false,
            ],
            'Approved' => [
                'agreement_signed'    => false,
                'fee_paid'            => false,
                'handover_done'       => false,
                'follow_up_scheduled' => false,
            ],
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}

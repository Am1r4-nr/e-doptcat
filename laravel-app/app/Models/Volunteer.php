<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'name', 'matric', 'email', 'phone', 'program',
        'availability', 'avail_time', 'status', 'skills',
        'bio', 'experience', 'location', 'applied_at',
    ];

    protected $casts = [
        'skills'     => 'array',
        'applied_at' => 'date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'gender',
        'age',
        'size',
        'color',
        'description',
        'medical_history',
        'status',
        'image',
        'gps_lat',
        'gps_lng',
        'ai_match_score',
        'location_name',
        'vaccinated',
        'health_status',
        'personality',
    ];

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}

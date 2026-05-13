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
        'ai_profile',
        'temperament_score',
        'ideal_adopters',
        'care_notes',
        'location_name',
        'vaccinated',
        'health_status',
        'personality',
        'behavior_notes',
    ];

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    /**
     * Get all GPS devices for this cat
     */
    public function gpsDevices()
    {
        return $this->hasMany(GpsDevice::class);
    }

    /**
     * Get the primary GPS device for this cat
     */
    public function gpsDevice()
    {
        return $this->hasOne(GpsDevice::class);
    }
}

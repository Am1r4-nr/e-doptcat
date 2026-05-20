<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $breed
 * @property string|null $gender
 * @property int|null $age
 * @property string|null $size
 * @property string|null $color
 * @property string|null $description
 * @property string|null $medical_history
 * @property string $status
 * @property string|null $image
 * @property float|null $gps_lat
 * @property float|null $gps_lng
 * @property int|null $ai_match_score
 * @property string|null $location_name
 * @property bool|null $vaccinated
 * @property string|null $health_status
 * @property string|null $personality
 * @property float|null $weight
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
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
        'weight',
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

    /**
     * Accessor for image_url which maps to the image attribute.
     */
    public function getImageUrlAttribute()
    {
        return $this->image;
    }
}

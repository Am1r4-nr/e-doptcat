<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GpsLocationHistory extends Model
{
    protected $table = 'gps_location_histories';
    
    protected $fillable = [
        'gps_device_id',
        'latitude',
        'longitude',
        'accuracy',
        'speed',
        'direction',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    /**
     * Relationship: History belongs to a GPS Device
     */
    public function device()
    {
        return $this->belongsTo(GpsDevice::class, 'gps_device_id');
    }
}

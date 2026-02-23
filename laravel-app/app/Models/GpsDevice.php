<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GpsDevice extends Model
{
    protected $table = 'gps_devices';
    
    protected $fillable = [
        'cat_id',
        'imei',
        'device_name',
        'is_active',
        'last_sync_at',
        'last_known_lat',
        'last_known_lng',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_sync_at' => 'datetime',
    ];

    /**
     * Relationship: Device belongs to a Cat
     */
    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    /**
     * Get location history for this device
     */
    public function history()
    {
        return $this->hasMany(GpsLocationHistory::class, 'gps_device_id');
    }
}

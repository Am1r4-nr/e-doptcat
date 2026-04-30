<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'severity',
        'latitude',
        'longitude',
        'status',
        'reported_at',
        'resolved_at',
        'cat_id',
        'user_id',
        'location_name'
    ];

    protected $casts = [
        'reported_at' => 'datetime',
        'resolved_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

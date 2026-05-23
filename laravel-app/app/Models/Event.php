<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'image',
        'status',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function registrations()
    {
        return $this->hasMany(SavedEvent::class, 'event_id');
    }

    public function saves()
    {
        return $this->hasMany(SavedEvent::class, 'event_id');
    }
}

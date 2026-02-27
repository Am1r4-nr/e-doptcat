<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAiPreference extends Model
{
    use HasFactory;

    protected $table = 'user_ai_preferences';

    protected $fillable = [
        'user_id',
        'lifestyle',
        'budget',
        'home_env',
        'activity',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

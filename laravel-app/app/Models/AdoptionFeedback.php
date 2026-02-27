<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionFeedback extends Model
{
    use HasFactory;

    protected $table = 'adoption_feedback';

    protected $fillable = [
        'adoption_id',
        'user_id',
        'cat_id',
        'success_score',
        'notes',
        'user_prefs',
        'cat_attributes',
    ];

    protected $casts = [
        'user_prefs' => 'array',
        'cat_attributes' => 'array',
    ];

    public function adoption()
    {
        return $this->belongsTo(Adoption::class);
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

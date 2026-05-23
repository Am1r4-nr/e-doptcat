<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function eventRegistrations()
    {
        return $this->hasMany(SavedEvent::class, 'user_id');
    }

    public function savedEvents()
    {
        return $this->hasMany(SavedEvent::class, 'user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}

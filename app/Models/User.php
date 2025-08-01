<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_online',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the driver profile associated with the user.
     */
    public function driver()
    {
        return $this->hasOne(Driver::class, 'id');
    }

    /**
     * Get the passenger profile associated with the user.
     */
    public function passenger()
    {
        return $this->hasOne(Passenger::class, 'id');
    }

    /**
     * Check if user is a passenger
     */
    public function isPassenger()
    {
        return $this->role === 'passenger';
    }

    /**
     * Check if user is a driver
     */
    public function isDriver()
    {
        return $this->role === 'driver';
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}

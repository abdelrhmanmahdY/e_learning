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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function roles()
    {

        return $this->belongsToMany(Role::class, 'rolegroup', 'user_id', 'role_id');
    }

    // Helper method to check if user has a certain role
    public function hasRole($roleName)
    {
        return $this->roles()->where('role_name', $roleName)->exists();
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function penalties()
    {
        return $this->belongsToMany(Penalty::class, 'havepenalties', 'user_id', 'penalties_id');
    }
    public function hasPenalty($penaltyId)
    {
        return $this->penalties()->where('penalties_id', $penaltyId)->exists();
    }
    
}

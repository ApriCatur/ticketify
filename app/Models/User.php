<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRoleSettings;

/**
 * @method mixed getPermission(string $key, mixed $default = false)
 * @method bool hasRolePermission(string $action)
 * @method \Illuminate\Support\Collection getRoleSettings()
 * @method bool hasFeature(string $feature)
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoleSettings;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role',
        'profile_picture',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function roleApplications()
    {
        return $this->hasMany(RoleApplication::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

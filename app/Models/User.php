<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    use HasFactory, Notifiable, HasRoleSettings, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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

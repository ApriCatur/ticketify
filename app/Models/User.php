<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRoleSettings;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoleSettings, SoftDeletes;

    protected $fillable = [
        'name',
        'nim',
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

    public function panitiaProfile()
    {
        return $this->hasOne(PanitiaProfile::class);
    }
}

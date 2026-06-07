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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function hasRole($role)
{
    return $this->role === $role;
}


    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function roleApplications()
    {
        return $this->hasMany(RoleApplication::class);
    }

    // TAMBAHKAN RELASI INI UNTUK MENGAMBIL DATA PENGAJUAN TERBARU / AKTIF
    public function latestApplication()
    {
        return $this->hasOne(RoleApplication::class, 'user_id', 'id')->latestOfMany();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function panitiaProfile()
{
    // Menghubungkan user ke data pendaftarannya di tabel role_applications
    return $this->hasOne(RoleApplication::class, 'user_id')
                ->where('status', 'approved');
}

}

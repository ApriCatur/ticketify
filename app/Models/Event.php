<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banner',
        'name',
        'category',
        'location',
        'social_link',
        'date',
        'time_start',
        'time_end',
        'ticket_type',
        'ticket_types',
        'price',
        'stock',
        'description',
        'maps_link',
        'terms',
        'organiser_description',
        'organiser_photo',
        'status',
    ];

    protected $casts = [
        'ticket_types' => 'array',
    ];

    // Hubungan balik ke User (Panitia)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banner',
        'name',
        'category_id',
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
        'terms',
        'organiser_description',
        'organiser_photo',
        'status',
        'unpublish_reason',
        'unpublished_at',
        'refund_date',
        'refund_location',
        'refund_info',
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

    /**
     * Mendapatkan status display event
     * Jika event sudah lewat tanggalnya, status akan menjadi 'completed'
     * Selain itu, kembalikan status asli dari database
     */
    public function getDisplayStatus()
    {
        // Jika status bukan 'published', kembalikan status aslinya
        if ($this->status !== 'published') {
            return $this->status;
        }

        // Cek apakah event sudah selesai (date + time_end sudah lewat)
        $eventEnd = Carbon::parse($this->date . ' ' . $this->time_end);
        if ($eventEnd < Carbon::now()) {
            return 'completed';
        }

        return $this->status;
    }


    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}

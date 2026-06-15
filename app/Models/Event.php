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

        // Cek apakah tanggal event sudah lewat hari ini
        $eventDate = Carbon::parse($this->date)->endOfDay();
        if ($eventDate < Carbon::now()) {
            return 'completed';
        }

        return $this->status;
    }


    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilter($query, array $filters)
{
    // Filter Nama Event
    $query->when($filters['search'] ?? null, function ($q, $search) {
        $q->where('name', 'like', '%' . $search . '%');
    });

    // Filter Kategori (Sesuaikan dengan nama field di DB, kemungkinan 'category_id')
    $query->when($filters['category_id'] ?? null, function ($q, $category_id) {
        $q->where('category_id', $category_id);
    });

    // Filter Tanggal
    $query->when($filters['date'] ?? null, function ($q, $date) {
        $q->whereDate('date', $date);
    });
}

}

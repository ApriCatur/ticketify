<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleApplication extends Model
{
    // Daftarkan kolom yang boleh diisi massal via controller nanti
    protected $fillable = [
        'user_id',
        'organization_name',
        'reason',
        'status'
    ];

    // Relasi balik: Satu pengajuan ini milik dari seorang User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

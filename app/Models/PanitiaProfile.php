<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanitiaProfile extends Model
{
    protected $fillable = ['user_id', 'asal_ukm', 'no_rekening'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

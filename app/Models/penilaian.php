<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class penilaian extends Model
{
    //
    protected $fillable = [
        'sewa_id',
        'penyewa_id',
        'rating',
        'ulasan',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'penyewa_id');
    }
}

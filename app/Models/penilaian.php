<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model  // Changed to uppercase P for consistency
{
    protected $table = 'penilaians';

    protected $fillable = [
        'sewa_id',
        'penyewa_id',
        'rating',
        'ulasan',
    ];

    // Define relationship with Sewa model
    public function sewa(): BelongsTo
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }

    // Define relationship with User model
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penyewa_id');
    }
}

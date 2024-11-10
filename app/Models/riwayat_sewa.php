<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat_sewa extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'sewa_id',
        'status_sebelumnya',
        'status_saat_ini',
        'waktu',

    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'tanggal',
        'deskripsi',
        'status',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}

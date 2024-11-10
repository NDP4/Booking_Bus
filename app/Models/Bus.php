<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $fillable = [
        // 'nama_bus',
        // 'plat_nomor',
        // 'kapasitas',
        // 'tahun',
        // 'sasis',
        // 'foto_bus',
        // 'kondisi',
        // 'status',


        'nama_bus',
        'plat_nomor',
        'kapasitas',
        'tahun',
        'sasis',
        'karoseri',
        'nomor_kir',
        'fasilitas',
        'foto_bus',
        'kondisi',
        'status',
        'harga_sewa',
    ];
}

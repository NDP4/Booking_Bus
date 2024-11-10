<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumentasi_kerusakan extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'maintenance_id',
        'foto',
        'deskripsi',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}

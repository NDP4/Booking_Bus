<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenance_item extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'maintenance_id',
        'nama_item',
        'biaya',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}

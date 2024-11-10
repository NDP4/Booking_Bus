<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_aktivita extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aktivitas',
        'waktu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

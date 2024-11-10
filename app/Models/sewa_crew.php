<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sewa_crew extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'sewa_id',
        'crew_id',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function crew()
    {
        return $this->belongsTo(User::class, 'crew_id');
    }
}

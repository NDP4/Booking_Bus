<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class invoice extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'sewa_id',
        'jumlah',
        'tanggal_terbit',
        'status',
        'jumlah'
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function ($sewa) {
            try {
                $bus = $sewa->bus;

                if ($bus) {
                    $totalAmount = $bus->harga_sewa * $sewa->durasi;
                    Invoice::create([
                        'sewa_id' => $sewa->id,
                        'jumlah' => $totalAmount,
                        'tanggal_terbit' => now(),
                        'status' => 'Belum Dibayar',
                    ]);
                } else {
                    // Jika bus tidak ditemukan, Anda bisa mengabaikan atau mencatat log
                    // Log::warning("Bus tidak ditemukan untuk sewa ID: {$sewa->id}");
                }
            } catch (\Exception $e) {
                // Tangani pengecualian di sini jika perlu
                // Log::error($e->getMessage());
            }
        });
    }




    public static function booted()
    {
        parent::booted();

        self::creating(function ($invoice) {
            // Ambil objek Sewa berdasarkan sewa_id yang sudah diisi
            $sewa = Sewa::find($invoice->sewa_id);

            if ($sewa && $sewa->bus) {
                // Set jumlah berdasarkan total_harga dari sewa
                $invoice->jumlah = $sewa->total_harga;
                $invoice->tanggal_terbit = now(); // Atur tanggal terbit
                $invoice->status = 'Belum Dibayar'; // Atur status
            } else {
                throw new \Exception("Sewa atau bus tidak ditemukan.");
            }
        });
    }




    // public function getJumlahAttribute()
    // {
    //     $sewa = $this->sewa;
    //     return $sewa->calculateTotalPrice();
    // }



    // public function sewa()
    // {
    //     return $this->belongsTo(Sewa::class);
    // }
    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);

    }
}

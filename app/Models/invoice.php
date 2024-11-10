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


        // self::created(function ($sewa) {
        //     $bus = $sewa->bus; // Ambil bus terkait dari sewa

        //     // Menghitung durasi sewa dalam hari
        //     $durasi = Carbon::parse($sewa->tanggal_selesai)->diffInDays(Carbon::parse($sewa->tanggal_mulai));

        //     // Hitung jumlah berdasarkan durasi sewa
        //     $totalAmount = $bus->harga_sewa * $durasi;

        //     Invoice::create([
        //         'sewa_id' => $sewa->id,
        //         'jumlah' => $totalAmount,
        //         'tanggal_terbit' => now(),
        //         'status' => 'Belum Dibayar',
        //     ]);
        // });

        // self::created(function ($invoice) {
        //     $sewa = $invoice->sewa;
        //     if ($sewa && $sewa->bus) {
        //         $totalAmount = $sewa->bus->harga_sewa * $sewa->durasi;
        //         $invoice->jumlah = $totalAmount;
        //         $invoice->save();
        //     }
        // });
    }

    // Di model Invoice.php
    // protected static function booted()
    // {
    //     static::creating(function ($invoice) {
    //         // Set tanggal_terbit ke waktu saat ini jika tidak ada nilai yang diberikan
    //         if (!$invoice->tanggal_terbit) {
    //             $invoice->tanggal_terbit = now();
    //         }
    //     });
    // }


    // public static function booted()
    // {
    //     parent::boot();

    //     self::created(function ($invoice) {
    //         $sewa = $invoice->sewa;
    //         $invoice->jumlah = $sewa->calculateTotalPrice();
    //         $invoice->save();
    //     });
    // }

    // public static function booted()
    // {
    //     parent::boot();

    //     self::creating(function ($invoice) {
    //         $sewa = $invoice->sewa; // Mengambil data sewa terkait

    //         if ($sewa && $sewa->total_harga) {
    //             // Set jumlah berdasarkan total_harga dari sewa
    //             $invoice->jumlah = $sewa->total_harga;
    //         } else {
    //             throw new \Exception("Jumlah tidak boleh kosong dan harus diisi dari total_harga Sewa.");
    //         }

    //         // Set tanggal_terbit ke waktu saat ini jika tidak ada nilai yang diberikan
    //         if (!$invoice->tanggal_terbit) {
    //             $invoice->tanggal_terbit = now();
    //         }
    //     });
    // }


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

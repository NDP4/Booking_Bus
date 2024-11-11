<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;


class Sewa extends Model
{
    //
    protected $fillable = [
        'id_penyewa',
        'id_bus',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_penjemputan',
        'lokasi_penjemputan',
        'tujuan',
        'status',
        'total_harga',
    ];

    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_penyewa');
    }



    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }

    public static function isBusAvailable($busId, $startDate, $endDate, $excludeId = null)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        return self::where('id_bus', $busId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_mulai', [$startDate, $endDate])
                    ->orWhereBetween('tanggal_selesai', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('tanggal_mulai', '<=', $startDate)
                            ->where('tanggal_selesai', '>=', $endDate);
                    });
            })
            ->where('id', '!=', $excludeId)
            ->exists();
    }

    public static function validateBusAvailability($busId, $startDate, $endDate, $excludeId = null)
    {
        if (self::isBusAvailable($busId, $startDate, $endDate, $excludeId)) {
            throw new \Exception("Bus sudah dipesan pada periode waktu yang sama.");
        }
    }


    public function riwayatSewas()
    {
        return $this->hasMany(riwayat_sewa::class);
    }

    public static function boot()
    {
        parent::boot();

        // untuk validasi tanggal tidak boleh kurang dari hari ini
        self::creating(function ($sewa) {
            if (Carbon::parse($sewa->tanggal_mulai)->isBefore(Carbon::today())) {
                throw new \Exception("Tanggal mulai tidak boleh lebih kecil dari hari ini.");
            }
            if (Carbon::parse($sewa->tanggal_selesai)->isBefore(Carbon::parse($sewa->tanggal_mulai))) {
                throw new \Exception("Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.");
            }
            self::validateBusAvailability(
                $sewa->id_bus,
                $sewa->tanggal_mulai,
                $sewa->tanggal_selesai
            );
        });

        self::updating(function ($sewa) {
            if (Carbon::parse($sewa->tanggal_mulai)->isBefore(Carbon::today())) {
                throw new \Exception("Tanggal mulai tidak boleh lebih kecil dari hari ini.");
            }
            if (Carbon::parse($sewa->tanggal_selesai)->isBefore(Carbon::parse($sewa->tanggal_mulai))) {
                throw new \Exception("Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.");
            }

            self::validateBusAvailability(
                $sewa->id_bus,
                $sewa->tanggal_mulai,
                $sewa->tanggal_selesai,
                $sewa->id
            );
        });

        // Validasi ketersediaan bus
        self::creating(function ($sewa) {
            self::validateBusAvailability(
                $sewa->id_bus,
                $sewa->tanggal_mulai,
                $sewa->tanggal_selesai
            );
        });

        self::updating(function ($sewa) {
            self::validateBusAvailability(
                $sewa->id_bus,
                $sewa->tanggal_mulai,
                $sewa->tanggal_selesai,
                $sewa->id
            );
        });

        self::updating(function ($sewa) {
            if ($sewa->isDirty('status')) {
                riwayat_sewa::create([
                    'sewa_id' => $sewa->id,
                    'status_sebelumnya' => $sewa->getOriginal('status'),
                    'status_saat_ini' => $sewa->status,
                    'waktu' => now(),
                ]);
            }
        });

        static::creating(function ($sewa) {
            $sewa->id_penyewa = Auth::id();
        });
    }

    public function getTotalHargaAttribute()
    {
        return $this->lama_sewa * $this->bus->harga_sewa;
    }


    public function getLamaSewaAttribute()
    {
        $start = Carbon::parse($this->tanggal_mulai);
        $end = Carbon::parse($this->tanggal_selesai);

        return $start->isSameDay($end) ? 1 : $start->diffInDays($end) + 1;
    }

    public function calculateTotalPrice()
    {
        $total_price = 0;
        foreach ($this->bus as $bus) {
            $total_price += $bus->harga_sewa;
        }
        return $total_price;
    }
}

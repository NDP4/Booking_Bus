<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Sewa;
use App\Models\Penilaian;
use Filament\Support\Enums\IconPosition;

class PenggunaWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $jumlahKonsumen = User::where('role', 'konsumen')->count();

        $totalPendapatan = Sewa::sum('total_harga');

        // Cek apakah ada penilaian, jika tidak, set rata-rata penilaian menjadi null
        $rataRataPenilaian = Penilaian::avg('rating');
        if ($rataRataPenilaian === null) {
            $rataRataPenilaian = 'Belum ada ulasan';
        } else {
            $rataRataPenilaian = number_format($rataRataPenilaian, 2);
        }

        $formatRupiah = function (int $number): string {
            return 'Rp ' . number_format($number, 0, ',', '.');
        };

        $formatNumber = function (int $number): string {
            if ($number < 1000) {
                return (string) number_format($number, 0);
            }

            if ($number < 1000000) {
                return number_format($number / 1000, 2) . 'k';
            }

            return number_format($number / 1000000, 2) . 'm';
        };

        return [
            Stat::make('Jumlah Pengguna', $formatNumber($jumlahKonsumen))
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->description('Total pengguna')
                ->chart([5, 7, 6, 9, 12, 8, 10])
                ->color('primary'),

            Stat::make('Total Pendapatan Sewa', $formatRupiah($totalPendapatan))
                ->description('Pendapatan')
                ->descriptionIcon('heroicon-o-banknotes', IconPosition::Before)
                ->chart([2, 3, 4, 5, 6, 4, 7])
                ->color('success'),

            Stat::make('Rata-Rata Penilaian', $rataRataPenilaian)
                ->description('Rating ulasan')
                ->descriptionIcon('heroicon-o-star', IconPosition::Before)
                ->color('warning'),
        ];
    }
}

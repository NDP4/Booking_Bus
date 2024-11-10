<?php

namespace App\Filament\Exports;

use App\Models\Sewa;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SewaExporter extends Exporter
{
    protected static ?string $model = Sewa::class;

    public static function getColumns(): array
    {
        return [
            // Kolom Nama Penyewa, ambil nama dari relasi
            ExportColumn::make('penyewa')->label('Nama Penyewa')->formatStateUsing(function (Sewa $sewa) {
                return $sewa->penyewa ? $sewa->penyewa->name : 'N/A';
            }),

            // Kolom Nama Bus, ambil nama dari relasi
            ExportColumn::make('bus')->label('Nama Bus')->formatStateUsing(function (Sewa $sewa) {
                return $sewa->bus ? $sewa->bus->nama_bus : 'N/A';
            }),

            // Kolom lainnya tetap sama
            ExportColumn::make('tanggal_mulai'),
            ExportColumn::make('tanggal_selesai'),
            ExportColumn::make('jam_penjemputan'),
            ExportColumn::make('lokasi_penjemputan'),
            ExportColumn::make('tujuan'),
            ExportColumn::make('total_harga'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your sewa export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

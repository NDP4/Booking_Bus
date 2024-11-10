<?php

namespace App\Filament\Exports;

use App\Models\maintenance_item;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MaintenanceItemExporter extends Exporter
{
    protected static ?string $model = maintenance_item::class;

    public static function getColumns(): array
    {
        return [
            // Kolom No Maintenance, ambil ID dari relasi Maintenance
            ExportColumn::make('maintenance_id')
                ->label('No Maintenance')
                ->formatStateUsing(function (maintenance_item $item) {
                    return $item->maintenance->id; // Mengambil ID maintenance dari relasi
                }),

            // Kolom Nama Item
            ExportColumn::make('nama_item')
                ->label('Nama Item')
                ->formatStateUsing(function (maintenance_item $item) {
                    return $item->nama_item; // Nama item
                }),

            // Kolom Biaya, format sebagai mata uang IDR
            ExportColumn::make('biaya')
                ->label('Biaya')
                ->formatStateUsing(function (maintenance_item $item) {
                    return 'IDR ' . number_format($item->biaya, 0, ',', '.'); // Format biaya dalam IDR
                }),

            // Kolom Dibuat pada, format tanggal
            ExportColumn::make('created_at')
                ->label('Dibuat pada')
                ->formatStateUsing(function (maintenance_item $item) {
                    return $item->created_at->format('d-m-Y H:i'); // Format tanggal dibuat
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your maintenance item export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

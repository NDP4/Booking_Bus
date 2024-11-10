<?php

namespace App\Filament\Exports;

use App\Models\Maintenance;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Facades\Log;

class MaintenanceExporter extends Exporter
{
    protected static ?string $model = Maintenance::class;

    // Menentukan kolom yang akan diekspor
    public static function getColumns(): array
    {
        return [
            // Kolom Nama Bus, pastikan relasi diproses dengan benar
            ExportColumn::make('bus_id')
                ->label('Nama Bus')
                ->formatStateUsing(function (Maintenance $maintenance) {
                    $busName = $maintenance->bus ? $maintenance->bus->nama_bus : 'N/A';
                    Log::info('Bus ID ' . $maintenance->bus_id . ' resolved to: ' . $busName);
                    return $busName;
                }),


            // Kolom Tanggal, memformat tanggal
            ExportColumn::make('tanggal')
                ->label('Tanggal')
                ->formatStateUsing(function (Maintenance $maintenance) {
                    return $maintenance->tanggal ? $maintenance->tanggal->format('d-m-Y') : 'N/A';
                }),

            // Kolom Deskripsi
            ExportColumn::make('deskripsi')
                ->label('Deskripsi')
                ->formatStateUsing(fn(Maintenance $maintenance) => $maintenance->deskripsi ?? 'N/A'),

            // Kolom Status
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn(Maintenance $maintenance) => $maintenance->status ?? 'N/A'),
        ];
    }

    // Pesan setelah ekspor selesai
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your maintenance export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

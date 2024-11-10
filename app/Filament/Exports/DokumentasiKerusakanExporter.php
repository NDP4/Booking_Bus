<?php

namespace App\Filament\Exports;

use App\Models\dokumentasi_kerusakan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DokumentasiKerusakanExporter extends Exporter
{
    protected static ?string $model = dokumentasi_kerusakan::class;

    public static function getColumns(): array
    {
        return [
            // Maintenance ID
            ExportColumn::make('maintenance_id')
                ->label('Maintenance ID')
                ->formatStateUsing(function (dokumentasi_kerusakan $item) {
                    return $item->maintenance_id; // Accessing maintenance_id directly
                }),

            // Foto (Image URL)
            ExportColumn::make('foto')
                ->label('Foto')
                ->formatStateUsing(function (dokumentasi_kerusakan $item) {
                    return $item->foto; // Export file path or URL of the uploaded photo
                }),

            // Deskripsi (Description)
            ExportColumn::make('deskripsi')
                ->label('Deskripsi')
                ->formatStateUsing(function (dokumentasi_kerusakan $item) {
                    return $item->deskripsi; // Description of the damage
                }),

            // Dibuat pada (Created At)
            ExportColumn::make('created_at')
                ->label('Dibuat Pada')
                ->formatStateUsing(function (dokumentasi_kerusakan $item) {
                    return $item->created_at->format('d-m-Y H:i'); // Format created at timestamp
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your dokumentasi kerusakan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

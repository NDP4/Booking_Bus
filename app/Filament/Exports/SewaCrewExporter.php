<?php

namespace App\Filament\Exports;

use App\Models\sewa_crew;
use App\Models\SewaCrew;
use App\Models\CrewSewa;
use App\Models\Sewa;
use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SewaCrewExporter extends Exporter
{
    protected static ?string $model = sewa_crew::class;

    public static function getColumns(): array
    {
        return [
            // Kolom ID Sewa, ambil ID dari relasi Sewa
            ExportColumn::make('sewa_id')->label('ID Sewa')->formatStateUsing(function (sewa_crew $crewSewa) {
                return 'RP' . $crewSewa->sewa->id;
            }),

            // Kolom Keberangkatan, ambil tanggal mulai dari relasi Sewa
            ExportColumn::make('keberangkatan')->label('Keberangkatan')->formatStateUsing(function (sewa_crew $crewSewa) {
                // Ensure tanggal_mulai is a Carbon instance before calling format
                return $crewSewa->sewa->tanggal_mulai instanceof \Carbon\Carbon
                    ? $crewSewa->sewa->tanggal_mulai->format('d-m-Y H:i')
                    : $crewSewa->sewa->tanggal_mulai; // Return as is if it's not a Carbon instance
            }),

            // Kolom Tujuan, ambil tujuan dari relasi Sewa
            ExportColumn::make('tujuan')->label('Tujuan')->formatStateUsing(function (sewa_crew $crewSewa) {
                return $crewSewa->sewa->tujuan;
            }),

            // Kolom Nama Crew, ambil nama dari relasi User
            ExportColumn::make('crew_name')->label('Nama Crew')->formatStateUsing(function (sewa_crew $crewSewa) {
                return $crewSewa->crew->name;
            }),

            // Kolom Telp Crew, ambil nomor telepon dari relasi User
            ExportColumn::make('crew_phone')->label('Telp Crew')->formatStateUsing(function (sewa_crew $crewSewa) {
                return 'https://wa.me/' . preg_replace('/^0/', '62', $crewSewa->crew->phone_number);
            }),

            // Kolom Ditugaskan Pada, ambil created_at dari CrewSewa
            ExportColumn::make('created_at')->label('Ditugaskan Pada')->formatStateUsing(function (sewa_crew $crewSewa) {
                return $crewSewa->created_at instanceof \Carbon\Carbon
                    ? $crewSewa->created_at->format('d-m-Y H:i')
                    : $crewSewa->created_at; // Return as is if it's not a Carbon instance
            }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your sewa crew export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

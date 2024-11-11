<?php

namespace App\Filament\Exports;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Facades\Log;

class InvoiceExporter extends Exporter
{
    protected static ?string $model = Invoice::class;

    public function export(): mixed
    {
        // Ambil data invoice yang akan diekspor
        $invoice = Invoice::find($this->record->id);  // Atau jika bulk, ambil data dari $this->records

        // Buat view untuk PDF
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));  // Buat view yang sesuai

        // Menghasilkan file PDF
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }

    public static function getColumns(): array
    {
        return [
            // Sewa ID
            ExportColumn::make('sewa_id')
                ->label('Sewa ID')
                ->formatStateUsing(function (Invoice $invoice) {
                    return 'RP' . $invoice->sewa_id; // Format with RP
                }),

            // Jumlah (Amount)
            ExportColumn::make('jumlah')
                ->label('Jumlah')
                ->formatStateUsing(function (Invoice $invoice) {
                    return number_format($invoice->jumlah, 0, ',', '.'); // Format currency
                }),

            ExportColumn::make('tanggal_terbit')
                ->label('Tanggal Terbit'),

            ExportColumn::make('status')
                ->label('Status'),


        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your invoice export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

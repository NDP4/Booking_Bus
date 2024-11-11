<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    //
    public function updateStatus($sewaId, $status)
    {
        $invoice = invoice::where('sewa_id', $sewaId)->first();
        if ($invoice) {
            $invoice->status = $status;
            $invoice->save();
            return true;
        }
        return false;
    }

    // Download invoice as PDF
    public function downloadPdf(Invoice $invoice)
    {
        // Load the necessary relationships
        $invoice->load(['sewa.penyewa', 'sewa.bus']);

        // Debugging: Check data
        // dd($invoice->sewa);

        // Convert the logo image to base64
        $logoPath = public_path('images/logo_rizky_putra_168.png');
        $logoBase64 = base64_encode(file_get_contents($logoPath));

        // Generate PDF using DomPDF
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice', 'logoBase64'));

        // Return the PDF as a download response
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }
}

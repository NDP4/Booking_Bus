<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Transaction;
use App\Http\Controllers\InvoiceController;

class SewaController extends Controller
{
    public function pay($id)
    {
        // Ambil data Sewa berdasarkan ID
        $sewa = Sewa::findOrFail($id);

        // Mengatur konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.environment') === 'production';
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
        $transaction_details = [
            'order_id' => 'SEWA-' . $sewa->id,  // pastikan order_id unik
            'gross_amount' => (int) $sewa->total_harga,  // Jumlah harga total
        ];

        $customer_details = [
            'first_name'    => $sewa->penyewa->name,
            'email'         => $sewa->penyewa->email,
            'phone'         => $sewa->penyewa->phone,
        ];

        $item_details = [
            [
                'id'       => 'SEWA-' . $sewa->id,
                'price'    => $sewa->total_harga,
                'quantity' => 1,
                'name'     => 'Penyewaan Bus: ' . $sewa->bus->nama_bus,
            ],
        ];

        $payment_data = [
            'transaction_details' => $transaction_details,
            'customer_details'    => $customer_details,
            'item_details'        => $item_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($payment_data);
            Log::info('Midtrans Snap Token: ' . $snapToken);

            return view('payment', compact('snapToken', 'sewa'));
        } catch (\Exception $e) {
            Log::error('Error generating snap token: ' . $e->getMessage());
            return redirect()->route('filament.resources.sewas.index')->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
        }
    }

    public function payLanjutan($id)
    {
        // Ambil data sewa berdasarkan ID
        $sewa = Sewa::findOrFail($id);

        $order_id = 'SEWA-' . $sewa->id;

        try {
            // Cek status transaksi melalui API Midtrans
            $status = Transaction::status($order_id);

            if (is_array($status)) {
                $transaction_status = $status['transaction_status'] ?? '';
            } elseif (is_object($status)) {
                $transaction_status = $status->transaction_status ?? '';
            } else {
                throw new \Exception("Unexpected response format");
            }

            // Menangani status transaksi
            if ($transaction_status == 'settlement') {
                // Pembayaran sudah selesai
                return redirect()->route('filament.resources.sewas.edit', ['record' => $sewa->id])
                    ->with('message', 'Pembayaran Anda sudah selesai.');
            } elseif ($transaction_status == 'pending') {
                // Pembayaran tertunda
                return view('payment_lanjutan', compact('sewa', 'status'));
            } else {
                // Pembayaran gagal atau dibatalkan
                return redirect()->route('filament.resources.sewas.index')
                    ->with('error', 'Pembayaran Anda gagal atau dibatalkan.');
            }
        } catch (\Exception $e) {
            Log::error('Error checking payment status: ' . $e->getMessage());
            return redirect()->route('filament.resources.sewas.index')
                ->with('error', 'Terjadi kesalahan saat memeriksa status pembayaran.');
        }
    }

    /**
     * Callback untuk menangani hasil pembayaran dari Midtrans
     */
    public function paymentCallback(Request $request, $id)
    {
        // Ambil data Sewa berdasarkan ID
        $sewa = Sewa::findOrFail($id);
        $order_id = 'SEWA-' . $sewa->id;

        try {
            // Cek status transaksi melalui API Midtrans
            $status = Transaction::status($order_id);

            if (is_array($status)) {
                $transaction_status = $status['transaction_status'] ?? '';
            } elseif (is_object($status)) {
                $transaction_status = $status->transaction_status ?? '';
            } else {
                throw new \Exception("Unexpected response format");
            }

            // Tangani status pembayaran
            if ($transaction_status == 'settlement') {
                // Pembayaran berhasil
                $sewa->status = 'Dibayar';
                $sewa->save();

                // Update status Invoice
                $invoiceController = new InvoiceController();
                $invoiceController->updateStatus($sewa->id, 'Dibayar');

                return redirect()->route('filament.resources.sewas.index')
                    ->with('success', 'Pembayaran berhasil, status sewa dan invoice telah diperbarui.');
            } elseif ($transaction_status == 'pending') {
                return redirect()->route('filament.resources.sewas.index')
                    ->with('message', 'Pembayaran Anda tertunda, harap tunggu konfirmasi.');
            } else {
                return redirect()->route('filament.resources.sewas.index')
                    ->with('error', 'Pembayaran Anda gagal atau dibatalkan.');
            }
        } catch (\Exception $e) {
            Log::error('Error processing payment callback: ' . $e->getMessage());
            return redirect()->route('filament.resources.sewas.index')
                ->with('error', 'Terjadi kesalahan saat memproses callback pembayaran.');
        }
    }

    public function paymentSuccess($id)
    {
        // Ambil data sewa berdasarkan ID
        $sewa = Sewa::findOrFail($id);

        // Pembayaran sukses, redirect ke halaman list sewa di Filament
        return redirect()->route('filament.resources.sewas.index')
            ->with('success', 'Pembayaran berhasil, status sewa telah diperbarui.');
    }
}

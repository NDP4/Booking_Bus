<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Midtrans\Transaction;

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
            // $snapToken = Snap::getSnapToken($payment_data);
            Log::error('Error generating snap token: ' . $e->getMessage());
            return redirect()->route('sewa.lanjutan')->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
        }
    }

    public function payLanjutan($id)
    {
        // Ambil data sewa berdasarkan ID
        $sewa = Sewa::findOrFail($id);


        $order_id = 'SEWA-' . $sewa->id;

        try {

            $status = Transaction::status($order_id);

            if (is_array($status)) {
                $transaction_status = $status['transaction_status'] ?? '';
            } elseif (is_object($status)) {
                $transaction_status = $status->transaction_status ?? '';
            } else {
                throw new \Exception("Unexpected response format");
            }

            if ($transaction_status == 'settlement') {

                return redirect()->route('sewa.show', ['id' => $sewa->id])
                    ->with('message', 'Pembayaran Anda sudah selesai.');
            } elseif ($transaction_status == 'pending') {

                return view('payment_lanjutan', compact('sewa', 'status'));
            } else {
                return redirect()->route('sewa.index')
                    ->with('error', 'Pembayaran Anda gagal atau dibatalkan.');
            }
        } catch (\Exception $e) {
            Log::error('Error checking payment status: ' . $e->getMessage());
            return redirect()->route('sewa.index')
                ->with('error', 'Terjadi kesalahan saat memeriksa status pembayaran.');
        }
    }


    public function paymentSuccess($id)
    {
        $sewa = Sewa::findOrFail($id);
        return view('payment_sukses', compact('sewa'));
    }
}

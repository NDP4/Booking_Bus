<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Midtrans\Snap;
use Midtrans\Config;
use Carbon\Carbon;  // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Transaction;
use App\Http\Controllers\InvoiceController;

class SewaController extends Controller
{
    // Modify the validateAndUpdateStatus method
    private function validateAndUpdateStatus(Sewa $sewa)
    {
        try {
            $today = Carbon::now()->startOfDay();
            $startDate = Carbon::parse($sewa->tanggal_mulai)->startOfDay();
            $endDate = Carbon::parse($sewa->tanggal_selesai)->startOfDay();

            // Skip date validation when only updating status
            DB::beginTransaction();

            if ($sewa->status !== 'Dibatalkan') {
                if ($today->between($startDate, $endDate)) {
                    $sewa->timestamps = false; // Disable timestamps temporarily
                    $sewa->status = 'Berlangsung';
                    $sewa->save(['timestamps' => false]); // Save without triggering events
                    $sewa->timestamps = true; // Re-enable timestamps
                } elseif ($today->isAfter($endDate)) {
                    $sewa->timestamps = false;
                    $sewa->status = 'Selesai';
                    $sewa->save(['timestamps' => false]);
                    $sewa->timestamps = true;
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating rental status: ' . $e->getMessage());
        }
    }

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
        try {
            Log::info('Payment callback received:', [
                'sewa_id' => $id,
                'request' => $request->all()
            ]);

            $sewa = Sewa::findOrFail($id);
            $transaction_status = $request->transaction_status ?? null;

            DB::beginTransaction();

            switch ($transaction_status) {
                case 'settlement':
                case 'capture':
                    $sewa->update([
                        'status' => 'Diproses',
                        'payment_status' => 'paid'
                    ]);
                    $this->validateAndUpdateStatus($sewa); // Add this line
                    $message = 'Pembayaran berhasil';
                    break;

                case 'pending':
                    $sewa->update([
                        'status' => 'Menunggu Pembayaran',
                        'payment_status' => 'pending'
                    ]);
                    $message = 'Menunggu pembayaran';
                    break;

                case 'deny':
                case 'failed':
                    $sewa->update([
                        'status' => 'Gagal',
                        'payment_status' => 'failed'
                    ]);
                    $message = 'Pembayaran gagal';
                    break;

                case 'cancel':
                case 'expire':
                    $sewa->update([
                        'status' => 'Dibatalkan',
                        'payment_status' => 'cancelled'
                    ]);
                    $message = 'Pembayaran dibatalkan';
                    break;

                default:
                    throw new \Exception('Unknown transaction status');
            }

            DB::commit();

            Log::info('Payment status updated:', [
                'sewa_id' => $id,
                'status' => $sewa->status,
                'payment_status' => $sewa->payment_status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'redirect_url' => '/dashboard/history'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment callback error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses pembayaran'
            ], 500);
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

    public function cancel(Sewa $sewa)
    {
        try {
            if (!$sewa->status || $sewa->status !== 'Diproses') {
                return back()->with('error', 'Hanya pesanan dengan status Diproses yang dapat dibatalkan');
            }

            DB::beginTransaction();

            $sewa->update(['status' => 'Dibatalkan']);

            // Log the cancellation
            Log::info('Pesanan dibatalkan', [
                'sewa_id' => $sewa->id ?? null,
                'user_id' => Auth::id()
            ]);

            DB::commit();

            return back()->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error cancelling order: ' . $e->getMessage());
            return back()->with('error', 'Gagal membatalkan pesanan. Silakan coba lagi.');
        }
    }

    public function store(Request $request)
    {
        // Add validation
        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'jam_penjemputan' => 'required',
            'lokasi_penjemputan' => 'required|string',
            'pickup_lat' => 'nullable|numeric',
            'pickup_lng' => 'nullable|numeric',
            'tujuan' => 'required|string',
            'total_harga' => 'required|numeric',
            'id_bus' => 'required|exists:buses,id',
            'id_penyewa' => 'required|exists:users,id',
            'lama_sewa' => 'required|numeric'
        ]);

        $sewa = Sewa::create($validated);
        $this->validateAndUpdateStatus($sewa); // Add this line

        // Generate snap token and save it
        $params = [
            'transaction_details' => [
                'order_id' => 'SEWA-' . $sewa->id . '-' . time(),
                'gross_amount' => (int) $sewa->total_harga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => [
                [
                    'id' => $sewa->id_bus,
                    'price' => $sewa->bus->harga_sewa,
                    'quantity' => $sewa->lama_sewa,
                    'name' => $sewa->bus->nama_bus,
                ]
            ],
        ];

        $snapToken = Snap::getSnapToken($params);  // Use imported Snap class
        $sewa->update(['snap_token' => $snapToken]);

        return $sewa;
    }
}

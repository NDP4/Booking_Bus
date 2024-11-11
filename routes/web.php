<?php

use App\Models\Sewa;
use App\Models\sewa_crew;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SewaController;
use Filament\Facades\Filament;
use App\Models\Invoice;
use App\Filament\Resources\SewaResource;

Route::get('/', function () {
    return view('welcome');
});


// download pdf
Route::get('/invoice/{invoice}/download_pdf', [InvoiceController::class, 'downloadPdf'])->name('invoice.download_pdf');
Route::get('/invoice/{invoice}/download', [InvoiceController::class, 'downloadPdf']);
Route::get('/invoice/{invoice}/download', [InvoiceController::class, 'downloadPdf'])->name('invoice.download_pdf');
// tanpa route
// Route::get('/', function () {
//     return inertia('Home');
// });
// menambahkan params
Route::get('/', function () {
    return inertia('Home', ['nama' => 'Po. Rizky Putra 168']);
});
// atau seperti ini
// Route::inertia('/', 'Home');
Route::inertia('/about', 'About');


// File routes/web.php
// Route::get('/admin/sewas', [SewaResource::class, 'index'])->name('filament.resources.sewas.index');

// penulisan menggunakan route
// Route::get('/', function () {
//     return Inertia::render('Home');
// });

// Route::get('/sewa/{sewa}', [SewaController::class, 'show'])->name('sewa.show');


// Route::middleware('auth')->get('/sewa-crew/{id}', function ($id) {
//     // Ambil data sewa_crew berdasarkan ID
//     $sewaCrew = sewa_crew::findOrFail($id);

//     if (auth()->user()->can('view', $sewaCrew)) {
//         // Jika diizinkan, tampilkan data
//         return response()->json($sewaCrew);
//     }

//     return response()->json(['message' => 'Unauthorized'], 403);
// });



Route::get('/chatbot', function () {
    return view('chatbot/chat_bot');
})->name('chatbot');

// mengarah ke pembayaran midtrans menggunakan blade laravel
// Route untuk memulai pembayaran
Route::get('sewa/{id}/pay', [SewaController::class, 'pay'])->name('sewa.pay');

// // Route untuk melanjutkan pembayaran jika statusnya pending
// Route::get('/sewa/{id}/lanjutan', [SewaController::class, 'payLanjutan'])->name('sewa.lanjutan');

// // Route untuk callback dari Midtrans
// // Route::get('/sewa/{id}/payment-callback', [SewaController::class, 'paymentCallback'])->name('sewa.paymentCallback');

// // Route untuk callback dari Midtrans (ubah ke POST)
// Route::post('/sewa/{id}/payment-callback', [SewaController::class, 'paymentCallback'])->name('sewa.paymentCallback');


// // Route untuk halaman sukses setelah pembayaran berhasil
// Route::get('/sewa/{id}/sukses', [SewaController::class, 'paymentSuccess'])->name('sewa.sukses');

// // **Perhatikan modifikasi berikut ini untuk Filament Resource**
// // Jika kamu menggunakan Filament Resource, maka pastikan route-nya merujuk ke Filament's resources
// Route::get('/sewa', [SewaController::class, 'index'])->name('sewa.index');

// // Untuk menyesuaikan dengan Filament, kita akan menggunakan Filament resource routes.
// // Gunakan `filament.resources.sewas.index` untuk menampilkan daftar sewa (resource list)
// Route::get('/sewa', [SewaController::class, 'index'])->name('filament.resources.sewas.index');

// // **Route untuk detail Sewa menggunakan Filament** (pastikan record adalah ID sewa yang dimaksud)
// Route::get('/sewa/{id}', [SewaController::class, 'show'])->name('filament.resources.sewas.edit');

// Routes untuk pembayaran dan callback
// Route::get('/sewa/{id}/pay', [SewaController::class, 'pay'])->name('sewa.pay');
// Route::get('/sewa/{id}/pay-lanjutan', [SewaController::class, 'payLanjutan'])->name('sewa.payLanjutan');
Route::post('/sewa/{id}/payment-callback', [SewaController::class, 'paymentCallback'])->name('sewa.paymentCallback');


// mengarah ke pembayaran midtrans menggunakan react
// Route::get('sewa/{id}/pay', function ($id) {
//     return Inertia::render('Payment', ['sewa_id' => $id]);
// })->name('sewa.pay');

// Route::get('payment/{id}', function ($id) {
//     // Pass data Sewa ke halaman React
//     $sewa = Sewa::findOrFail($id);
//     return Inertia::render('Payment', [
//         'sewa' => $sewa,
//     ]);
// })->name('payment.show');

// payment lanjutan bagi yang pending
// Route::get('/sewa/{id}/lanjutan', [SewaController::class, 'payLanjutan'])->name('sewa.lanjutan');

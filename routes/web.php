<?php

use App\Models\Sewa;
use App\Models\sewa_crew;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\SewaController;

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('sewa/{id}/pay', [SewaController::class, 'pay'])->name('sewa.pay');
Route::get('/sewa/{id}/pay', [SewaController::class, 'pay'])->name('sewa.pay');
Route::get('/sewa/{id}/lanjutan', [SewaController::class, 'payLanjutan'])->name('sewa.lanjutan');
Route::get('/sewa/{id}/sukses', [SewaController::class, 'paymentSuccess'])->name('sewa.sukses');
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

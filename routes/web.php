<?php

use App\Models\Sewa;
use App\Models\Bus;
use App\Models\User;
use App\Models\sewa_crew;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SewaController;
use Filament\Facades\Filament;
use App\Models\Invoice;
use App\Filament\Resources\SewaResource;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;  // Add this line
use Midtrans\Config as MidtransConfig;
use Illuminate\Support\Facades\Hash;  // Add this at the top with other imports

// Add Midtrans configuration
MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
MidtransConfig::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
MidtransConfig::$isSanitized = true;
MidtransConfig::$is3ds = true;

Route::get('/', function () {
    $testimonials = Penilaian::with(['pengguna', 'sewa.bus'])
        ->where('rating', '>=', 3)  // Changed from 4 to 3 to include more testimonials
        ->latest()
        ->limit(5)  // Changed from take(5) to limit(5) for clarity
        ->get()
        ->map(function ($penilaian) {
            return [
                'quote' => $penilaian->ulasan,
                'name' => $penilaian->pengguna->name ?? 'Anonymous',
                'designation' => $penilaian->sewa->bus->nama_bus ?? 'Bus Customer',
                'src' => $penilaian->pengguna->avatar_url
                    ? asset('storage/' . $penilaian->pengguna->avatar_url)
                    : asset('storage/avatars/default-avatar.png'),
                'title' => 'Pelanggan'
            ];
        })
        ->values()  // Reset array keys
        ->all();    // Convert to plain array

    // Debug the testimonials count
    Log::info('Number of testimonials:', ['count' => count($testimonials)]);
    Log::info('Testimonials data:', $testimonials);

    return inertia('Home', [
        'stats' => [
            'total_buses' => Bus::count(),
            'total_users' => User::count(),
            'total_sewas' => Sewa::count()
        ],
        'auth' => [
            'user' => Auth::user()
        ],
        'testimonials' => $testimonials
    ]);
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
// Route::get('/', function () {
//     return inertia('Home', [
//         'stats' => [
//             'total_buses' => Bus::count(),
//             'total_users' => User::count(),
//             'total_sewas' => Sewa::count()
//         ],
//         'auth' => [
//             'user' => Auth::user()
//         ]
//     ]);
// });
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
Route::post('/sewa/{id}/payment-callback', [SewaController::class, 'paymentCallback'])->name('sewa.paymentCallback');


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

// Add this route for handling logout
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Add these routes for products
Route::get('/product', function (Request $request) {
    $buses = Bus::query()
        ->when($request->search, function ($query, $search) {
            $query->where('nama_bus', 'like', "%{$search}%"); // Only search by nama_bus
        })
        ->when($request->kapasitas, function ($query, $kapasitas) {
            $query->where('kapasitas', '=', intval($kapasitas));
        })
        ->when($request->harga_max && $request->harga_min, function ($query) use ($request) {
            $query->whereBetween('harga_sewa', [
                intval($request->harga_min),
                intval($request->harga_max)
            ]);
        })
        ->get()
        ->map(function ($bus) use ($request) {
            $isBooked = false;
            $bookingDates = [];

            if ($request->tanggal_mulai && $request->tanggal_selesai) {
                $bookings = $bus->sewas()
                    ->where('status', '!=', 'Dibatalkan')
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                            ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                            ->orWhere(function ($q) use ($request) {
                                $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                                    ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                            });
                    })
                    ->get();

                $isBooked = $bookings->isNotEmpty();
                $bookingDates = $bookings->map(function ($sewa) {
                    return [
                        'start' => $sewa->tanggal_mulai,
                        'end' => $sewa->tanggal_selesai
                    ];
                });
            }

            return [
                'id' => $bus->id,
                'nama_bus' => $bus->nama_bus,
                'kapasitas' => $bus->kapasitas,
                'harga_sewa' => $bus->harga_sewa,
                'deskripsi' => $bus->deskripsi,
                'image' => $bus->foto_bus ? asset('storage/' . $bus->foto_bus) : null,
                'status' => $bus->status,
                'is_booked' => $isBooked,
                'booking_dates' => $bookingDates
            ];
        })
        ->sortBy('is_booked') // Sort available buses first
        ->values(); // Reset array keys

    // Add debug logging for search
    Log::info('Search query:', [
        'search_term' => $request->search,
        'results_count' => $buses->count(),
        'search_by' => 'nama_bus'
    ]);

    return inertia('Product', [
        'buses' => $buses,
        'uniqueCapacities' => Bus::distinct()->pluck('kapasitas')->sort()->values(), // Add this line to get unique capacities
        'priceRange' => [
            'min' => Bus::min('harga_sewa'),
            'max' => Bus::max('harga_sewa')
        ],
        'auth' => ['user' => Auth::user()],
        'filters' => $request->only(['tanggal_mulai', 'tanggal_selesai', 'kapasitas', 'harga_min', 'harga_max', 'search'])
    ]);
})->name('product.index');

Route::get('/product/{id}', function ($id) {
    $bus = Bus::findOrFail($id);

    return inertia('ProductDetail', [
        'bus' => [
            'id' => $bus->id,
            'nama_bus' => $bus->nama_bus,
            'kapasitas' => $bus->kapasitas,
            'harga_sewa' => $bus->harga_sewa,
            'deskripsi' => $bus->deskripsi,
            'image' => $bus->foto_bus ? asset('storage/' . $bus->foto_bus) : null,
            'fasilitas' => $bus->fasilitas,
            'status' => $bus->status,
        ],
        'auth' => ['user' => Auth::user()]
    ]);
})->name('product.show');

// Add route for showing sewa form
Route::get('/product/{id}/sewa', function ($id) {
    $bus = Bus::findOrFail($id);

    return inertia('DetailSewa', [
        'bus' => [
            'id' => $bus->id,
            'nama_bus' => $bus->nama_bus,
            'kapasitas' => $bus->kapasitas,
            'harga_sewa' => $bus->harga_sewa,
            'deskripsi' => $bus->deskripsi,
            'image' => $bus->foto_bus ? asset('storage/' . $bus->foto_bus) : null,
            'fasilitas' => $bus->fasilitas,
            'status' => $bus->status,
        ],
        'auth' => ['user' => Auth::user()]
    ]);
})->middleware(['auth'])->name('product.sewa');

// Add route for handling sewa submission
Route::post('/sewa', function (Request $request) {
    try {
        // Validate inputs first
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

        // Add debug logging
        Log::info('Validated data:', $validated);

        // Check bus availability
        if (Sewa::validateBusAvailability($request->id_bus, $request->tanggal_mulai, $request->tanggal_selesai)) {
            Log::warning('Bus not available for selected dates');
            return back()->withErrors([
                'availability' => 'Bus sudah dipesan pada periode waktu yang sama.'
            ])->withInput();
        }

        // Create new sewa
        $sewa = Sewa::create($validated);
        $bus = Bus::find($request->id_bus);

        // Make sure Midtrans is properly configured
        if (!MidtransConfig::$serverKey) {
            Log::error('Midtrans server key not found');
            throw new \Exception('Midtrans configuration error');
        }

        // Create Midtrans transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => 'SEWA-' . $sewa->id . '-' . time(), // Add timestamp for uniqueness
                'gross_amount' => (int) $sewa->total_harga,
            ],
            'customer_details' => [
                'first_name' => $request->user()->name,
                'email' => $request->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $sewa->id_bus,
                    'price' => $bus->harga_sewa,
                    'quantity' => $sewa->lama_sewa,
                    'name' => $bus->nama_bus,
                ]
            ],
        ];

        Log::info('Attempting to generate Snap Token with params:', $params);

        // Generate Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        if (!$snapToken) {
            throw new \Exception('Failed to generate Snap Token');
        }

        Log::info('Snap Token generated successfully:', ['token' => $snapToken]);

        return inertia('Payment', [
            'sewa' => $sewa,
            'bus' => $bus,
            'snapToken' => $snapToken,
        ]);
    } catch (\Exception $e) {
        Log::error('Payment processing error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()->withErrors([
            'error' => 'Terjadi kesalahan dalam pemrosesan pembayaran. Silakan coba lagi.'
        ])->withInput();
    }
})->middleware(['auth'])->name('sewa.store');

// Add route for canceling sewa
Route::post('/sewa/{id}/cancel', function ($id) {
    try {
        $sewa = Sewa::findOrFail($id);
        $sewa->update(['status' => 'Dibatalkan']);

        return redirect()->route('product.index')
            ->with('success', 'Pesanan berhasil dibatalkan');
    } catch (\Exception $e) {
        Log::error('Sewa cancellation error: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Gagal membatalkan pesanan']);
    }
})->middleware(['auth'])->name('sewa.cancel');

// Add these routes after your existing routes
Route::inertia('/about', 'About');

// Dashboard Routes
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/profile', function () {
        return inertia('Dashboard/Profile', [
            'auth' => ['user' => Auth::user()]
        ]);
    })->name('dashboard.profile');

    Route::post('/profile', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:1024',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());  // Get a fresh instance of the User model

        // Update basic info
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone']
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_url = $path;
        }

        // Handle password change
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    })->name('dashboard.profile.update');

    // Move your existing history route here
    Route::get('/history', function () {
        $sewas = Sewa::with(['bus'])
            ->where('id_penyewa', Auth::id())
            ->latest()
            ->get()
            ->map(function ($sewa) {
                return [
                    'id' => $sewa->id,
                    'bus_name' => $sewa->bus->nama_bus,
                    'bus_image' => $sewa->bus->foto_bus ? asset('storage/' . $sewa->bus->foto_bus) : null,
                    'start_date' => $sewa->tanggal_mulai,
                    'end_date' => $sewa->tanggal_selesai,
                    'pickup_time' => $sewa->jam_penjemputan,
                    'location' => $sewa->lokasi_penjemputan,
                    'destination' => $sewa->tujuan,
                    'total_price' => $sewa->total_harga,
                    'status' => $sewa->status,
                    'created_at' => $sewa->created_at->format('d M Y H:i'),
                ];
            });

        return inertia('Dashboard/History', [
            'sewas' => $sewas,
            'auth' => ['user' => Auth::user()]
        ]);
    })->name('dashboard.history');
});

Route::get('/history', function () {
    $sewas = Sewa::with(['bus'])
        ->where('id_penyewa', Auth::id())
        ->latest()
        ->get()
        ->map(function ($sewa) {
            return [
                'id' => $sewa->id,
                'bus_name' => $sewa->bus->nama_bus,
                'bus_image' => $sewa->bus->foto_bus ? asset('storage/' . $sewa->bus->foto_bus) : null,
                'start_date' => $sewa->tanggal_mulai,
                'end_date' => $sewa->tanggal_selesai,
                'pickup_time' => $sewa->jam_penjemputan,
                'location' => $sewa->lokasi_penjemputan,
                'destination' => $sewa->tujuan,
                'total_price' => $sewa->total_harga,
                'status' => $sewa->status,
                'created_at' => $sewa->created_at->format('d M Y H:i'),
            ];
        });

    return inertia('History', [
        'sewas' => $sewas,
        'auth' => ['user' => Auth::user()]
    ]);
})->middleware(['auth'])->name('history');

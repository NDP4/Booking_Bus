<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Bus;
use App\Models\User;
use App\Models\Sewa;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $testimonials = Penilaian::with(['pengguna', 'sewa.bus'])
                ->where('rating', '>=', 3)  // Changed from 4 to 3
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($penilaian) {
                    return [
                        'quote' => $penilaian->ulasan,
                        'name' => $penilaian->pengguna->name,
                        'designation' => $penilaian->sewa->bus->nama_bus,
                        'src' => '/images/default-avatar.png'
                    ];
                })
                ->toArray();

            return Inertia::render('Home', [
                'auth' => ['user' => Auth::user()],
                'stats' => [
                    'total_buses' => Bus::count(),
                    'total_users' => User::count(),
                    'total_sewas' => Sewa::count(),
                ],
                'testimonials' => $testimonials
            ]);
        } catch (\Exception $e) {
            Log::error('Error in testimonials:', ['error' => $e->getMessage()]);
            return Inertia::render('Home', [
                'auth' => ['user' => Auth::user()],
                'stats' => [
                    'total_buses' => Bus::count(),
                    'total_users' => User::count(),
                    'total_sewas' => Sewa::count(),
                ],
                'testimonials' => []
            ]);
        }
    }
}

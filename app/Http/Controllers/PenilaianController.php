<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function store(Request $request, Sewa $sewa)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:500',
        ]);

        // Check if rental is completed and user is authorized
        if ($sewa->status !== 'Selesai' || $sewa->id_penyewa !== Auth::id()) {
            return back()->with('error', 'Tidak dapat memberikan ulasan');
        }

        // Check if review already exists
        if ($sewa->penilaian()->exists()) {
            return back()->with('error', 'Ulasan sudah diberikan');
        }

        $penilaian = new Penilaian([
            'rating' => $validated['rating'],
            'ulasan' => $validated['ulasan'],
            'penyewa_id' => Auth::id(), // Changed from id_pengguna to penyewa_id
            'sewa_id' => $sewa->id,
        ]);

        $sewa->penilaian()->save($penilaian);

        return back()->with('success', 'Ulasan berhasil dikirim');
    }

    public function getReviews($busId)
    {
        $reviews = Penilaian::join('sewas', 'penilaians.sewa_id', '=', 'sewas.id')
            ->join('users', 'penilaians.penyewa_id', '=', 'users.id')
            ->where('sewas.id_bus', $busId)
            ->select('penilaians.*', 'users.name as user_name')
            ->get();

        $averageRating = $reviews->avg('rating');

        return response()->json([
            'reviews' => $reviews,
            'average_rating' => round($averageRating, 1),
            'review_count' => $reviews->count()
        ]);
    }
}

public function show($id)
{
    $bus = Bus::with(['sewas' => function ($query) {
        $query->where('status', '!=', 'Dibatalkan');
    }])->findOrFail($id);

    // Fetch reviews for this bus
    $reviews = Penilaian::join('sewas', 'penilaians.sewa_id', '=', 'sewas.id')
        ->join('users', 'penilaians.penyewa_id', '=', 'users.id')
        ->where('sewas.id_bus', $bus->id)
        ->select('penilaians.*', 'users.name as user_name')
        ->get();

    // Calculate average rating
    $averageRating = $reviews->avg('rating');

    return Inertia::render('ProductDetail', [
        'bus' => array_merge($bus->toArray(), [
            'reviews' => $reviews,
            'average_rating' => round($averageRating, 1),
            'review_count' => $reviews->count()
        ]),
        'auth' => ['user' => Auth::user()]
    ]);
}

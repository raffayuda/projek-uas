<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Peminjaman;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        
        // Check if user owns this booking
        if ($peminjaman->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if booking is completed
        if ($peminjaman->status_pinjam !== 'Selesai') {
            return response()->json(['error' => 'Booking belum selesai'], 400);
        }

        // Check if rating already exists
        $existingRating = Rating::where('peminjaman_id', $request->peminjaman_id)->first();
        if ($existingRating) {
            return response()->json(['error' => 'Rating sudah diberikan'], 400);
        }

        // Create rating
        $rating = Rating::create([
            'peminjaman_id' => $request->peminjaman_id,
            'user_id' => Auth::id(),
            'armada_id' => $peminjaman->armada_id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        // Update armada average rating
        $this->updateArmadaRating($peminjaman->armada_id);

        return response()->json([
            'success' => true,
            'message' => 'Rating berhasil disimpan',
            'rating' => $rating
        ]);
    }

    private function updateArmadaRating($armadaId)
    {
        $averageRating = Rating::where('armada_id', $armadaId)->avg('rating');
        
        Armada::where('id', $armadaId)->update([
            'rating' => round($averageRating, 1)
        ]);
    }
}

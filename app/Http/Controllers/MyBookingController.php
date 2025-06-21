<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyBookingController extends Controller
{

    public function index()
    {
        $bookings = Peminjaman::with([
            'armada.jenisKendaraan',
            'pengambilan',
            'pengembalian',
            'pembayaran',
            'rating'
        ])
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('mybooking', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = Peminjaman::findOrFail($id);
        
        // Check if the booking belongs to the current user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Only allow cancellation of pending bookings
        if ($booking->status_pinjam !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->delete();

        return redirect()->route('mybooking')->with('success', 'Booking cancelled successfully.');
    }
} 
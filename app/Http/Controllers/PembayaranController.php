<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with('peminjaman.armada')->latest()->paginate(10);
        $peminjamans = Peminjaman::whereDoesntHave('pembayaran')->with('armada')->get();
        return view('dashboard.pembayaran.index', compact('pembayarans', 'peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $peminjamans = Peminjaman::whereDoesntHave('pembayaran')->get();
        $selectedPeminjaman = $request->get('peminjaman_id');
        return view('dashboard.pembayaran.create', compact('peminjamans', 'selectedPeminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'metode_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);
        $validated['created_by'] = Auth::id();
        Pembayaran::create($validated);
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('peminjaman.armada');
        return view('dashboard.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $peminjamans = Peminjaman::all();
        return view('dashboard.pembayaran.edit', compact('pembayaran', 'peminjamans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'metode_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);
        $pembayaran->update($validated);
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Armada;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['armada', 'user', 'pengambilan', 'pengembalian'])
            ->latest()
            ->filter(request(['search', 'status', 'date_range']))
            ->paginate(10);

        return view('dashboard.peminjaman.index', [
            'peminjamans' => $peminjamans
        ]);
    }

    public function create()
    {
        $armadas = Armada::whereDoesntHave('peminjaman', function($query) {
            $query->where('status_pinjam', '!=', 'Selesai');
        })->get();
        
        $lokasis = Lokasi::all();
        
        return view('dashboard.peminjaman.create', [
            'armadas' => $armadas,
            'lokasis' => $lokasis
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'ktp_peminjam' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'armada_id' => 'required|exists:armada,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
            'pengambilan_id' => 'required|exists:lokasi,id',
            'pengembalian_id' => 'required|exists:lokasi,id',
            'waktu_pengambilan' => 'required',
            'waktu_pengembalian' => 'required',
            'keperluan_pinjam' => 'required|string',
        ]);

        if ($request->hasFile('ktp_peminjam')) {
            $ktpPath = $request->file('ktp_peminjam')->store('uploads/ktp', 'public');
            $validated['ktp_peminjam'] = $ktpPath;
        }

        $start = Carbon::parse($validated['mulai'])->startOfDay();
        $end = Carbon::parse($validated['selesai'])->startOfDay();
        $days = $start->diffInDays($end) + 1;
        if ($days < 1) $days = 1;
        $armada = Armada::findOrFail($validated['armada_id']);
        $validated['biaya'] = $days * $armada->harga;

        $validated['user_id'] = Auth::id();
        $validated['status_pinjam'] = 'Pending';

        $peminjaman = Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibuat');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('dashboard.peminjaman.show', [
            'peminjaman' => $peminjaman->load(['armada', 'user', 'pengambilan', 'pengembalian'])
        ]);
    }

    public function edit(Peminjaman $peminjaman)
    {
        $armadas = Armada::all();
        $lokasis = Lokasi::all();
        
        return view('dashboard.peminjaman.edit', [
            'peminjaman' => $peminjaman,
            'armadas' => $armadas,
            'lokasis' => $lokasis
        ]);
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'ktp_peminjam' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'armada_id' => 'required|exists:armada,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
            'pengambilan_id' => 'required|exists:lokasi,id',
            'pengembalian_id' => 'required|exists:lokasi,id',
            'waktu_pengambilan' => 'required',
            'waktu_pengembalian' => 'required',
            'keperluan_pinjam' => 'required|string',
            'status_pinjam' => 'required|in:Pending,Dipinjam,Selesai,Dibatalkan',
        ]);

        if ($request->has('delete_ktp') && $peminjaman->ktp_peminjam) {
            Storage::delete($peminjaman->ktp_peminjam);
            $validated['ktp_peminjam'] = null;
        }

        if ($request->hasFile('ktp_peminjam')) {
            if ($peminjaman->ktp_peminjam) {
                Storage::delete($peminjaman->ktp_peminjam);
            }
            
            $ktpPath = $request->file('ktp_peminjam')->store('uploads/ktp', 'public');
            $validated['ktp_peminjam'] = $ktpPath;
        }

        $start = Carbon::parse($validated['mulai'])->startOfDay();
        $end = Carbon::parse($validated['selesai'])->startOfDay();
        $days = $start->diffInDays($end) + 1;
        if ($days < 1) $days = 1;
        $armada = Armada::findOrFail($validated['armada_id']);
        $validated['biaya'] = $days * $armada->harga;

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->ktp_peminjam) {
            Storage::disk('public')->delete($peminjaman->ktp_peminjam);
        }
        
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }
}

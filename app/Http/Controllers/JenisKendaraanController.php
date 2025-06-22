<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JenisKendaraan::withCount('armada');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%");
        }

        $jenisKendaraans = $query->paginate(10)->appends($request->query());

        return view('dashboard.jenis-kendaraan.index', compact('jenisKendaraans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jenis-kendaraan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_kendaraan,nama',
        ]);

        JenisKendaraan::create($validated);

        return redirect()->route('jenis-kendaraan.index')
            ->with('success', 'Jenis kendaraan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKendaraan $jenisKendaraan)
    {
        $jenisKendaraan->load(['armada' => function($query) {
            $query->limit(10);
        }]);

        return view('dashboard.jenis-kendaraan.show', compact('jenisKendaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKendaraan $jenisKendaraan)
    {
        return view('dashboard.jenis-kendaraan.edit', compact('jenisKendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisKendaraan $jenisKendaraan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_kendaraan,nama,' . $jenisKendaraan->id,
        ]);

        $jenisKendaraan->update($validated);

        return redirect()->route('jenis-kendaraan.index')
            ->with('success', 'Jenis kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKendaraan $jenisKendaraan)
    {
        // Check if jenis kendaraan has related armada
        if ($jenisKendaraan->armada()->count() > 0) {
            return redirect()->route('jenis-kendaraan.index')
                ->with('error', 'Tidak dapat menghapus jenis kendaraan yang masih memiliki armada terkait.');
        }

        $jenisKendaraan->delete();

        return redirect()->route('jenis-kendaraan.index')
            ->with('success', 'Jenis kendaraan berhasil dihapus.');
    }
}

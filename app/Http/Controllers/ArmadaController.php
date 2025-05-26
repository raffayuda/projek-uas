<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\JenisKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $armadas = Armada::with('jenisKendaraan')
            ->filter(request(['search', 'jenis', 'status']))
            ->orderBy('id', 'desc')
            ->paginate(6);

        $jenisKendaraans = JenisKendaraan::all();

        return view('dashboard.armada.index', compact('armadas', 'jenisKendaraans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisKendaraans = JenisKendaraan::all();
        return view('dashboard.armada.create', compact('jenisKendaraans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:30',
            'nopol' => 'required|string|max:20',
            'thn_beli' => 'required|integer',
            'deskripsi' => 'required|string|max:200',
            'jenis_kendaraan_id' => 'required|exists:jenis_kendaraan,id',
            'kapasitas_kursi' => 'required|integer',
            'rating' => 'required|integer|between:1,5',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('armada-images', 'public');
        }

        Armada::create($validated);

        return redirect()->route('armada.index')->with('success', 'Armada berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Armada $armada)
    {
        $jenisKendaraans = JenisKendaraan::all();
        return view('dashboard.armada.edit', compact('armada', 'jenisKendaraans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Armada $armada)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:30',
            'nopol' => 'required|string|max:20',
            'thn_beli' => 'required|integer',
            'deskripsi' => 'required|string|max:200',
            'jenis_kendaraan_id' => 'required|exists:jenis_kendaraan,id',
            'kapasitas_kursi' => 'required|integer',
            'rating' => 'required|integer|between:1,5',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($armada->gambar) {
                Storage::disk('public')->delete($armada->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('armada-images', 'public');
        }

        $armada->update($validated);

        return redirect()->route('armada.index')->with('success', 'Armada berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Armada $armada)
    {
        if ($armada->gambar) {
            Storage::disk('public')->delete($armada->gambar);
        }

        $armada->delete();

        return redirect()->route('armada.index')->with('success', 'Armada berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Lokasi::all();
        return view('dashboard.lokasi.index', compact('locations'));
    }

    public function create()
    {
        return view('dashboard.lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'koordinat' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = storage_path('app/public/location-images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Store file in storage
            $image->move($uploadPath, $imageName);
            
            // Save only the filename to database
            $data['image'] = $imageName;
        }

        Lokasi::create($data);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function edit(Lokasi $lokasi)
    {
        return view('dashboard.lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'koordinat' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['image']); // Exclude image from mass assignment
        
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($lokasi->image && Storage::disk('public')->exists('location-images/' . $lokasi->image)) {
                Storage::disk('public')->delete('location-images/' . $lokasi->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = storage_path('app/public/location-images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Store file in storage
            $image->move($uploadPath, $imageName);
            
            // Save only the filename to database
            $data['image'] = $imageName;
        }

        $lokasi->update($data);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function destroy(Lokasi $lokasi)
    {
        if ($lokasi->image && Storage::disk('public')->exists('location-images/' . $lokasi->image)) {
            Storage::disk('public')->delete('location-images/' . $lokasi->image);
        }

        $lokasi->delete();

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil dihapus!');
    }
}
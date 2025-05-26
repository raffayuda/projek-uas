<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Armada;
use App\Models\Lokasi;
use App\Models\LokasiPengambilan;
use App\Models\LokasiPengembalian;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    
    public function create()
    {
        $cars = Armada::all();
        $pickupLocations = Lokasi::all();
        $returnLocations = Lokasi::all();
        return view('booking', compact('cars', 'pickupLocations', 'returnLocations'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_peminjam' => 'required|string|max:45',
                'ktp_peminjam' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'keperluan_pinjam' => 'nullable|string|max:100',
                'mulai' => 'required|date',
                'waktu_pengambilan' => 'required|date_format:H:i',
                'selesai' => 'required|date|after_or_equal:mulai',
                'waktu_pengembalian' => 'required|date_format:H:i',
                'biaya' => 'required|numeric',
                'armada_id' => 'required|exists:armada,id',
                'phone' => 'required|string|max:20',
                'pengambilan_id' => 'required|exists:lokasi,id',
                'pengembalian_id' => 'required|exists:lokasi,id'
            ], [
                'nama_peminjam.required' => 'Nama peminjam harus diisi',
                'ktp_peminjam.required' => 'File KTP harus diupload',
                'ktp_peminjam.image' => 'File KTP harus berupa gambar',
                'ktp_peminjam.mimes' => 'Format file KTP harus jpeg, png, atau jpg',
                'ktp_peminjam.max' => 'Ukuran file KTP maksimal 2MB',
                'mulai.required' => 'Tanggal pengambilan harus diisi',
                'waktu_pengambilan.required' => 'Waktu pengambilan harus diisi',
                'waktu_pengambilan.date_format' => 'Format waktu pengambilan tidak valid',
                'selesai.required' => 'Tanggal pengembalian harus diisi',
                'selesai.after_or_equal' => 'Tanggal pengembalian harus sama dengan atau setelah tanggal pengambilan',
                'waktu_pengembalian.required' => 'Waktu pengembalian harus diisi',
                'waktu_pengembalian.date_format' => 'Format waktu pengembalian tidak valid',
                'biaya.required' => 'Biaya harus diisi',
                'biaya.numeric' => 'Biaya harus berupa angka',
                'armada_id.required' => 'Mobil harus dipilih',
                'armada_id.exists' => 'Mobil yang dipilih tidak valid',
                'phone.required' => 'Nomor telepon harus diisi',
                'phone.max' => 'Nomor telepon maksimal 20 karakter',
                'pengambilan_id.required' => 'Lokasi pengambilan harus dipilih',
                'pengambilan_id.exists' => 'Lokasi pengambilan tidak valid',
                'pengembalian_id.required' => 'Lokasi pengembalian harus dipilih',
                'pengembalian_id.exists' => 'Lokasi pengembalian tidak valid'
            ]);

            // Combine date and time for mulai and selesai
            $validated['mulai'] = $validated['mulai'] . ' ' . $validated['waktu_pengambilan'];
            $validated['selesai'] = $validated['selesai'] . ' ' . $validated['waktu_pengembalian'];

            // Upload KTP
            if ($request->hasFile('ktp_peminjam')) {
                $file = $request->file('ktp_peminjam');
                $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $uploadPath = storage_path('app/public/uploads/ktp');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                // Store file in storage
                $file->move($uploadPath, $filename);
                
                // Save only the filename to database
                $validated['ktp_peminjam'] = $filename;
            }

            // Set default status and user
            $validated['status_pinjam'] = 'Pending';
            if (Auth::check()) {
                $validated['user_id'] = Auth::id();
            }

            // Create booking
            $peminjaman = Peminjaman::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat!',
                'data' => $peminjaman
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\JenisKendaraan;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index(Request $request)
    {
        $query = Armada::with('jenisKendaraan');
        
        // Filter by vehicle type if specified
        if ($request->has('type') && $request->type != '') {
            $query->whereHas('jenisKendaraan', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->type . '%');
            });
        }
        
        // Filter by availability if specified
        if ($request->has('available') && $request->available == '1') {
            $query->available();
        }
        
        // Search by make/model
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('merk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        // Sort by price if specified
        if ($request->has('sort')) {
            if ($request->sort == 'price_low') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('harga', 'desc');
            } elseif ($request->sort == 'rating') {
                $query->orderBy('rating', 'desc');
            }
        } else {
            $query->orderBy('rating', 'desc');
        }
        
        $cars = $query->paginate(12);
        $vehicleTypes = JenisKendaraan::all();
        
        return view('cars', compact('cars', 'vehicleTypes'));
    }
}

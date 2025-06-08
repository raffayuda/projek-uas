<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Peminjaman;
use App\Models\Lokasi;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Vehicles
        $totalVehicles = Armada::count();
        $newVehiclesThisMonth = Armada::whereYear('thn_beli', Carbon::now()->year)
            ->whereMonth('thn_beli', Carbon::now()->month)
            ->count();

        // Active Rentals
        $activeRentals = Peminjaman::where('status_pinjam', '!=', 'Selesai')
            ->where('status_pinjam', '!=', 'Dibatalkan')
            ->count();
        
        $endingSoonCount = Peminjaman::where('status_pinjam', '!=', 'Selesai')
            ->where('status_pinjam', '!=', 'Dibatalkan')
            ->where('selesai', '<=', Carbon::now()->addDays(2))
            ->count();

        // Total Revenue
        $totalRevenue = Pembayaran::where('status_pembayaran', 'Lunas')
            ->sum('jumlah_bayar');
        
        $lastMonthRevenue = Pembayaran::where('status_pembayaran', 'Lunas')
            ->whereYear('tanggal', Carbon::now()->subMonth()->year)
            ->whereMonth('tanggal', Carbon::now()->subMonth()->month)
            ->sum('jumlah_bayar');
        
        $currentMonthRevenue = Pembayaran::where('status_pembayaran', 'Lunas')
            ->whereYear('tanggal', Carbon::now()->year)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('jumlah_bayar');
        
        $revenueGrowth = $lastMonthRevenue > 0 
            ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100) 
            : 0;
            
        // Monthly Revenue Data for Chart
        $monthlyRevenue = [];
        $monthLabels = [];
        
        // Get data for the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabels[] = $month->format('M Y');
            
            $revenue = Pembayaran::where('status_pembayaran', 'Lunas')
                ->whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('jumlah_bayar');
                
            $monthlyRevenue[] = $revenue / 1000000; // Convert to millions for display
        }

        // Locations
        $totalLocations = Lokasi::count();
        $citiesCount = Lokasi::distinct('nama')->count();

        // Vehicle Status
        $totalArmada = Armada::count();
        
        $rentedVehicles = Peminjaman::where('status_pinjam', '!=', 'Selesai')
            ->where('status_pinjam', '!=', 'Dibatalkan')
            ->distinct('armada_id')
            ->count();
        
        $availableVehicles = $totalArmada - $rentedVehicles;
        $maintenanceVehicles = 0; // Assuming no maintenance status in the current system
        
        // Calculate percentages
        $availablePercentage = $totalArmada > 0 ? ($availableVehicles / $totalArmada) * 100 : 0;
        $rentedPercentage = $totalArmada > 0 ? ($rentedVehicles / $totalArmada) * 100 : 0;
        $maintenancePercentage = $totalArmada > 0 ? ($maintenanceVehicles / $totalArmada) * 100 : 0;

        // Recent Rentals
        $recentRentals = Peminjaman::with(['armada', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.home', compact(
            'totalVehicles', 
            'newVehiclesThisMonth',
            'activeRentals',
            'endingSoonCount',
            'totalRevenue',
            'revenueGrowth',
            'totalLocations',
            'citiesCount',
            'totalArmada',
            'availableVehicles',
            'rentedVehicles',
            'maintenanceVehicles',
            'availablePercentage',
            'rentedPercentage',
            'maintenancePercentage',
            'recentRentals',
            'monthlyRevenue',
            'monthLabels'
        ));
    }
}
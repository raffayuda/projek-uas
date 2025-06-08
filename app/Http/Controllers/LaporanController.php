<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Armada;
use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{    public function index()
    {
        try {
            // Statistik Umum
            $totalPeminjaman = Peminjaman::count();
            $totalArmada = Armada::count();
            
            // Total pendapatan dari pembayaran yang sudah berhasil/lunas
            $totalPendapatan = Pembayaran::where('status_pembayaran', 'success')
                                        ->orWhere('status_pembayaran', 'lunas')
                                        ->sum('jumlah_bayar') ?? 0;
            
            $peminjamanAktif = Peminjaman::whereIn('status_pinjam', ['Pending', 'Approved', 'Dipinjam'])->count();

            // Payment statistics
            $totalPembayaranBerhasil = Pembayaran::where('status_pembayaran', 'success')
                                                ->orWhere('status_pembayaran', 'lunas')
                                                ->count();
            
            $totalPembayaranPending = Pembayaran::where('status_pembayaran', 'pending')->count();

            // Data untuk grafik bulanan (6 bulan terakhir) - berdasarkan pembayaran aktual
            $monthlyData = collect();
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $month = $date->format('M Y');
                
                // Jumlah peminjaman per bulan
                $count = Peminjaman::whereYear('created_at', $date->year)
                                  ->whereMonth('created_at', $date->month)
                                  ->count();
                
                // Pendapatan aktual dari pembayaran per bulan
                $revenue = Pembayaran::whereYear('tanggal', $date->year)
                                    ->whereMonth('tanggal', $date->month)
                                    ->where(function($query) {
                                        $query->where('status_pembayaran', 'success')
                                              ->orWhere('status_pembayaran', 'lunas');
                                    })
                                    ->sum('jumlah_bayar') ?? 0;
                
                $monthlyData->push([
                    'month' => $month,
                    'peminjaman' => $count,
                    'pendapatan' => $revenue
                ]);
            }            // Status peminjaman chart data
            $statusData = Peminjaman::select('status_pinjam', DB::raw('count(*) as total'))
                                    ->groupBy('status_pinjam')
                                    ->get()
                                    ->pluck('total', 'status_pinjam');

            // Payment status chart data
            $paymentStatusData = Pembayaran::select('status_pembayaran', DB::raw('count(*) as total'))
                                          ->groupBy('status_pembayaran')
                                          ->get()
                                          ->pluck('total', 'status_pembayaran');

            // Top 5 armada terpopuler
            $topArmada = Peminjaman::select('armada_id', DB::raw('count(*) as total'))
                                   ->with('armada')
                                   ->groupBy('armada_id')
                                   ->orderBy('total', 'desc')
                                   ->limit(5)
                                   ->get();

            // Pendapatan harian minggu ini - berdasarkan pembayaran aktual
            $weeklyRevenue = collect();
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $day = $date->format('D');
                
                // Pendapatan aktual dari pembayaran per hari
                $revenue = Pembayaran::whereDate('tanggal', $date)
                                    ->where(function($query) {
                                        $query->where('status_pembayaran', 'success')
                                              ->orWhere('status_pembayaran', 'lunas');
                                    })
                                    ->sum('jumlah_bayar') ?? 0;
                
                $weeklyRevenue->push([
                    'day' => $day,
                    'revenue' => $revenue
                ]);            }

            return view('dashboard.laporan.index', compact(
                'totalPeminjaman',
                'totalArmada', 
                'totalPendapatan',
                'peminjamanAktif',
                'totalPembayaranBerhasil',
                'totalPembayaranPending',
                'monthlyData',
                'statusData',
                'paymentStatusData',
                'topArmada',
                'weeklyRevenue'
            ));
        } catch (\Exception $e) {
            Log::error('Error in laporan index: ' . $e->getMessage());
            
            // Return view with empty data if there's an error
            return view('dashboard.laporan.index', [
                'totalPeminjaman' => 0,
                'totalArmada' => 0,
                'totalPendapatan' => 0,
                'peminjamanAktif' => 0,
                'totalPembayaranBerhasil' => 0,
                'totalPembayaranPending' => 0,
                'monthlyData' => collect(),
                'statusData' => collect(),
                'paymentStatusData' => collect(),
                'topArmada' => collect(),
                'weeklyRevenue' => collect()
            ]);
        }
    }public function exportPdf(Request $request)
    {
        try {
            $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
            $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();

            $query = Peminjaman::with(['armada', 'user', 'pembayaran']);
            
            // Apply date filters
            $query->whereBetween('created_at', [$startDate, $endDate]);
            
            // Apply additional filters if provided
            if ($request->status) {
                $query->where('status_pinjam', $request->status);
            }
            
            if ($request->armada_id) {
                $query->where('armada_id', $request->armada_id);
            }

            $peminjamans = $query->get();
            
            // Calculate total revenue from actual payments
            $totalPendapatan = Pembayaran::whereHas('peminjaman', function($q) use ($startDate, $endDate) {
                                    $q->whereBetween('created_at', [$startDate, $endDate]);
                                })
                                ->where(function($query) {
                                    $query->where('status_pembayaran', 'success')
                                          ->orWhere('status_pembayaran', 'lunas');
                                })
                                ->sum('jumlah_bayar') ?? 0;
            
            return view('dashboard.laporan.pdf', compact(
                'peminjamans',
                'totalPendapatan',
                'startDate',
                'endDate'
            ));        } catch (\Exception $e) {
            Log::error('Error in laporan export PDF: ' . $e->getMessage());
            
            return redirect()->route('laporan.index')
                           ->with('error', 'Terjadi kesalahan saat mengexport PDF. Silakan coba lagi.');
        }
    }

    public function detail(Request $request)
    {
        $query = Peminjaman::with(['armada', 'user', 'pengambilan', 'pengembalian']);

        // Filter berdasarkan tanggal
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status_pinjam', $request->status);
        }

        // Filter berdasarkan armada
        if ($request->armada_id) {
            $query->where('armada_id', $request->armada_id);
        }

        $peminjamans = $query->orderBy('created_at', 'desc')->paginate(15);
        $armadas = Armada::all();

        return view('dashboard.laporan.detail', compact('peminjamans', 'armadas'));
    }
}

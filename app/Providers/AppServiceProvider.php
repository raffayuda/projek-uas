<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Armada;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Lokasi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share data with sidebar view
        View::composer('dashboard.partials.sidebar', function ($view) {
            $armadaCount = Armada::count();
            $activePeminjamanCount = Peminjaman::whereIn('status_pinjam', ['Pending', 'Approved'])->count();
            $pembayaranCount = Pembayaran::count();
            $pendingPembayaranCount = Peminjaman::whereDoesntHave('pembayaran')->count();
            $lokasiCount = Lokasi::count();
            $totalPendapatan = Peminjaman::where('status_pinjam', 'Finished')->sum('biaya');
            
            $view->with([
                'armadaCount' => $armadaCount,
                'activePeminjamanCount' => $activePeminjamanCount,
                'pembayaranCount' => $pembayaranCount,
                'pendingPembayaranCount' => $pendingPembayaranCount,
                'lokasiCount' => $lokasiCount,
                'totalPendapatan' => $totalPendapatan,
            ]);
        });
    }
}

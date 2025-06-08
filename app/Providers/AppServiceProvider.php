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
            $activePeminjamanCount = Peminjaman::where('status_pinjam', 'Pending')->count();
            $pembayaranCount = Pembayaran::count();
            $lokasiCount = Lokasi::count();
            
            $view->with([
                'armadaCount' => $armadaCount,
                'activePeminjamanCount' => $activePeminjamanCount,
                'pembayaranCount' => $pembayaranCount,
                'lokasiCount' => $lokasiCount,
            ]);
        });
    }
}

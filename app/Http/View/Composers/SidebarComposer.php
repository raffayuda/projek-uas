<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Peminjaman;
use App\Models\Armada;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Lokasi;

class SidebarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Get statistics for sidebar
        $activePeminjamanCount = Peminjaman::whereIn('status_pinjam', ['Pending', 'Approved'])->count();
        $pendingPembayaranCount = Peminjaman::whereDoesntHave('pembayaran')->count();
        $totalArmada = Armada::count();
        $availableArmada = Armada::whereDoesntHave('peminjaman', function($query) {
            $query->whereIn('status_pinjam', ['Pending', 'Approved']);
        })->count();
        
        // Additional counts for sidebar
        $userCount = User::count();
        $pembayaranCount = Pembayaran::count();
        $lokasiCount = Lokasi::count();
        $armadaCount = $totalArmada;

        $view->with([
            'activePeminjamanCount' => $activePeminjamanCount,
            'pendingPembayaranCount' => $pendingPembayaranCount,
            'totalArmada' => $totalArmada,
            'availableArmada' => $availableArmada,
            'userCount' => $userCount,
            'pembayaranCount' => $pembayaranCount,
            'lokasiCount' => $lokasiCount,
            'armadaCount' => $armadaCount
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    protected $table = 'armada';
    public $timestamps = false;
    
    protected $fillable = [
        'merk', 'nopol', 'thn_beli', 'deskripsi', 'jenis_kendaraan_id', 'kapasitas_kursi', 'rating', 'harga', 'gambar'
    ];

    public function jenisKendaraan()
    {
        return $this->belongsTo(JenisKendaraan::class, 'jenis_kendaraan_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'armada_id');
    }    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('merk', 'like', '%'.$search.'%')
                ->orWhere('nopol', 'like', '%'.$search.'%')
                ->orWhere('deskripsi', 'like', '%'.$search.'%'));

        $query->when($filters['jenis'] ?? false, fn($query, $jenis) =>
            $query->whereHas('jenisKendaraan', fn($query) =>
                $query->where('id', $jenis)));

        $query->when($filters['status'] ?? false, function($query, $status) {
            if ($status === 'available') {
                return $query->whereDoesntHave('peminjaman', function($query) {
                    $query->whereIn('status_pinjam', ['Pending', 'Dipinjam']);
                });
            } elseif ($status === 'rented') {
                return $query->whereHas('peminjaman', function($query) {
                    $query->whereIn('status_pinjam', ['Pending', 'Dipinjam']);
                });
            }
        });
    }

    public function getStatusAttribute()
    {
        return $this->peminjaman()->whereIn('status_pinjam', ['Pending', 'Dipinjam'])->exists() 
            ? 'rented' 
            : 'available';
    }

    /**
     * Check if car is available for specific date range
     */
    public function isAvailableForDates($startDate, $endDate)
    {
        return !$this->peminjaman()
            ->whereIn('status_pinjam', ['Pending', 'Dipinjam'])
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('mulai', [$startDate, $endDate])
                      ->orWhereBetween('selesai', [$startDate, $endDate])
                      ->orWhere(function($subQuery) use ($startDate, $endDate) {
                          $subQuery->where('mulai', '<=', $startDate)
                                   ->where('selesai', '>=', $endDate);
                      });
            })->exists();
    }

    public function getStatusColorAttribute()
    {
        return $this->status === 'available' ? 'green' : 'red';
    }

    public function scopeAvailable($query)
{
    return $query->whereDoesntHave('peminjaman', function($query) {
        $query->whereIn('status_pinjam', ['Pending', 'Approved']);
    });
}
} 
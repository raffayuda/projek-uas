<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    public $timestamps = true;

    protected $fillable = [
        'nama_peminjam',
        'ktp_peminjam',
        'keperluan_pinjam',
        'mulai',
        'selesai',
        'biaya',
        'armada_id',
        'komentar_peminjam',
        'status_pinjam',
        'pengembalian_id',
        'pengambilan_id',
        'waktu_pengambilan',
        'waktu_pengembalian',
        'phone',
        'user_id'
    ];

    protected $casts = [
        'mulai' => 'date',
        'selesai' => 'date',
        'biaya' => 'decimal:2'
    ];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengambilan()
    {
        return $this->belongsTo(Lokasi::class, 'pengambilan_id');
    }

    public function pengembalian()
    {
        return $this->belongsTo(Lokasi::class, 'pengembalian_id');
    }    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('nama_peminjam', 'like', '%'.$search.'%')
                ->orWhere('ktp_peminjam', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%'));

        $query->when($filters['status'] ?? false, fn($query, $status) =>
            $query->where('status_pinjam', $status));

        $query->when($filters['date_range'] ?? false, function($query, $dateRange) {
            $dates = explode(' to ', $dateRange);
            if (count($dates) === 2) {
                return $query->whereBetween('mulai', $dates);
            }
            return $query->whereDate('mulai', $dateRange);
        });
    }
} 
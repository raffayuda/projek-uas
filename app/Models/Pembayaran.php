<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'tanggal',
        'jumlah_bayar',
        'peminjaman_id',
        'status_pembayaran',
        'metode_pembayaran',
        'keterangan',
        'created_by'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
} 
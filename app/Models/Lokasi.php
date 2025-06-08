<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    public $timestamps = false;
    
    protected $fillable = [
        'nama',
        'alamat',
        'koordinat',
        'image'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, ['pengambilan_id', 'pengembalian_id']);
    }
} 
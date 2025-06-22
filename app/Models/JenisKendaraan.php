<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKendaraan extends Model
{
    protected $table = 'jenis_kendaraan';
    public $timestamps = false;
    protected $fillable = [
        'nama'
    ];

    public function armada()
    {
        return $this->hasMany(Armada::class, 'jenis_kendaraan_id');
    }
} 
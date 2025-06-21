<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    
    protected $fillable = [
        'peminjaman_id',
        'user_id', 
        'armada_id',
        'rating',
        'review'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
}

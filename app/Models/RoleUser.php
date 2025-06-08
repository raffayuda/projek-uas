<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    
    protected $fillable = [
        'nama',
    ];

    public $timestamps = false;

    /**
     * Get users with this role.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_user_id');
    }
}

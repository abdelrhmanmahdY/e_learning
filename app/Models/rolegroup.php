<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rolegroup extends Model
{
    protected $table = 'rolegroup';

    protected $fillable = [
        'user_id', 'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

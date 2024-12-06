<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model


{

    protected $fillable = [
        'user_id',
        
    ];
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}

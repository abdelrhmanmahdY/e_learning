<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'penalty_type',
        'description',
        'duration',
        'severity_level',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'havepenalties', 'penalties_id', 'user_id');
    }
}

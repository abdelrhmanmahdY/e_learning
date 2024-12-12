<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
  protected $table = 'role'; // Ensure the correct table name
  protected $fillable = ['role_name'];

  public $timestamps = false; // Disable timestamps
  public function roles()
  {
      return $this->belongsToMany(Role::class, 'rolegroup');
  }
  
}

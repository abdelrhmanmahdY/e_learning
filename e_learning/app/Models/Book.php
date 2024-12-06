<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
 
    
   
        protected $fillable = [
            'title',
            'author',
            'publisher',
            'edition',
            'availability_status',
            'number_of_books',
        ];
    
    
    use HasFactory;
}

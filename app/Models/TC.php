<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TC extends Model
{
    use HasFactory;
        protected $table = 't_c_table';

        protected $fillable = [
            'title',  
            'content',  
            'status',  
        ];
        
}


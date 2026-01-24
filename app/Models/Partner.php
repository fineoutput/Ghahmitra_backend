<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
        protected $table = 'partner';
        protected $fillable = [
            'name',  
            'phone',  
            'address', 
            'aadhaar_front_image',
            'aadhaar_back_image',
            'b_v_status',
            'status',
        ];
        
}

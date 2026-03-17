<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualCity extends Model
{
    use HasFactory;
        protected $table = 'manual_city';
    
        protected $fillable = [
            'city_name',  
            'pincode',  
            'status',  
        ];
        
}

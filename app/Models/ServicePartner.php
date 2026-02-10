<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePartner extends Model
{
    use HasFactory;
        protected $table = 'service_partner';
    
        protected $fillable = [
            'name',  
            'auth',  
            'email',  
            'phone',  
            'address',  
            'district',  
            'city_id',  
            'state_id',  
            'rank',  
            'status',  
        ];
        
}

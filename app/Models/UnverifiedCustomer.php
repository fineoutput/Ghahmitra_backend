<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifiedCustomer extends Model
{
    use HasFactory;
        protected $table = 'Unverified_customer';
        protected $fillable = [
            'auth',  
            'name',  
            'email',  
            'mobile_no', 
            'image', 
            'status',
        ];
        
}

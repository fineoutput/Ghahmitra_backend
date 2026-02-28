<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Customers extends Authenticatable
{
    use HasFactory, Notifiable;
        protected $table = 'customers';
        protected $fillable = [
            'auth',  
            'name',  
            'email',  
            'mobile_no', 
            'image', 
            'status',
        ];
        
}

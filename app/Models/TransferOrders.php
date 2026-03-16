<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferOrders extends Model
{
    use HasFactory;
        protected $table = 'transfer_orders';
    
        protected $fillable = [
            'order_id',  
            'partner_id',  
            'status',  
            'start_time',  
            'distance',  
            'end_time',  
            'ip',  
            'accepted_at',  
            'start_location',  
            'end_location',   
        ];
        
}

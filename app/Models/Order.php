<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
        protected $table = 'orders';
        protected $fillable = [
            'order_number',  
            'customer_id',  
            'subtotal',  
            'tax', 
            'discount',
            'grand_total',
            'payment_method',
            'payment_status',
            'order_status',
            'address_id',
            'notes',
        ];
        
        
        public function service()
        {
            return $this->belongsTo(Services::class, 'services_id');
        }

}

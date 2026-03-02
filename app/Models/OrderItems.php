<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
        protected $table = 'order_items';
        protected $fillable = [
            'order_id',
            'service_id',
            'service_name',
            'price',
            'quantity',
            'total',
            'availability_id'
        ];
        
        
        public function service()
        {
            return $this->belongsTo(Services::class, 'service_id');
        }

}

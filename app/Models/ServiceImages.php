<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImages extends Model
{
    use HasFactory;
        protected $table = 'service_images';
        protected $fillable = [
            'transfer_order_id',  
            'image',  
        ];
      
        public function transferOrder()
        {
            return $this->hasMany(TransferOrders::class, 'transfer_order_id');
        }
       

}

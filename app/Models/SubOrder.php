<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    use HasFactory;
        protected $table = 'sub_order';
    
        protected $fillable = [
            'user_id',  
            'service_id',  
            'availability_id',  
            'quantity',  
            'price',  
            'total',  
            'ip',
            'status',
        ];

         public function customers()
        {
            return $this->belongsTo(Customers::class, 'customers_id');
        }
         public function service()
        {
            return $this->hasOne(Th_Services::class, 'id', 'service_id');
        }

         public function availability()
        {
            return $this->belongsTo(Availability::class, 'availability_id');
        }


}

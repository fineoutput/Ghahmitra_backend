<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
        protected $table = 'tbl_cart';
    
        protected $fillable = [
            'customers_id',  
            'service_id',  
            'category_id',  
            'availability_id',  
            'quantity',  
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

         public function ServicesSe()
        {
            return $this->belongsTo(ServicesSe::class, 'category_id');
        }

}

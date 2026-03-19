<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddresses extends Model
{
    use HasFactory;
        protected $table = 'customer_addresses';
        protected $fillable = [
            'customer_id',  
            'type',  
            'name',  
            'mobile_no', 
            'address_line1', 
            'address_line2',
            'landmark',
            'city_id',
            'state_id',
            'latitude',
            'longitude',
            'pincode',
            'is_default',
            'status',
        ];

        public function city()
        {
            return $this->belongsTo(ManualCity::class, 'city_id', 'id');
        }
        public function state()
        {
            return $this->belongsTo(State::class, 'state_id');
        }
        
}

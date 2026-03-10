<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    use HasFactory;
        protected $table = 'reschedule';
        protected $fillable = [
           'customer_id',
            'cart_id',
            'availability_id',
            'day',
            'start_time',
            'end_time',
            'slot_id',
            'reason',
        ];
        
        
          public function customer()
            {
                return $this->belongsTo(Customers::class, 'customer_id');
            }

            public function cart()
            {
                return $this->belongsTo(\App\Models\Cart::class, 'cart_id');
            }

            public function slot()
            {
                return $this->belongsTo(Slots::class, 'slot_id');
            }

}

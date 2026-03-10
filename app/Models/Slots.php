<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    use HasFactory;
        protected $table = 'slots';
    
        protected $fillable = [
            'day_id',  
            'start_time',  
            'end_time',  
            'status',  
        ];
        
         public function day_Availability()
        {
            return $this->belongsTo(Availability::class, 'day_id');
        }

}

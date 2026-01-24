<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
        protected $table = 'availability';
    
        protected $fillable = [
            'services_id',  
            'day',  
            'start_time',  
            'end_time',  
            'description',  
            'status',
        ];
        
         public function service()
        {
            return $this->belongsTo(Th_Services::class, 'services_id');
        }

}

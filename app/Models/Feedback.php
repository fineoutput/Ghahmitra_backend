<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
        protected $table = 'tbl_feedback';
    
        protected $fillable = [
            'user_id',  
            'description',  
            'star',  
            'status',  
        ];

        
         public function customers()
        {
            return $this->belongsTo(Customers::class, 'customers_id');
        }

}

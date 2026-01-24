<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesSe extends Model
{
    use HasFactory;
        protected $table = 'services_se';
        protected $fillable = [
            'services_id',  
            'name',  
            'description',  
            'image', 
            'status',
        ];
        
        
        public function service()
        {
            return $this->belongsTo(Services::class, 'services_id');
        }

}

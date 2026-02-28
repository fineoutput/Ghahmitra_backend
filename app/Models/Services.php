<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
        protected $table = 'services';
        protected $fillable = [
            'name',  
            'description',  
            'image', 
            'status',
        ];

        public function serviceDetails()
        {
            return $this->hasMany(ServicesSe::class, 'services_id', 'id');
        }
        
}

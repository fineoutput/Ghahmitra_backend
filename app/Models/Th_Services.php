<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Th_Services extends Model
{
    use HasFactory;
        protected $table = 'th_services';
        protected $casts = [
    'image' => 'array',
];
        protected $fillable = [
            'services_id',  
            'services_se_id',  
            'name',  
            'description',  
            'price',  
            'mrp',  
            'commission_percentage',  
            'image', 
            'status',
        ];
        
         public function service()
        {
            return $this->belongsTo(Services::class, 'services_id');
        }

        public function serviceSe()
        {
            return $this->belongsTo(ServicesSe::class, 'services_se_id');
        }
}

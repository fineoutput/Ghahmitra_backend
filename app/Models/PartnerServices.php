<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerServices extends Model
{
    use HasFactory;
        protected $table = 'partner_services';
        protected $fillable = [
            'partner_id',  
            'service_id',  
            'commission_percentage',  
            'status',  
        ];
        
         public function partner()
        {
            return $this->belongsTo(ServicePartner::class, 'partner_id');
        }
         public function service()
        {
            return $this->belongsTo(Th_Services::class, 'service_id');
        }

}

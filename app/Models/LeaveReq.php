<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveReq extends Model
{
    use HasFactory;
        protected $table = 'leave_req';
        protected $fillable = [
            'partner_id',  
            'start_date',  
            'end_date',  
            'description', 
            'status',  
        ];
        
         public function partner()
        {
            return $this->belongsTo(ServicePartner::class, 'partner_id');
        }

}

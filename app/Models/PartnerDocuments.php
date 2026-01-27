<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerDocuments extends Model
{
    use HasFactory;
        protected $table = 'partner_documents';
    
        protected $fillable = [
            'partner_id',  
            'document_type',  
            'document_file',  
            'status',  
        ];
        
        public function partner()
        {
            return $this->belongsTo(ServicePartner::class, 'partner_id');
        }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransactions extends Model
{
    use HasFactory;
        protected $table = 'wallet_transactions';

        protected $fillable = [
            'wallet_id',  
            'user_id',  
            'transaction_id',  
            'type',  
            'amount',  
            'opening_balance',
            'closing_balance',  
            'transaction_for',
            'reference_id',
            'description',
            'status',
            'payment_method',
            'ip_address',
        ];
        
        
}

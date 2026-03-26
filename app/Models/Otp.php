<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Otp extends Model
{
    use  HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tbl_otp';
    protected $fillable = [
        'name',
        'contact_no',
        'email',
        'otp',
        'type',
        'ip',
        'is_active',
        'service_id',
        'date',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
}

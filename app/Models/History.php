<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table="history";
    protected $fillable = [
        'user_id',
        'Restaurant_name',
        'date',
        'checkin_time',
        'checkout_time',
        'status',
        'checkin_address',
        'checkout_address'

    ];
     function getCheckinoutDetail()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

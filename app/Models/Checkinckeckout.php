<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkinckeckout extends Model
{
    use HasFactory;
    protected $table="checkinouts";
    protected $fillable = [
        'user_id',
        'Restaurant_name',
        'date',
        'checkin_time',
        'checkout_time',
        "checkin_address",
        "checkout_address",
        'status'

    ];

    function getCheckinoutDetail()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function scopeFilter($query,$request){
        if($request->date){
            $query->where('date',$request->date);
        }
        return $query;

 }
}

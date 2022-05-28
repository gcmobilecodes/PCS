<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Restaurant_name',
        'date',
        'time'
];
    public function getUser(){
        return $this->hasMany('users');
    }


}

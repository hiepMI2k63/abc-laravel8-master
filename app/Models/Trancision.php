<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trancision extends Model
{
    use HasFactory;
    protected $table = 'trancisions';
    public function user2(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}

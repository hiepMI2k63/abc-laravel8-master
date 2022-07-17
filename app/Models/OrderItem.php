<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table  = "order_items";

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function sanpham1()
    {
        return $this->belongsTo(Sanpham::class);
        //return $this->hasOne(Sanpham::class);
    }

}

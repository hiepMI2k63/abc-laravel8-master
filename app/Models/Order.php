<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;
    protected $table = "orders";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function trancision()
    {
        return $this->hasOne(Trancision::class);
    }
}

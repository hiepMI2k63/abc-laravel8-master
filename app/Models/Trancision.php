<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trancision extends Model
{
    use HasFactory;
    protected $table = 'trancisions';

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}

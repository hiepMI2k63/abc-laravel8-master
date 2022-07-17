<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = "reviews";


    public function user2(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product(){
        return $this->belongsTo(Sanpham::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nhomsanpham;
use App\Models\Review;
class Sanpham extends Model
{
    use HasFactory;
    protected $table='sanpham';
    protected $fillable=['ten','mota','gia','giaban','anh','danhsachanh','trangthai','uutien','nhomsanphamid'];

    public function nhomsanpham(){
        return Nhomsanpham::find($this->nhomsanphamid);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id');//collection

    }
}

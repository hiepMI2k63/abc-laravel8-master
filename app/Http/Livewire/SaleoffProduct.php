<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use App\Models\Review;
use Cart;
use Illuminate\Support\Facades\DB;
class SaleoffProduct extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\SanPham');
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
    }

    public function render()
    {

        $rating= DB::table('sanpham')
        ->join('reviews', 'sanpham.id', '=', 'reviews.product_id')
        ->groupBy('reviews.product_id')
        ->select( DB::raw('AVG(reviews.rating) as rating'),'reviews.product_id as id')
        ->get();

        $products=Sanpham::whereNotNull('giaban')->orderByRaw("giaban/gia ASC")->take(5)->get();

        return view('livewire.saleoff-product', compact('products','rating'));
    }
}

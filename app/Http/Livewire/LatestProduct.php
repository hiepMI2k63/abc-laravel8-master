<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use \Illuminate\Support\Str;
use Cart;
class LatestProduct extends Component
{

    // public function store($product_id, $product_name, $product_price)
    // {
    //     Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\SanPham');
    //     session()->flash('success','Thêm mới một mục vào rỏ hàng');
    //     return redirect()->route('cart');
    // }
    public function render()
    {
        $products=Sanpham::orderBy("updated_at", "DESC")->take(6)->get();

        return view('livewire.latest-product', compact('products'));
    }
}

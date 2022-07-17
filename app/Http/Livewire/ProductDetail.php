<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use Cart;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use DB;
class ProductDetail extends Component
{


    public $id_ko_Dc_de_id;
    public function mount($param)
    {

        $this->id_ko_Dc_de_id = $param;
    }
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\SanPham');
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
    }
    public $rating;
    public $comment;
    public $order_item_id;
    public $user_id;

    public function storeRating($value1, $value2)
    {
        $this->rating = $value1;
        $this->order_item_id = $value2;
    }

    public function danhgia()
    {
        if ($this->rating && Auth::check()) {
            $review = new Review();
            $review->user_id = Auth::user()->id;
            $review->rating = $this->rating;
            $review->comment = $this->comment;
            $review->product_id = $this->order_item_id;
            $review->save();
            session()->flash('alert-success', 'bình chọn thành công ');
            return redirect()->route('productdetail',$this->id_ko_Dc_de_id);
        }
        else{
            session()->flash('alert-danger', 'bình chọn thất bại');
            return redirect()->route('productdetail',$this->id_ko_Dc_de_id);
        }
    }

    protected $listeners = ['storeRating',];
    public function render()
    {

        //dd($this->id_ko_Dc_de_id);
        $product = Sanpham::where('id',$this->id_ko_Dc_de_id)->first();
        $getreview = Review::where('product_id',$this->id_ko_Dc_de_id)->get();
        $related_product = Sanpham::where('nhomsanphamid',$product->nhomsanphamid)->where('id','!=',$this->id_ko_Dc_de_id)->get();
        $average =  $getreview->avg('rating');
        $images = json_decode($product->danhsachanh, true);

        $ordetails= DB::table('trancisions')
       ->join('orders', 'orders.id', '=', 'trancisions.order_id')
       ->join('order_items', 'order_items.order_id', '=', 'orders.id')
       ->join('sanpham', 'sanpham.id', '=', 'order_items.product_id')
       ->where('trancisions.user_id', '=', auth()->user()->id)
       ->get();
            $flag = 1;
            foreach($ordetails as $s)
            {
                if($s->product_id == $product->id)
                {
                        $flag =0;
                }

            };

        return view('livewire.product-detail',compact('product','getreview','average','images','related_product','flag'))->layout('layouts.base');
    }
}

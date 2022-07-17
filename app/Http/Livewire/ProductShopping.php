<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use Cart;
use Livewire\WithPagination;

class ProductShopping extends Component
{


    use WithPagination;

    protected $listeners = ['updateSelection'];

    protected $paginationTheme = 'bootstrap';

    public $sorts = [
        0 => 'Mặc định',
        1 => 'Giá tăng dần',
        2 => 'Giá giảm dần',
    ];

    public $sortid=0;

    public $viewType='grid';

    public $selectionCatid=null;
    public $minPrice;
    public $maxPrice;

    public function mount(){
        $this->minPrice=Sanpham::min('gia');
        $this->maxPrice=Sanpham::max('gia');
    }

    public function updateSelection(){
        $this->selectionCatid=$catid;
        $this->minPrice=$minPrice;
        $this->maxPrice=$maxPrice;
        $this->resetPage();
    }

    public function updatedSortid(){
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'livewire.custom-pagination-links-view';
    }

    public function viewFormat($viewType){
        $this->viewType=$viewType;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\SanPham');
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
    }

    public function render()
    {
        if (!is_null($this->selectionCatid)){
            if ($this->sortid == 1){
                $products=Sanpham::where('nhomsanphamid',$this->selectionCatid)
                    ->where('gia','>=', $this->minPrice)
                    ->where('gia','<=', $this->maxPrice)
                    ->orderBy('gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=Sanpham::where('nhomsanphamid',$this->selectionCatid)
                ->where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->orderBy('gia', 'desc')->paginate(6);
            } else {
                $products=Sanpham::where('nhomsanphamid',$this->selectionCatid)
                ->where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->paginate(6);
            }
        }
        else{
            if ($this->sortid == 1){
                $products=Sanpham::where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->orderBy('gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=Sanpham::where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->orderBy('gia', 'desc')->paginate(6);
            } else {
                $products=Sanpham::where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->paginate(6);
            }
        }

        return view('livewire.product-shopping', ['products'=>$products]);
    }
}

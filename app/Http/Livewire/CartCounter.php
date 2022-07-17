<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['postCartProcessed' => 'updateCartInfo'];

    public function updateCartInfo()
    {
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}

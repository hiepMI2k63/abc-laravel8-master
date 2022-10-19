<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Counpon;
use Cart;

class ShoppingCart extends Component
{
    public $counponCode;
    public $discount;
    public $subAfter;
    public $taxAfter;
    public $totalAfter;

    public function ApplyCounponCode()
    {
        $codeApp = Counpon::where('code', $this->counponCode)->first();
        if (!$codeApp) {
            session()->flash('false', 'Code does not exist');
            return;
        }
        else
        {
        session()->put(
            'coupon',
            [
                'code' => $codeApp->code,
                'type' => $codeApp->type,
                'value' => $codeApp->value,
                'cart_value' => $codeApp->cart_value,
            ]
        );
    }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        session()->forget('checkout');

    }
    public function caculatorDiscount()
    {


        if (session()->has('coupon')) {

            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            }
            if (session()->get('coupon')['type'] == 'percent') {
                $this->discount = (Cart::total(0)) * session()->get('coupon')['value'] / 100;
            }
            $this->subAfter = Cart::subtotal(0) - $this->discount;
            $this->taxAfter = 10;
            $this->totalAfter = Cart::total(0) -   $this->discount;
        }
    }
    public function setAmountForCheckOut()
    {
        session()->forget('checkout');
        if(!Cart::count() > 0)
        {
            session()->forget('checkout');
            return;
        }

        if (session()->has('coupon')) {

            session()->put(
                'checkout',
                [
                    'discount' => $this->discount,
                    'subtotal' => $this->subAfter,
                    'tax' => $this->taxAfter,
                    'total' => $this->totalAfter,
                ]
            );
        } else {
            session()->put(
                'checkout',
                [
                    'discount' => 0,
                    'subtotal' => Cart::subtotal(0),
                    'tax' =>  10,
                    'total' =>  Cart::total(0),

                ]
            );
        }
    }

    public function delete($rowId)
    {

        Cart::remove($rowId);

    }

    public function quantitychange($rowId, $value)
    {
        Cart::update($rowId, (int)$value);
    }

    public function quantityreduce($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty-1);
    }

    public function quantityincrease($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty+1);

    }

    public function render()
    {

        $this->emitTo('cart-counter', 'postCartProcessed');

        $items=Cart::content();

        if (session()->has('coupon')) {
                $this->caculatorDiscount();
        }

        $this->setAmountForCheckOut();


        return view('livewire.shopping-cart', compact('items'));
    }
}

<div>

  <section class="shoping-cart spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping__cart__table">
            <table>
              <thead>
                <tr>
                  <th class="shoping__product">Products</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                @foreach ($items as $item )

                <tr>
                  <td class="shoping__cart__item">
                    <img src="{{url('thumbs')}}/{{App\Models\Sanpham::find($item->id)->anh}}" alt="">
                    <h5>{{$item->name}}</h5>
                  </td>
                  <td class="shoping__cart__price">
                    {{number_format($item->price,0)}}
                  </td>
                  <td class="shoping__cart__quantity">
                    <div class="quantity">
                      <div class="pro-qty">
                        <span class="dec qtybtn" wire:click="quantityreduce('{{$item->rowId}}')">-</span>
                        <input type="text" value="{{$item->qty}}"
                          wire:change.prevent="quantitychange('{{$item->rowId}}',$event.target.value)">
                        <span class="inc qtybtn" wire:click="quantityincrease('{{$item->rowId}}')">+</span>
                      </div>
                    </div>
                  </td>
                  <td class="shoping__cart__total">
                    {{$item->subtotal(0)}}
                  </td>
                  <td class="shoping__cart__item__close">
                    <span class="icon_close" wire:click.prevent="delete('{{$item->rowId}}')"></span>
                  </td>
                </tr>

                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping__cart__btns">
            <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
            <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
              Upadate Cart</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="shoping__continue">
            <div class="shoping__discount">
              <h5>Discount Codes</h5>
              <form action="#">
                <input type="text" placeholder="Enter your coupon code" wire:model="counponCode">
                <div style="padding-top: 10px;">
                    <button type="submit" class="site-btn" wire:click.prevent='ApplyCounponCode'>APPLY COUPON</button>
                    <button type="submit" class="site-btn" wire:click.prevent='removeCoupon'>remmove COUPON</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="shoping__checkout">
            <h5>Cart Total</h5>
            <ul>


              <li>Subtotal <span>{{ Cart::subtotal(0)}}</span></li>
              <li>Tax <span>{{ Cart::tax(0)}}</span></li>
              <li>Total <span>{{ Cart::total(0)}}</span></li>
              @if (Session::has('coupon'))
              @if (Session::has('checkout'))


              <li>type <span>{{session()->get('coupon')['type']}}</span></li>
              <li>Total with discount <span>{{session()->get('checkout')['total']}}</span></li>
              @endif
              @endif

            </ul>
            <a href="{{route('checkoutbycontroller')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
          </div>
        </div>
      </div>
    </div>

  </section>

</div>

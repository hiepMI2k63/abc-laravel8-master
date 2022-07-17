<div>

    <section class="shoping-cart spad">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                  <table>
                    <thead>
                      <tr>
                        <th class="shoping__product">  Trancision Details</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
{{--
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

                      @endforeach --}}

                    </tbody>
                  </table>
                </div>
              </div>
        </div>
      </div>

    </section>

  </div>
  <div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
</div>

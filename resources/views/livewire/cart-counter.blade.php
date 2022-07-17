<div>
  <div class="header__cart">
    <ul>
      <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
      <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i> <span>{{Cart::count()}}</span></a></li>
    </ul>
    <div class="header__cart__price">item: <span>{{Cart::total()}}</span></div>
  </div>
</div>

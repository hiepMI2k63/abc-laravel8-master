<div>
    <div class="sidebar__item">
      <div class="latest-product__text">
        <h4>Latest Products</h4>
        <div class="latest-product__slider owl-carousel">
          <div class="latest-prdouct__slider__item">
            @foreach ($products as $i )
            <a href="#" wire:click="store({{$i->id}},'{{$i->ten}}', {{$i->gia}})"  class="latest-product__item">
              <div class="latest-product__item__pic">
                <img src="{{url('uploads')}}/{{$i->anh}}" alt="">
              </div>
              <div class="latest-product__item__text">
                <h6>{{Str::limit($i->ten, 30, $end='...')}}</h6>
                <span>
                  @if ($i->giaban)
                  {{number_format($i->giaban,0)}} <br /> <del class="font-weight-light">
                    {{number_format($i->gia,0)}} </del>
                  @else
                  {{number_format($i->gia,0)}}
                  @endif
                </span>
              </div>
            </a>
            @endforeach
          </div>


          <div class="latest-prdouct__slider__item">
            @foreach ($products as $i )
            <a href="{{route('productdetail', $i->id)}}"class="latest-product__item">
              <div class="latest-product__item__pic">
                <img src="{{url('uploads')}}/{{$i->anh}}" alt="">
              </div>
              <div class="latest-product__item__text">
                <h6>{{Str::limit($i->ten, 30, $end='...')}}</h6>
                <span>
                  @if ($i->giaban)
                  {{number_format($i->giaban,0)}} <br />
                  <del class="font-weight-light">
                    {{number_format($i->gia,0)}}
                  </del>
                  @else
                  {{number_format($i->gia,0)}}
                  @endif </span>
              </div>
            </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

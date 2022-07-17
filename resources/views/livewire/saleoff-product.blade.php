<div>
  <div class="product__discount">
    <div class="section-title product__discount__title">
      <h2>Sale Off</h2>
    </div>
    <div class="row">
      <div class="product__discount__slider owl-carousel">
          @foreach ($rating as $d)
             sdsds {{$d->rating}}
          @endforeach
        @foreach ($products as $product)

        <div class="col-lg-4">
          <div class="product__discount__item">

            <div class="product__discount__item__pic set-bg" >
                <a href="{{ route('productdetail',$product->id)}}">
                <img src="{{url('uploads')}}/{{$product->anh}}"></img>
                </a>
              <div class="product__discount__percent">-{{number_format(($product->gia-$product->giaban)*100/$product->gia)}}%</div>
              <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>

                <li><a href="javascript:void(0)" wire:click.prevent="store({{$product->id}},'{{$product->ten}}', {{$product->giaban}})">
                    <i class="fa fa-shopping-cart"></i></a>
                </li>
              </ul>

            </div>
            <div class="product__discount__item__text">
              <span>{{$product->nhomsanpham()->ten}}</span>

              <h5><a href="{{route('productdetail',$product->id)}}">{{$product->ten}}</a></h5>

              <div class="product__item__price">{{number_format($product->giaban,0)}} <span>{{number_format($product->gia,0)}}</span></div>
            </div>
            <p id="rateYo{{ $product->id }}"> </p>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>
</div>

@push('scripts')

@foreach ($rating as $product)
<script>

    $(function() {

        $(`#rateYo{{ $product->id }}`).rateYo({
            rating: 3.6,
            starWidth: "15px",
            readOnly: true,
        });

    });
</script>
@endforeach



@endpush

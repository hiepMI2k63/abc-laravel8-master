<section class="product-details spad">
    <div class="container">
        <div class="">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible fade show ">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('alert-' . $msg) }}
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ url('uploads') }}/{{ $product->anh }}"></img>
                        {{-- <img class="product__details__pic__item--large"
                            src="img/product/details/{{$product->anh}}" alt=""> --}}
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach ($images as $data)
                        <img
                        src="{{url('uploads') }}/{{$data}}" alt=""></img>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">

                <div class="product__details__text">
                    <h3>{{$product->ten}}</h3>
                    <div class="product__details__rating">
                        <div id="rateYoRoot"> </div>
                        <span>({{ $getreview->count() }} review)</span>
                    </div>
                    <div class="product__details__price"></div>
                    <p>{!! $product->mota !!}</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#"
                        wire:click.prevent="store({{ $product->id }},'{{ $product->ten }}', {{ $product->gia }})"
                        class="primary-btn">ADD TO CARD</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>

                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight</b> <span>0.5 kg</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12" wire:ignore>
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                    suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                    vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                    accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                    pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                    elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                    et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                    vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                    elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                    porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                    nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                    Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                    porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                    sed sit amet dui. Proin eget tortor risus.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <div class="container mt-5 mb-5">

                                    <div class="d-flex justify-content-center row">
                                        <div class="d-flex flex-column col-md-8">

                                            <div class="coment-bottom bg-white p-2 px-4">
                                                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
@if ($flag == 0)
         <div id="rateYo"> </div>
                                                    <img class="img-fluid img-responsive rounded-circle mr-2"
                                                        src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                                        width="38">
                                                    <input type="text" class="form-control mr-3" wire:model='comment'
                                                        placeholder="Add comment">
                                                    <button class="btn btn-primary" type="button"
                                                        wire:click.prevent='danhgia()'>Comment</button>

@endif


                                                </div>
                                                @if ($getreview)
                                                    @foreach ($getreview as $item)
                                                        <div class="commented-section mt-2">
                                                            <div
                                                                class="d-flex flex-row align-items-center commented-user">
                                                                <h5 class="mr-2"> {{ $item->user2->name }}
                                                                </h5>
                                                                <span class="dot mb-1"></span>
                                                                <p id="rateYo{{ $item->id }}"> </p>
                                                                <span class="dot mb-1"></span><span
                                                                    class="mb-1">{{ \Carbon\Carbon::createFromTimestamp(strtotime($item->created_at))->diffForHumans(\Carbon\Carbon::now()) }}</span>

                                                            </div>
                                                            <div class="comment-text-sm">
                                                                <span>{{ $item->comment }}</span>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                @else
                                                    <div class="text-center">Không có đánh giá nào</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation thông tin sản phấm </h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                    sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                    eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                    Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                    diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                    Proin eget tortor risus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related_product as $data )
                <div class="col-lg-3 col-md-4 col-sm-6">

                    <div class="product__item">

                        <div class="product__item__pic">

                            <img src="{{url('uploads')}}/{{$data->anh}}"></img>


                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>

                        <div class="product__item__text">
                            <h6><a href="#">{{$data->ten}}</a></h6>
                            <h5>{{$data->gia}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->


@push('scripts')
    <script>
        $(function() {
            $("#rateYoRoot").rateYo({
                rating: {{ $average }},
                starWidth: "15px",
                readOnly: true,
            });
        });
    </script>
    @foreach ($getreview as $item)
        <script>
            $(function() {
                $(`#rateYo{{ $item->id }}`).rateYo({
                    rating: {{ $item->rating }},
                    starWidth: "15px",
                    readOnly: true,
                });
            });
        </script>
    @endforeach
    <script>
        $(function() {
            $("#rateYo").rateYo({
                rating: 0,
                starWidth: "15px"
            }).on("rateyo.set", function(e, data) {
                Livewire.emit('storeRating', `${data.rating}`, "{{ $product->id }}");
            });
        });
    </script>


@endpush

@extends('layouts.site')

@section('content')

<!-- Hero Section Begin -->
@livewire('hero', ['home' => 0] )
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('site')}}/img/breadcrumb.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Shopping Cart</h2>
          <div class="breadcrumb__option">
            <a href="./index.html">Home</a>
            <span>Shopping Cart</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
    @livewire('test-livewire');
<!-- Shoping Cart Section End -->

@endsection

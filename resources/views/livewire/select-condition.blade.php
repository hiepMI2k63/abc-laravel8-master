<div>
    <div class="sidebar">
      <div class="sidebar__item">
        <h4>Nhóm sản phẩm</h4>
        <ul>
          @foreach ($categories as $category )
              <li><a href="#" wire:click.prevent="selectCategory({{$category->id}})">{{$category->ten}}
                  @if($category->id==$this->selectionCatid)
                      <span>***</span>
                      {{-- @dd($this->selectionCatid); --}}
                  @endif
                  </a>
              </li>
          @endforeach
        </ul>
      </div>
      <div class="sidebar__item" wire:ignore>
        <h4>Price</h4>
        <div class="price-range-wrap">
          <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="{{$pMin}}"
            data-max="{{$pMax}}">
            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
          </div>
          <div class="range-slider">
            <div class="price-input">
              <input type="text" id="minamount" class="number-separator">
              <input type="text" id="maxamount" class="number-separator">
            </div>
          </div>
        </div>
      </div>
      <div class="sidebar__item sidebar__item__color--option">
        <h4>Colors</h4>
        <div class="sidebar__item__color sidebar__item__color--white">
          <label for="white">
            White
            <input type="radio" id="white">
          </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--gray">
          <label for="gray">
            Gray
            <input type="radio" id="gray">
          </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--red">
          <label for="red">
            Red
            <input type="radio" id="red">
          </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--black">
          <label for="black">
            Black
            <input type="radio" id="black">
          </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--blue">
          <label for="blue">
            Blue
            <input type="radio" id="blue">
          </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--green">
          <label for="green">
            Green
            <input type="radio" id="green">
          </label>
        </div>
      </div>
      <div class="sidebar__item">
        <h4>Popular Size</h4>
        <div class="sidebar__item__size">
          <label for="large">
            Large
            <input type="radio" id="large">
          </label>
        </div>
        <div class="sidebar__item__size">
          <label for="medium">
            Medium
            <input type="radio" id="medium">
          </label>
        </div>
        <div class="sidebar__item__size">
          <label for="small">
            Small
            <input type="radio" id="small">
          </label>
        </div>
        <div class="sidebar__item__size">
          <label for="tiny">
            Tiny
            <input type="radio" id="tiny">
          </label>
        </div>
      </div>
      @livewire('latest-product')
    </div>
  </div>


  @push('scripts')
  <script type="text/javascript">
      function update_price(minPrice, maxPrice){
          // alert(minPrice);
          @this.call('updatePrice', minPrice, maxPrice);
      }
  </script>
  @endpush

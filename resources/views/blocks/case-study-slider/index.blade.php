@php
  if (! is_array($cards)) {
    return;
  }
@endphp

<div class="case-study-slider">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="case-study-slider__swiper swiper">
          <div class="swiper-wrapper">
            @foreach ($cards as $card)
              @include('blocks.case-study-slider.cards.' . $card['type'], ['card' => $card])
            @endforeach
          </div>
        </div>
        <div class="case-study-slider__navigation">
          <button class="swiper-navigation-button swiper-navigation-button_prev"></button>
          <button class="swiper-navigation-button swiper-navigation-button_next"></button>
        </div>
      </div>
    </div>
  </div>
</div>

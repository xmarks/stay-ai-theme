@php
  if (! is_array($reviews)) {
    return;
  }
@endphp

<div class="case-study-reviews-slider">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="case-study-reviews-slider__content">
          <div class="case-study-reviews-slider__swiper swiper">
            <div class="swiper-wrapper">
              @foreach ($reviews as $review)
                @include('blocks.case-study-reviews-slider.cards.default', ['review' => $review])
              @endforeach
            </div>
            <div class="case-study-reviews-slider__pagination-wrapper">
              <div class="case-study-reviews-slider__pagination swiper-pagination"></div>
            </div>
          </div>
          <div class="case-study-reviews-slider__navigation">
            <button
              class="swiper-navigation-button swiper-navigation-button_large swiper-navigation-button_prev case-study-reviews-slider__prev-button"
            ></button>
            <button
              class="swiper-navigation-button swiper-navigation-button_large swiper-navigation-button_next case-study-reviews-slider__next-button"
            ></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

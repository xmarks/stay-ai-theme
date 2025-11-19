@php
  if (! is_array($reviews)) {
    return;
  }
@endphp

<div class="reviews-slider">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="reviews-slider__swiper swiper">
          <div class="swiper-wrapper">
            @foreach ($reviews as $review)
              <div class="swiper-slide">
                <div class="review-card">
                  <div class="review-card__logo">
                    @if (! empty($review['attachment_id']))
                      {!! Html::get_image(['attachment_id' => $review['attachment_id']]) !!}
                    @endif
                  </div>
                  <p class="review-card__text typo-body-2">“{{ $review['text'] }}”</p>
                  @if (! empty($review['author']))
                    <div class="review-card__reviewer">
                      @if (! empty($review['author']['avatar']))
                        <div class="review-card__photo">
                          {!! Html::get_image(['attachment_id' => $review['author']['avatar']]) !!}
                        </div>
                      @endif

                      <div class="review-card__reviewer-text">
                        <span class="review-card__name typo-caption-3">{{ $review['author']['name'] }}</span>
                        <span class="review-card__occupation typo-caption-2">{{ $review['author']['position'] }}</span>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
          <div class="reviews-slider__pagination-wrapper">
            <div class="reviews-slider__pagination swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

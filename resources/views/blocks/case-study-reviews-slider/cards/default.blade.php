<div class="swiper-slide">
  <div class="case-study-reviews-slide">
    <div class="case-study-reviews-slide__left">
      <div class="case-study-reviews-slide__image">
        {!! Html::get_image(['attachment_id' => $review['attachment_id']]) !!}
      </div>
    </div>
    <div class="case-study-reviews-slide__right">
      @if (! empty($review['brand_logo']))
        {!! Html::get_image(['attachment_id' => $review['brand_logo'], 'class' => 'case-study-reviews-slide__logo']) !!}
      @endif

      <h3 class="case-study-reviews-slide__title">
        {{ $review['title'] }}
      </h3>
      @if (! empty($review['description']))
        <p class="case-study-reviews-slide__text">“{{ $review['description'] }}”</p>
      @endif

      @if (! empty($review['member']['name']))
        <div class="case-study-reviews-slide__author">
          <span class="case-study-reviews-slide__author-name typo-caption-3">
            {{ $review['member']['name'] }}
          </span>
          <span class="case-study-reviews-slide__author-position typo-caption-2">
            {{ $review['member']['position'] }}
          </span>
        </div>
      @endif

      @if (! empty($review['link']))
        {!! Html::link($review['link'] + ['class' => 'case-study-reviews-slide__button btn btn_underline btn_secondary']) !!}
      @endif
    </div>
  </div>
</div>

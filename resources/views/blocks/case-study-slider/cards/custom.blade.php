<div class="swiper-slide">
  <div class="case-study-card case-study-card_cta">
    <div class="case-study-card__text-content">
      <div class="case-study-card__icon">
        @if (! empty($card['icon']))
          {!! Html::get_image(['attachment_id' => $card['icon']]) !!}
        @endif
      </div>
      @if (! empty($card['title']))
        <span class="case-study-card__title">{!! $card['title'] !!}</span>
      @endif

      @if (! empty($card['text']))
        <div class="case-study-card__text typo-body-2">{!! $card['text'] !!}</div>
      @endif

      @if (! empty($card['button']))
        {!! Html::link($card['button'] + ['class' => 'case-study-card__button btn btn_secondary']) !!}
      @endif
    </div>
  </div>
</div>

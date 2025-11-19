<div class="bento-card bento-card_with-icon">
  @if (! empty($card['icon']))
    <div class="bento-card__icon-wrapper">
      {!! Html::get_image(['attachment_id' => $card['icon']]) !!}
    </div>
  @endif

  <div class="bento-card__text-content-wrapper">
    @if (! empty($card['title']))
      <h3 class="bento-card__title typo-headline-4">{{ $card['title'] }}</h3>
    @endif

    @if (! empty($card['text']))
      <p class="bento-card__text typo-body-2">{{ $card['text'] }}</p>
    @endif

    @if (! empty($card['link']))
      {!!
        Html::link([
          ...$card['link'],
          'class' => 'bento-card__button btn btn_underline btn_primary',
        ])
      !!}
    @endif
  </div>
</div>

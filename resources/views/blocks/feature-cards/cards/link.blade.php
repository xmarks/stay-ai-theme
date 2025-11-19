<a
  href="{{ $card['link']['url'] }}"
  @class(array_merge($card['classes'], ['feature-card_link']))
  style="{{ $card['style'] }}"
>
  <div class="feature-card__head">
    <span class="feature-card__title" style="color: {{ $card['title_color'] }}">
      {!! $card['title'] !!}
    </span>
  </div>

  @if (! empty($card['animated']) && ! empty($card['animation']))
    <div class="feature-card__animation-wrapper">
      {!! Html::get_image(['src' => $card['animation'], 'class' => 'feature-card__animation']) !!}
    </div>
  @else
    <div class="feature-card__image-wrapper">
      @if (! empty($card['image']))
        <div class="feature-card__image feature-card__image_desktop">
          {!! Html::get_image(['attachment_id' => $card['image']]) !!}
        </div>
        <div class="feature-card__image feature-card__image_mobile">
          {!! Html::get_image(['attachment_id' => $card['mobile_image'] ?: $card['image']]) !!}
        </div>
      @endif
    </div>
  @endif
</a>

<div @class($card['classes']) style="{{ $card['style'] }}">
  <div class="feature-card__head">
    <span class="feature-card__title" style="color: {{ $card['title_color'] }}">
      {!! $card['title'] !!}
    </span>
    @if (! empty($card['link']))
      {!! Html::link($card['link'] + ['class' => 'btn btn_underline btn_secondary feature-card__link']) !!}
    @endif
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
</div>

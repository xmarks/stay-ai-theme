@php
  $count_cards = count($cards);
  $col_class = match ($count_cards) {
    1 => 'col-lg-4 offset-lg-4',
    2 => 'col-lg-8 offset-lg-2',
    default => 'col-12',
  };
  $wrapper_class = match ($count_cards) {
    1 => 'pricing-cards__wrapper_one',
    2 => 'pricing-cards__wrapper_two',
    default => '',
  };
@endphp

<section class="pricing-cards">
  <div class="container">
    <div class="row">
      <div class="{{ $col_class }}">
        <div class="pricing-cards__wrapper {{ $wrapper_class }}">
          @if (! empty($cards))
            @foreach ($cards as $card)
              <div
                @class(['pricing-card', 'pricing-card_active' => $card['primary_plan']])
                @style(['--mt_desktop: ' . $card['mt_desktop'] . 'px', '--mt_mobile: ' . $card['mt_mobile'] . 'px'])
              >
                <div class="pricing-card__content">
                  <h3 class="typo-headline-3 pricing-card__title">
                    {!! $card['primary_plan'] ? '<i>' . $card['title'] . '</i>' : $card['title'] !!}
                  </h3>
                  <p class="typo-body-2 pricing-card__text">{{ $card['text'] }}</p>
                  <ul class="pricing-card__list">
                    @foreach ($card['plan_items'] as $item)
                      <li class="typo-body-2">{{ $item['plan_item'] }}</li>
                    @endforeach
                  </ul>
                </div>
                <div class="pricing-card__footer">
                  <div class="pricing-card__price">
                    @if (! empty($card['price']['value']))
                      <div class="pricing-card__price-container">
                        <h4 class="typo-headline-4 pricing-card__price-value">{{ $card['price']['value'] }}</h4>
                        @if (! empty($card['price']['time']))
                          <span class="typo-body-2 pricing-card__price-period">{{ $card['price']['time'] }}</span>
                        @endif
                      </div>
                    @endif

                    @if (! empty($card['price']['caption']))
                      <p class="typo-caption-2 pricing-card__price-caption">{{ $card['price']['caption'] }}</p>
                    @endif

                    @if (! empty($card['price']['description']))
                      <p class="typo-body-2 pricing-card__price-description">{{ $card['price']['description'] }}</p>
                    @endif
                  </div>

                  @if (! empty($card['link']))
                    {!! Html::link($card['link'] + ['class' => 'btn btn_primary pricing-card__button']) !!}
                  @endif
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

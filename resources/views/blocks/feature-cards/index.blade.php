@php
  if (! is_array($cards)) {
    return;
  }
@endphp

<div @class([
  'feature-cards',
  'feature-cards_3-column' => $layout === 'three_column',
])>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="feature-cards__content">
          @foreach ($cards as $card)
            @php
              $card['classes'] = [
                'feature-card',
                'has-text-align-left' => $card['align_text'] === 'left',
                'has-text-align-center' => $card['align_text'] === 'center',
                'has-text-align-right' => $card['align_text'] === 'right',
                'feature-card_inside-image-indent' => ! empty($images_with_indent),
              ];
              $card['style'] = "
                --color-first: {$card['background_gradient']['first_color']};
                --color-second: {$card['background_gradient']['second_color']};
                --color-hover: {$card['hover_color']};
              ";
            @endphp

            @if (! empty($card['link_type']) && $card['link_type'] === 'card')
              @include('blocks.feature-cards.cards.link', ['card' => $card])
            @else
              @include('blocks.feature-cards.cards.default', ['card' => $card])
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

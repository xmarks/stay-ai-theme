<section class="tools-cards">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if (! empty($cards))
          <div class="tools-cards__wrapper">
            @foreach ($cards as $card)
              <div class="tools-card">
                @if (! empty($card['icon']))
                  <div class="tools-card__icon" style="mask-image: url({{ $card['icon'] }})"></div>
                @endif

                @if (! empty($card['text']))
                  <p class="typo-subtitle-1 tools-card__text">{{ $card['text'] }}</p>
                @endif
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

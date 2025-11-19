<section class="reviews">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if (! empty($cards))
          <div class="reviews__wrapper">
            @foreach ($cards as $index => $card)
              <div
                @class([
                  'review-item',
                  'hidden' => $index >= $initial_amount,
                ])
              >
                @if (! empty($card['review']))
                  <p class="typo-body-2 review-item__content">”{!! $card['review'] !!}”</p>
                @endif

                <div class="review-item__footer">
                  @if (! empty($card['rating']))
                    <div class="review-item__rating">
                      @foreach (range(1, 5) as $i)
                        <x-icon name="rating-star" @class([$i <= $card['rating'] ? 'active' : 'inactive']) />
                      @endforeach
                    </div>
                  @endif

                  @if (! empty($card['author']))
                    <p class="review-item__author">{{ $card['author'] }}</p>
                  @endif
                </div>
              </div>
            @endforeach
          </div>

          @if (count($cards) > $initial_amount)
            <button type="button" data-per-page="{{ $per_page }}" class="btn btn_primary reviews__load-more">
              {{ __('Load more', 'sage') }}
            </button>
          @endif
        @endif
      </div>
    </div>
  </div>
</section>

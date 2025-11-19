<section class="multi-steps">
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <div class="multi-steps__sticky-content">
          <InnerBlocks />
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1">
        @if (! empty($steps))
          <div class="multi-steps__cards">
            @foreach ($steps as $step)
              <div
                @class([
                  'multi-steps-card',
                  'multi-steps-card_active' => $loop->first,
                ])
              >
                <div class="multi-steps-card__circle">
                  @switch($step_marks)
                    @case('numbers')
                      <span class="typo-caption-3 multi-steps-card__number">
                        {{ sprintf('%02d', $loop->iteration) }}
                      </span>

                      @break
                    @default
                      <x-icon name="check" class="multi-steps-card__icon" />
                  @endswitch
                </div>
                <h4 class="typo-headline-4">{{ $step['title'] }}</h4>
                <p class="typo-body-2 multi-steps-card__text">{{ $step['text'] }}</p>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

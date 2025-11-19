<div class="metrics">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="metrics__content">
          <ul class="metrics__list">
            @foreach ($items as $item)
              <li class="metrics__item metric">
                <span class="metric__value">
                  <span class="metric__value-wrapper">
                    <span class="metric__number">{{ $item['number'] }}</span>
                    <span class="metric__symbol">{{ $item['symbol'] }}</span>
                  </span>
                </span>
                <p class="metric__description typo-caption-3">{!! $item['caption'] !!}</p>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

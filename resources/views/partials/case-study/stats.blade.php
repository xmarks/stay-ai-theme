@php
  if (! isset($stats) || ! is_array($stats['items'])) {
    return;
  }
@endphp

<section class="article-page-metrics">
  <div div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="article-page-metrics__title">{{ $stats['title'] }}</h2>
      </div>
    </div>
  </div>
  <div class="metrics">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="metrics__content">
            <ul class="metrics__list">
              @foreach ($stats['items'] as $key => $item)
                <li class="metrics__item metric">
                  <span class="metric__value">
                    <span class="metric__value-wrapper">
                      <span class="metric__number">{{ $item['value'] }}</span>
                      <span class="metric__symbol">{{ $item['unit'] }}</span>
                    </span>
                  </span>
                  <p class="metric__description typo-caption-3">{{ $item['text'] }}</p>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

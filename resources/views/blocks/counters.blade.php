@php
  if (! is_array($counters)) {
    return;
  }

  $total_count = count($counters);
  $is_odd_count = $total_count % 2 !== 0;
@endphp

<div class="metrics metrics_simple-text">
  <div class="metrics__content">
    <ul class="metrics__list">
      @foreach ($counters as $key => $item)
        <li
          @class([
            'metrics__item metric',
            'metrics__item_w-100' => $key === $total_count - 1 && $is_odd_count,
          ])
        >
          <span class="metric__value">
            <span class="metric__value-wrapper">
              @if (! empty($item['value']))
                <span class="metric__number">{{ $item['value'] }}</span>
              @endif

              @if (! empty($item['unit']))
                <span class="metric__symbol">{{ $item['unit'] }}</span>
              @endif
            </span>
          </span>
          @if (! empty($item['text']))
            <p class="metrics__description metric__description typo-caption-3">{{ $item['text'] }}</p>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</div>

@if ($date || $time)
  <div class="info-badges">
    @if ($date)
      <div class="info-badge">
        <div class="info-badge__container">
          <x-icon name="union" />
          <span class="info-badge__title typo-subtitle-2">{{ $date }}</span>
        </div>
      </div>
    @endif

    @if ($time)
      <div class="info-badge">
        <div class="info-badge__container">
          <x-icon name="union" />
          <span class="info-badge__title typo-subtitle-2">{{ $time }}</span>
        </div>
      </div>
    @endif
  </div>
@endif

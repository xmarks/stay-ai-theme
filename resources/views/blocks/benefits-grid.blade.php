@php
  if (! is_array($items)) {
      return;
  }
@endphp

<div class="benefits-grid">
  @foreach ($items as $item)
    <div class="benefits-grid__item">
      @if (! empty($item["icon"]))
        <div
          @class([
              "benefits-grid__image",
              "benefits-grid__image_shadow" => $item["is_shadow"],
          ])
          @if (! empty($item["icon_background_color"]))
              @style("--benefits-grid-img-color: " . $item["icon_background_color"])
          @endif
        >
          {!! Html::get_image(["attachment_id" => $item["icon"]]) !!}
        </div>
      @endif

      @if (! empty($item["title"]))
        <h3 class="typo-subtitle-2 benefits-grid__title">{{ $item["title"] }}</h3>
      @endif
    </div>
  @endforeach
</div>

@php
  if (! is_array($logos)) {
    return;
  }

  $min_logos = 18;
  $count_logos = count($logos);
  $count_repeat = ceil($min_logos / $count_logos) + 1;

  foreach ($logos as $key => $logo) {
    $logos[$key] = sprintf('<li class="logos-carousel__item">%s</li>', Html::get_image(['attachment_id' => $logo, 'loading' => 'eager']));
  }

  if ($count_logos >= 10) {
    $logos_mobile = implode('', array_reverse($logos));
  }

  $logos = implode('', $logos);

  $speed ??= 10;
  $mobile_speed = $speed * 2;
@endphp

<section
  @class(['logos-carousel', 'no-scrolling' => ! empty($disable_carousel)])
  style="--desktopSpeed: {{ $speed }}s; --mobileSpeed: {{ $mobile_speed }}s"
>
  <div class="logos-carousel__content">
    @empty($disable_carousel)
      <div class="logos-carousel__line">
        @for ( $i = 0; $i < $count_repeat; $i++ )
          <ul class="logos-carousel__list" {{ $i > 0 ? 'aria-hidden="true"' : '' }}>
            {!! $logos !!}
          </ul>
        @endfor
      </div>
      @isset($logos_mobile)
        <div class="logos-carousel__line logos-carousel__line_mobile">
          @for ( $i = 0; $i < $count_repeat; $i++ )
            <ul class="logos-carousel__list" {{ $i > 0 ? 'aria-hidden="true"' : '' }}>
              {!! $logos_mobile !!}
            </ul>
          @endfor
        </div>
      @endisset
    @else
      <div class="logos-carousel__line">
        <ul class="logos-carousel__list">
          {!! $logos !!}
        </ul>
      </div>
    @endempty
  </div>
</section>

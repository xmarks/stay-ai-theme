@extends('layouts.app')

@section('content')
  <section class="not-found">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="not-found__container">
            <h1 class="not-found__title">
              <i>404</i>
            </h1>
            @if (! empty($subtitle))
              <h2 class="typo-subtitle-1 not-found__subtitle">{{ $subtitle }}</h2>
            @endif

            @if (! empty($text))
              <p class="typo-body-2 not-found__text">
                {!! $text !!}
              </p>
            @endif

            @if (! empty($links))
              <div class="not-found__links">
                @foreach ($links as $link)
                  <a
                    href="{{ $link['link']['url'] }}"
                    class="not-found__link"
                    @if(! empty($link['link']['target'])) target="{{ $link['link']['target'] }}" @endif)
                  >
                    <div class="not-found__link-content">
                      @if (! empty($link['icon']))
                        {!! Html::get_image(['attachment_id' => $link['icon']]) !!}
                      @endif

                      <span class="typo-subtitle-1">{{ $link['link']['title'] }}</span>
                    </div>
                    <div class="not-found__link-arrow"><x-icon name="arrow-down" /></div>
                  </a>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

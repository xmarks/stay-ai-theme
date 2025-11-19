<section class="webinar-summary">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="webinar-summary__container">
          <div class="webinar-summary__col">
            <div class="webinar-summary__text">
              @if (! empty($title))
                <span class="webinar-summary__title typo-caption-1">{{ $title }}</span>
              @endif

              @if (! empty($text))
                <p class="webinar-summary__description typo-body-2">{{ $text }}</p>
              @endif
            </div>
          </div>
          @if (! empty($list['items']))
            <div class="webinar-summary__col">
              <div class="webinar-summary__info">
                <div class="webinar-summary__list">
                  @if (! empty($list['title']))
                    <span class="webinar-summary__list-title typo-body-2">{{ $list['title'] }}</span>
                  @endif

                  <ul>
                    @foreach ($list['items'] as $item)
                      <li class="webinar-summary__list-item typo-body-2">
                        <div class="list-icon">
                          @php($icon_url = $item['icon_type'] === 'custom' ? $item['icon'] : asset('images/icons/union.svg'))
                          {!! Html::get_image(['src' => $icon_url]) !!}
                        </div>
                        {{ $item['text'] }}
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

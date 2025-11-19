@if (is_array($items))
  <section class="custom-list">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <ul class="custom-list__list">
            @foreach ($items as $item)
              <li
                @class([
                  'custom-list__item custom-list-item custom-list-item_width-xl',
                  'custom-list-item_hide-text' => $item['hide_text'],
                ])
              >
                @php($icon_url = $item['icon_type'] === 'custom' ? $item['icon'] : asset('images/icons/union.svg'))
                {!! Html::get_image(['src' => $icon_url, 'class' => 'custom-list-item__icon']) !!}

                <div class="custom-list-item__content">
                  @if (! empty($item['subtitle']))
                    <h5 class="typo-subtitle-2 custom-list-item__subtitle">
                      {{ $item['subtitle'] }}
                      @if (! empty($item['delimiter']))
                        <span class="custom-list-item__special-character">{{ $item['delimiter'] }}</span>
                      @endif
                    </h5>
                  @endif

                  @if (! empty($item['text']))
                    <p class="typo-body-2 custom-list-item__text">&#8200;{{ $item['text'] }}</p>
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>
@endif

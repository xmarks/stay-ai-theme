<section class="brief-description">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="brief-description__container">
          <div class="brief-description__col">
            <div class="brief-description__text">
              @if (! empty($title))
                <span class="brief-description__title typo-headline-4">{{ $title }}</span>
              @endif

              @if (! empty($text))
                <p class="brief-description__description typo-body-2">{{ $text }}</p>
              @endif

              @if (! empty($list['items']))
                <div class="brief-description__list">
                  @if (! empty($list['title']))
                    <span class="brief-description__list-title typo-body-2">{{ $list['title'] }}</span>
                  @endif

                  <ul>
                    @foreach ($list['items'] as $item)
                      <li class="typo-body-2">
                        <div class="list-icon">
                          @php($icon_url = $item['icon_type'] === 'custom' ? $item['icon'] : asset('images/icons/union.svg'))
                          {!! Html::get_image(['src' => $icon_url]) !!}
                        </div>
                        {{ $item['text'] }}
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
          @if (array_filter([$rc_subtitle, $rc_text, $rc_speakers]))
            <div class="brief-description__col">
              <div class="brief-description__info">
                <div class="video-brief-card">
                  <div class="video-brief-card__container">
                    @if (! empty($rc_subtitle))
                      <div class="video-brief-card__item">
                        <span class="video-brief-card__item-title typo-caption-1">{{ $rc_subtitle }}</span>
                        <div class="video-brief-card__item-content">
                          <p class="typo-body-2">{{ $rc_text }}</p>
                        </div>
                      </div>
                    @endif

                    @if (! empty($rc_speakers))
                      <div class="video-brief-card__item">
                        <span class="video-brief-card__item-title typo-caption-1">{{ __('Speakers', 'sage') }}</span>
                        <div class="video-brief-card__item-content">
                          <div class="video-brief-card__item-speakers">
                            @foreach ($rc_speakers as $speaker)
                              <div class="video-brief-speaker">
                                <div class="video-brief-speaker__container">
                                  <div class="video-brief-speaker__img">
                                    {!! Html::get_image(['attachment_id' => $speaker['avatar'] ?: $speaker['attachment_id']]) !!}
                                  </div>
                                  <div class="video-brief-speaker__text">
                                    <span class="video-brief-speaker__author typo-caption-2">
                                      {{ $speaker['title'] }}
                                    </span>
                                    <span class="video-brief-speaker__position typo-caption-2">
                                      {{ $speaker['designation'] }}
                                    </span>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@unless (empty($video_file) && empty($youtube_link))
  @php
    $html_video_class = 'video__html' . (! empty($video_poster) ? ' is-hidden' : '');
    $yt_video_class = 'video__yt' . (! empty($video_poster) ? ' is-hidden' : '');
  @endphp

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div @class(['video', 'video_frame' => $video_frame ?? false, 'video_shadow' => $video_shadows ?? false])>
          <div class="video__wrapper">
            <div class="video__frame"></div>

            @if (! empty($video_poster))
              <div class="video-poster is-visible">
                {!! Html::get_image(['attachment_id' => $video_poster]) !!}
              </div>

              <button type="button" class="video-play-btn is-visible">
                <x-icon name="play" />
              </button>
            @endif

            @if (! empty($video_file))
              {!!
                Html::get_video([
                  'src' => $video_file,
                  'class' => $html_video_class,
                  'controls' => true,
                ])
              !!}
            @else
              <div class="{{ $yt_video_class }}" data-url="{{ $youtube_link }}"></div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endunless

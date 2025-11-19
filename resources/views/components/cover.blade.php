@unless ($use_post_image)
  <div class="alternative-cover">
    <div class="alternative-cover__wrapper">
      <div class="alternative-cover__icon"></div>
      <p class="alternative-cover__text">{!! $title !!}</p>
    </div>
    <div class="img">
      {!! Html::get_image(['src' => $url, 'alt' => $title]) !!}
    </div>
  </div>
@else
  <div class="img">
    {!! Html::get_image(['attachment_id' => $thumbnail_id]) !!}
  </div>
@endunless

<div class="swiper-slide">
  <div class="case-study-card">
    <div class="case-study-card__image">
      @if (! empty($thumbnail_id))
        {!! Html::get_image(['attachment_id' => $thumbnail_id]) !!}
      @endif
    </div>
    <div class="case-study-card__tag">
      @foreach ($categories as $tag)
        <span>{{ $tag->name }}</span>
      @endforeach
    </div>
    <span class="case-study-card__title typo-subtitle-1">{!! $title !!}</span>
    {!!
      Html::link([
        'text' => __('Read case study', 'sage'),
        'href' => $link,
        'class' => 'case-study-card__button btn btn_tertiary',
      ])
    !!}
  </div>
</div>

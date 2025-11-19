<a class="webinar-card" href="{{ $resource['link'] }}">
  <div class="webinar-card__container">
    @if ($resource['attachment_id'])
      <div class="webinar-card__img">
        {!! Html::get_image(['attachment_id' => $resource['attachment_id']]) !!}
      </div>
    @endif

    <div class="webinar-card__text">
      <div class="webinar-card__tags">
        @if ($resource['category'])
          <div class="webinar-card__tag">
            <span class="typo-caption-3">{{ $resource['category']->name }}</span>
          </div>
        @endif
      </div>
      <span class="webinar-card__title typo-subtitle-1">
        {{ $resource['title'] }}
      </span>
    </div>
  </div>
</a>

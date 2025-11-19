<a class="case-study-preview-card" href="{{ $link }}">
  <div class="case-study-preview-card__container">
    <div class="case-study-preview-card__img">
      @if (! empty($thumbnail_id))
        {!! Html::get_image(['attachment_id' => $thumbnail_id]) !!}
      @endif
    </div>

    <div class="case-study-preview-card__text">
      @if (! empty($categories))
        <div class="case-study-preview-card__tags">
          @foreach ($categories as $category)
            <span class="typo-caption-1">{{ $category->name }}</span>
            @if (! $loop->last)
              <span class="typo-caption-1">|</span>
            @endif
          @endforeach
        </div>
      @endif

      <span class="case-study-preview-card__title typo-subtitle-1">
        {!! $title !!}
      </span>
    </div>
  </div>
</a>

<a class="blog-article-preview-card" href="{{ $link }}">
  <div class="blog-article-preview-card__container">
    <x-cover post="{{ $post->id }}" />
    <div class="blog-article-preview-card__text">
      <div class="blog-article-preview-card__tags">
        @if (! empty($tag))
          <span class="typo-caption-2">{{ $tag }}</span>
          <span class="typo-caption-2">|</span>
        @endif

        <span class="typo-caption-2">{{ $date->format('F d, Y') }}</span>
      </div>
      <span class="blog-article-preview-card__title typo-subtitle-1" title="{!! $title !!}">{!! $title !!}</span>
    </div>
  </div>
</a>

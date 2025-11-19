<section class="article-page-heading">
  <div class="container">
    <div class="row">
      <div class="col-xxl-6 col-lg-8 offset-xxl-3 offset-xl-1 offset-lg-0 col-12">
        <div class="article-page-heading__info">
          @if (! empty($reading_time))
            <span class="article-page-heading__info-read-time typo-caption-2">
              {{ sprintf(__('%d min read', 'sage'), $reading_time) }}
            </span>
          @endif

          <span class="article-page-heading__info-date typo-caption-2">{{ $post_date->format('F d, Y') }}</span>
        </div>
        <h1 class="article-page-heading__title typo-headline-2">{!! $title !!}</h1>
      </div>
    </div>
  </div>
</section>

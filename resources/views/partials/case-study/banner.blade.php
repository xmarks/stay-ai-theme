<section class="article-page-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12">
        <div class="article-page-banner__text-content">
          <div class="article-page-banner__tag">
            @if (! empty($industry))
              <span>{{ $industry }}</span>
            @endif

            @if (! empty($migrated_from))
              <span>{{ sprintf(__('Migrated from %s', 'sage'), $migrated_from) }}</span>
            @endif
          </div>

          @if (isset($banner) && $banner['title_type'] === 'custom')
            <h1 class="article-page-banner__title typo-headline-2">{!! $banner['title'] !!}</h1>
          @else
            <h1 class="article-page-banner__title typo-headline-2">{!! $title !!}</h1>
          @endif

          @if (isset($banner) && ! empty($banner['description']))
            <p class="article-page-banner__text typo-body-1">{!! $banner['description'] !!}</p>
          @endif
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1 col-12">
        <div class="article-page-banner__image">
          {!! Html::get_image(['attachment_id' => $thumbnail_id]) !!}
        </div>
      </div>
    </div>
  </div>
</section>

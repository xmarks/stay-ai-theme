<section class="article-page-cta">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if (! empty($subtitle))
          <span class="article-page-cta__tag tag tag_static typo-caption-3">
            <div class="tag__icon"></div>
            <span class="tag__text">{!! $subtitle !!}</span>
          </span>
        @endif

        @if (! empty($title))
          <h3 class="article-page-cta__title typo-headline-2">{!! $title !!}</h3>
        @endif

        @if (! empty($button))
          {!!
            Html::link([
              ...$button,
              'class' => 'article-page-cta__button btn btn_primary',
            ])
          !!}
        @endif
      </div>
    </div>
  </div>
</section>

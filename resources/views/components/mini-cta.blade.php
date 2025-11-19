@if (! empty($title) || ! empty($button))
  <section class="article-page-cta-sidebar">
    <div class="article-page-cta-sidebar__container">
      @if (! empty($title))
        <span class="article-page-cta-sidebar__title typo-subtitle-1">{!! $title !!}</span>
      @endif

      @if (! empty($button))
        {!!
          Html::link([
            ...$button,
            'class' => 'article-page-cta-sidebar__button btn btn_secondary ',
          ])
        !!}
      @endif
    </div>
  </section>
@endif

@php
  global $wp_query;
  $paged = (int) $wp_query->query_vars['paged'] ?: 1;
  $max_num_pages = (int) $wp_query->max_num_pages;
@endphp

<div
  @class([
    'load-more-articles',
    'load-more-articles_show-button' => $paged > 1 && $paged < $max_num_pages,
    'no-request-on-init' => $paged > 1 || $paged == $max_num_pages,
  ])
>
  <div class="load-more-articles__track"></div>
  <div class="load-more-articles__container">
    <div class="load-more-articles__content">
      @if ($paged == $max_num_pages || ! empty($_GET))
        <button class="load-more-articles__button btn btn_primary">
          {{ __('Show more', 'sage') }}
        </button>
      @else
        <a href="{{ get_pagenum_link($paged + 1) }}" class="load-more-articles__button btn btn_primary">
          {{ __('Show more', 'sage') }}
        </a>
      @endif
      <div class="load-more-articles__loader">
        <span class="load-more-articles__loader-content"></span>
      </div>
    </div>
  </div>
</div>

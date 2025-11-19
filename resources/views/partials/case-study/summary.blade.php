@php
  if (! isset($summary) || ! is_array($summary['attributes'])) {
    return;
  }
@endphp

<section class="article-page-summary">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="article-page-summary__content">
          <div class="article-page-summary__left">
            <h2 class="article-page-summary__title typo-caption-1">{{ $summary['title'] }}</h2>
            <p class="article-page-summary__text typo-body-2">{!! $summary['description'] !!}</p>
          </div>
          <div class="article-page-summary__right">
            <div class="article-page-summary__info">
              <div class="article-page-summary__info-list">
                @foreach ($summary['attributes'] as $key => $attribute)
                  <div class="article-page-summary__info-item">
                    <span class="article-page-summary__info-item-title typo-body-2">{{ $attribute['title'] }}</span>
                    <span class="article-page-summary__info-item-value typo-body-2">{{ $attribute['value'] }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

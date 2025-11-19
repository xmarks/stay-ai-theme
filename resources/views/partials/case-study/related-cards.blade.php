<section class="article-page-related">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="article-page-related__tag tag tag_static typo-caption-3">
          <div class="tag__icon"></div>
          <span class="tag__text">{{ $subtitle }}</span>
        </div>
        <h2 class="article-page-related__title">{{ $title }}</h2>
      </div>
    </div>
  </div>
  <div class="case-study-slider">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="case-study-slider__swiper swiper">
            <div class="swiper-wrapper">
              @if (! empty($posts))
                @php
                  global $post;
                  $tmp_post = $post;
                @endphp

                @foreach ($posts as $post)
                  @php(setup_postdata($post))
                  @include('partials.case-study.related-card')
                @endforeach

                @php($post = $tmp_post)
              @endif
            </div>
          </div>
          <div class="case-study-slider__navigation">
            <button class="swiper-navigation-button swiper-navigation-button_prev"></button>
            <button class="swiper-navigation-button swiper-navigation-button_next"></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

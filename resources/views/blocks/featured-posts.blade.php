@unless (empty($posts))
  <section class="featured-posts">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="featured-posts__slider">
            <div class="swiper">
              <div class="swiper-wrapper">
                @foreach ($posts as $post)
                  <div class="swiper-slide">
                    <a class="feature-post-card" href="{{ $post['link'] }}">
                      <div class="feature-post-card__container">
                        <x-cover post="{{ $post['id'] }}" />
                        <div class="feature-post-card__text">
                          <div class="feature-post-card__tags">
                            @if (! empty($post['tag']))
                              <span class="typo-caption-2">{{ $post['tag'] }}</span>
                              <span class="typo-caption-2">|</span>
                            @endif

                            <span class="typo-caption-2">{{ $post['date']->format('F d, Y') }}</span>
                          </div>
                          <span class="feature-post-card__title typo-subtitle-1">
                            {!! $post['title'] !!}
                          </span>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endunless

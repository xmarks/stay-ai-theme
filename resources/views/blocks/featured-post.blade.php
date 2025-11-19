@if ($post)
  <section class="featured-post">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <a class="featured-post__container" href="{{ $post['link'] }}">
            <div class="featured-post__img-container">
              <x-cover post="{{ $post['id'] }}" />
            </div>
            <div class="featured-post__text">
              <div class="featured-post__tags">
                @if (! empty($post['tag']))
                  <span class="typo-caption-2">{{ $post['tag'] }}</span>
                  <span class="typo-caption-2">|</span>
                @endif

                <span class="typo-caption-2">{{ $post['date']->format('F d, Y') }}</span>
              </div>

              <span class="featured-post__title typo-headline-3">{!! $post['title'] !!}</span>
              @if (! empty($post['excerpt']))
                <p class="featured-post__description typo-body-2">{!! $post['excerpt'] !!}</p>
              @endif
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
@endif

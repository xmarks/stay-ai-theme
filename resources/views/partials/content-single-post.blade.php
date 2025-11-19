<div class="article-page">
  <section class="article-page-progress-bar progress-bar">
    <div class="article-page-progress-bar__line">
      <div class="article-page-progress-bar__line-active"></div>
    </div>
  </section>

  @include('partials.breadcrumbs')

  @include('partials.post.banner', ['title' => $title])

  <div class="article-page-text-content article-page-text-content_post">
    <div class="container">
      <div class="row">
        <div class="col-xxl-6 col-lg-8 offset-xxl-3 offset-xl-1 offset-lg-0 col-12">
          <article @php(post_class(['simple-text simple-text_article-page simple-text_post']))>
            @php(the_content())
          </article>
          <footer>
            @include('partials.post.post-footer')
          </footer>
        </div>
        <div class="col-xl-3 col-lg-4 col-12">
          <div class="article-page-text-content__sidebar">
            <div class="article-page-text-content__sidebar-wrapper">
              <div class="article-page-toc">
                {!! do_shortcode('[ez-toc]') !!}
              </div>

              <div class="article-page-text-content__sidebar-sticky-wrapper">
                @if (! empty($linked_blogs['posts']))
                  @include('partials.post.related', $linked_blogs)
                @endif

                <div class="article-page-text-content__sidebar-cta-mini-wrapper">
                  <x-mini-cta />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@if (! empty($cta))
  @include('blocks.cta', [...$cta])
@endif

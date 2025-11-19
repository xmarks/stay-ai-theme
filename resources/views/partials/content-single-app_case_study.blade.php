<div class="article-page">
  <section class="article-page-progress-bar progress-bar">
    <div class="article-page-progress-bar__line">
      <div class="article-page-progress-bar__line-active"></div>
    </div>
  </section>

  @include('partials.breadcrumbs')

  @include('partials.case-study.banner', ['industry' => $industry, 'migrated_from' => $migrated_from, 'title' => $title, 'banner' => $banner ?? null, 'thumbnail_id' => $thumbnail_id])

  @if (isset($stats))
    @include('partials.case-study.stats', ['stats' => $stats])
  @endif

  @if (isset($summary))
    @include('partials.case-study.summary', ['summary' => $summary])
  @endif

  <section class="article-page-text-content">
    <div class="container">
      <div class="row">
        <div class="col-xxl-6 col-lg-8 offset-xxl-3 offset-xl-1 offset-lg-0 col-12">
          <article @php(post_class(['simple-text simple-text_article-page']))>
            @php(the_content())
          </article>
          @include('partials.case-study.page-footer')
        </div>
        <div class="col-xl-3 col-lg-4 col-12">
          <div class="article-page-text-content__sidebar">
            <x-mini-cta />
          </div>
        </div>
      </div>
    </div>
  </section>

  @if (! empty($cta))
    @include('blocks.cta', [...$cta])
  @endif

  @if (isset($linked_case_studies) && ! empty($linked_case_studies['case_studies']))
    @include('partials.case-study.related-cards', ['posts' => $linked_case_studies['case_studies'], 'title' => $linked_case_studies['title'], 'subtitle' => $linked_case_studies['subtitle']])
  @endif
</div>

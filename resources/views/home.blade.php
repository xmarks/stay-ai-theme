@use('App\Helpers\ContentManager')

@extends('layouts.app')

@section('content')
  @section('posts_archive')
    @if (have_posts())
      @include('partials.blog.search')
      @includeWhen(! empty($categories), 'partials.archive.category-filter', ['categories' => $categories, 'label' => __('All posts', 'sage')])

      @php($auto_scroll = ! $load_more || ! $load_more['enabled'] ? '0' : $load_more['number_of_loads'])
      <section class="blog-articles" data-auto_scroll="{{ $auto_scroll }}">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="blog-articles__container load-more-container">
                @while (have_posts())
                  @php(the_post())
                  @include('partials.content-post')
                @endwhile
              </div>
              @include('partials.archive.pagination')
            </div>
          </div>
        </div>
      </section>
    @else
      @include(
        'partials.archive.no-result',
        [
          'title' => __('No articles available yet', 'sage'),
          'text' => __('Stay tuned for updates and explore our latest insights soon', 'sage'),
        ]
      )
    @endif
  @endsection

  @php($content = ContentManager::the_posts_page_content())
  @if ($content)
    {!! $content !!}
  @else
    @yield('posts_archive')
  @endif
@endsection

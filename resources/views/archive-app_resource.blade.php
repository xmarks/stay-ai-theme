@use('App\Helpers\ContentManager')

@extends('layouts.app')

@section('content')
  @section('resource_archive')
    @if (have_posts())
      @includeWhen(! empty($categories), 'partials.archive.category-filter', $categories)

      @php($auto_scroll = ! $load_more || ! $load_more['enabled'] ? '0' : $load_more['number_of_loads'])
      <section class="offered-articles" data-auto_scroll="{{ $auto_scroll }}">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="offered-articles__container load-more-container">
                @while (have_posts())
                  @php(the_post())
                  @includeFirst(['partials.content-app_resource', 'partials.content'])
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
          'title' => __('No webinars available yet', 'sage'),
          'text' => __('Stay tuned for updates and don’t miss our upcoming video webinars', 'sage'),
        ]
      )
    @endif
  @endsection

  @php($content = ContentManager::custom_post_type_content())
  @if ($content)
    {!! $content !!}
  @else
    @yield('resource_archive')
  @endif
@endsection

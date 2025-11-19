@if (! empty($posts))
  <div class="article-page-sidebar-related">
    <span class="article-page-sidebar-related__title typo-headline-4">{{ __('Explore Further', 'sage') }}</span>
    <div class="article-page-sidebar-related__cards">
      @php
        global $post;
        $tmp_post = $post;
      @endphp

      @foreach ($posts as $post)
        @php(setup_postdata($post))
        @include('partials.content-post')
      @endforeach

      @php($post = $tmp_post)
    </div>
  </div>
@endif

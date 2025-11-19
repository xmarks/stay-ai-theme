@if(! empty($cards_enabled) && $cards_enabled !== 'no')
    <div class="menu-item__posts">
      @switch($cards_enabled)
        @case('cta')
          @include('partials/main-menu/cards/cta', ['cta' => $cta])
          @break
        @case('posts')
          @foreach ($posts ?? [] as $post)
            @if(! empty($post['post']))
              @include('partials/main-menu/cards/post-' . $post['post']->post_type, ['post' => $post])
            @endif
          @endforeach
          @break
      @endswitch
    </div>
  @endif
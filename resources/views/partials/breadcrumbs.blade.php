@if (! empty($links))
  <section class="article-page-breadcrumbs">
    <ul class="article-page-breadcrumbs__links">
      @foreach ($links as $link)
        <li class="article-page-breadcrumbs__item">
          @if ($link['type'] === \App\Services\Breadcrumbs\Enums\LinkType::LINK)
            {!!
              Html::link([
                'href' => $link['link'],
                'text' => $link['title'],
                'class' => '',
              ])
            !!}
          @else
            <span>{!! $link['title'] !!}</span>
          @endif
        </li>
      @endforeach
    </ul>
  </section>
@endif

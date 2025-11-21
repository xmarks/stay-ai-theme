@php
  if (! is_array($items ?? null) || empty($items)) {
    return;
  }
@endphp

<section class="logos-case-studies">

  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="logos-case-studies__grid">
          @foreach ($items as $item)

            @php
              $image = $item['image'] ?? null;
              $link = $item['link'] ?? null;

              // Get image ID (field returns array with 'ID' key)
              $image_id = is_array($image) ? ($image['ID'] ?? null) : $image;

              // Get link data
              $link_url = is_array($link) ? ($link['url'] ?? null) : null;
              $link_target = is_array($link) ? ($link['target'] ?? '_self') : '_self';
              $link_title = is_array($link) ? ($link['title'] ?? '') : '';

              // Skip if no image
              if (!$image_id) continue;
            @endphp

            <div class="logos-case-studies__item">
              {!! Html::get_image(['attachment_id' => $image_id, 'loading' => 'lazy']) !!}

              @if ($link_url)
                <a
                  href="{{ $link_url }}"
                  target="{{ $link_target ?: '_self' }}"
                  class="logos-case-studies__link"
                  @if ($link_target === '_blank') rel="noopener noreferrer" @endif
                >
                  {{ $link_title }}
                </a>
              @endif
            </div>
          @endforeach

        </div>

      </div>
    </div>
  </div>

</section>

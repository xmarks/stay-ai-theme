@php
  if (! is_array($photos)) {
    return;
  }

  $count_photos = count($photos);
  $class = 'photo-grid';

  switch ($count_photos) {
    case 1:
      $class .= ' photo-grid_single';
      break;
    case 2:
      $class .= ' photo-grid_double';
      break;
    case 3:
      $class .= ' photo-grid_triple';
      break;
  }
@endphp

<section class="{{ $class }}">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="photo-grid__wrapper">
          @foreach ($photos as $index => $photo)
            <div
              @class([
                'photo-grid__item photo-grid-card',
                'large' => $index === 0 && $count_photos > 2,
                'small' => $index > 0 && $count_photos > 2,
              ])
            >
              {!! Html::get_image(['attachment_id' => $photo]) !!}
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

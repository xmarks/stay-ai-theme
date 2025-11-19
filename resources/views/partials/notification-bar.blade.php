@php
  $style = ! empty($text_color) ? "color: {$text_color};" : 'color: white;';
  if (! empty($background_image)) {
    $style .= "background-image: url({$background_image});";
  }
  if (! empty($background_color)) {
    $style .= "background-color: {$background_color};";
  }
@endphp

<div class="header__event-banner event-banner" style="{{ $style }}">
  <p>{!! $text !!}</p>
</div>

@php
  $style = '';
  if (! empty($border_radius) && array_sum($border_radius) > 0) {
    $style .= sprintf('--border-radius-desktop: %dpx %dpx %dpx %dpx;', $border_radius['top_left'], $border_radius['top_right'], $border_radius['bottom_right'], $border_radius['bottom_left']);
  }
  if (! empty($border_radius_mobile) && array_sum($border_radius_mobile) > 0) {
    $style .= sprintf('--border-radius-mobile: %dpx %dpx %dpx %dpx;', $border_radius_mobile['top_left'], $border_radius_mobile['top_right'], $border_radius_mobile['bottom_right'], $border_radius_mobile['bottom_left']);
  }
  if (! empty($background_image)) {
    $style .= sprintf('background-image: url(%s);', $background_image);
  }
  if (! empty($background_color)) {
    $style .= sprintf('background-color: %s;', $background_color);
  }

  $id = ! empty($section_id) ? $section_id : null;
@endphp

<section @if($id) id="{{ $id }}" @endif class="section-template" @if($style) style="{{ $style }}" @endif>
  <InnerBlocks />
</section>

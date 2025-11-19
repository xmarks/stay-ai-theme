@php
  $image_class = 'col-lg-4 offset-lg-1';
  $image_class .= $is_reversed ? ' order-lg-2' : ' order-lg-1';
  $image_class .= $mobile_image_position === 'bottom' ? ' order-2' : ' order-1';

  $content_class = 'col-lg-5 offset-lg-1';
  $content_class .= ! $is_reversed ? ' order-lg-2' : ' order-lg-1';
  $content_class .= $mobile_image_position === 'bottom' ? ' order-1' : ' order-2';
@endphp

@include('blocks.two-column-image-content.contents.image', ['class' => $image_class])
@include('blocks.two-column-image-content.contents.content', ['class' => $content_class])

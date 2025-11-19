@php
  $desktop_class = 'custom-img';

  if (! empty($mobile_image)) {
    $desktop_class .= ' custom-img_desktop';
  }
@endphp

{!! Html::get_image(['attachment_id' => $image, 'class' => $desktop_class]) !!}

@if (! empty($mobile_image))
  {!! Html::get_image(['attachment_id' => $mobile_image, 'class' => 'custom-img custom-img_mobile']) !!}
@endif

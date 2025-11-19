@php
  if (! is_array($link)) {
    return;
  }

  $link['class'] = $attributes['class'] . ' btn';

  if ($type === 'link') {
    $link['class'] .= ' btn_underline';
    $style = 'style_link';
  } else {
    $style = 'style_button';
  }

  $link['class'] .= match (${$style}) {
    'primary' => ' btn_primary',
    'secondary' => ' btn_secondary',
    'tertiary' => ' btn_tertiary',
  };
@endphp

{!! Html::link($link) !!}

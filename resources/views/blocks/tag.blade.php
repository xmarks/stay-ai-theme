@php
  switch ($icon_type) {
    case 'custom':
      $icon_url = ! empty($icon_id)
        ? wp_get_attachment_url($icon_id)
        : '';
      break;
    default:
      $icon_url = asset('images/icons/union.svg');
      break;
  }
@endphp

<div
  @class([
    $attributes['class'],
    'tag',
    'tag_white' => $style === 'white',
    'tag_transparent' => $style === 'transparent',
  ])
>
  <div class="tag__icon">
    <div style="mask-image: url('{{ $icon_url }}')"></div>
  </div>
  <span class="tag__text typo-caption-3">{{ $text }}</span>
</div>

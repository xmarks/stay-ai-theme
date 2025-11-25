@php
  if (! is_array($items ?? null) || empty($items)) {
    return;
  }
@endphp

<div class="buttons-wrapper {{ $attributes['class'] ?? '' }}">
  @foreach ($items as $item)
    @php
      if (! is_array($item['link'] ?? null)) {
        continue;
      }

      $link = $item['link'];
      $type = $item['type'] ?? 'button';
      $style_button = $item['style_button'] ?? 'primary';
      $style_link = $item['style_link'] ?? 'primary';

      $link['class'] = 'btn';

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
  @endforeach
</div>
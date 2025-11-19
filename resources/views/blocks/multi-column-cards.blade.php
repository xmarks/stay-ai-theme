@php
  $column_classes = [
    'col-12' => $layout_setting === 'three' || ($layout_setting === 'two' && $content_width === 'full'),
    'col-lg-10 offset-lg-1' => $layout_setting === 'two' && $content_width === 'contained',
  ];

  $cards_classes = ['multi-column-cards', 'multi-column-cards_two-cols' => $layout_setting === 'two'];

  $card = ['acf/multi-column-card'];
  $template = [$card, $card, $card];
@endphp

<div class="container">
  <div class="row">
    <div @class($column_classes)>
      <div @class($cards_classes)>
        <InnerBlocks template="{!! esc_attr(wp_json_encode($template)) !!}" />
      </div>
    </div>
  </div>
</div>

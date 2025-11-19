@php
  $template = [
    [
      'core/heading',
      [
        'placeholder' => __('Title', 'sage'),
      ],
    ],
    [
      'core/paragraph',
      [
        'placeholder' => __('Description', 'sage'),
      ],
    ],
  ];
@endphp

<div @class(['multi-column-card', 'multi-column-card_image' => ! empty($image)])>
  @if (! empty($icon))
    <div class="multi-column-card__icon">
      {!! Html::get_image(['attachment_id' => $icon]) !!}
    </div>
  @endif

  @if (! empty($image))
    <div class="multi-column-card__image">
      {!! Html::get_image(['attachment_id' => $image]) !!}
    </div>
  @endif

  <div class="multi-column-card__content">
    <InnerBlocks template="{!! esc_attr(wp_json_encode($template)) !!}" />
  </div>
</div>

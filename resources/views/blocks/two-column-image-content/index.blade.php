<section
  @class([
    'dynamic-content',
    'dynamic-content_full-width' => $content_width === 'full',
    'dynamic-content_full-width-with-big-image' => $content_width === 'full_with_big_image',
    'dynamic-content_reversed' => $is_reversed,
    'dynamic-content_centered-text-on-mobile' => ! empty($mobile_centered),
  ])
>
  <div class="container">
    <div
      @class([
        'row dynamic-content__row',
        'dynamic-content__row_xl-gap' => $mobile_image_position === 'bottom',
      ])
    >
      @include('blocks.two-column-image-content.templates.' . $content_width)
    </div>
  </div>
</section>

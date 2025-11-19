<section
  @class(['hero-with-img', 'hero-with-img_pin-img-bottom' => ! empty($is_pinned), 'hero-with-img_reversed' => $is_reversed])
>
  <div class="container">
    <div class="row hero-with-img__row">
      <div @class(['col-lg-6', 'order-lg-2' => $is_reversed])>
        <div class="hero-with-img__content">
          <InnerBlocks />
        </div>
      </div>
      <div @class(['col-lg-6', 'order-lg-1' => $is_reversed])>
        @if (! empty($image))
          {!! Html::get_image(['attachment_id' => $image, 'class' => 'hero-with-img__img', 'loading' => 'eager']) !!}
        @endif
      </div>
    </div>
  </div>
</section>

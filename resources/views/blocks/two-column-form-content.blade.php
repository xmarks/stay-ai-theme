<section class="book-a-demo">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="book-a-demo__content">
          <InnerBlocks />
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1" style="display: flex; align-items: center">
        @if (! empty($form_script))
          <div class="book-a-demo__form hubspot-form-wrapper">
            {!! $form_script !!}
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

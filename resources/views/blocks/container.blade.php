@php
  $offset = (int) ceil((12 - $row_layout) / 2);
@endphp

<section class="container-template">
  <div class="container">
    <div class="row">
      <div
        @class([
          'col-12',
          "col-lg-$row_layout offset-lg-$offset" => $row_layout < 12,
        ])
      >
        <InnerBlocks />
      </div>
    </div>
  </div>
</section>

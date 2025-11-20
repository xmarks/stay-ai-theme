@php
  $offset = (int) ceil((12 - $row_layout) / 2);

  // Extract custom classes from $attributes array
  $customClasses = '';
  if (!empty($attributes) && is_array($attributes) && isset($attributes['class'])) {
    $customClasses = $attributes['class'];
  }
@endphp

<section class="container-template {{ $customClasses }}">
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

<div class="chips">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="chips__container">
          <span
            @class(['typo-caption-2 chips-item', 'chips-item_active' => empty($categories['active'])])
            data-term_id="0"
          >
            {{ $label ?? __('All collection', 'sage') }}
          </span>
          @foreach ($categories['list'] as $category)
            <span
              @class([
                'typo-caption-2 chips-item',
                'chips-item_active' => ! empty($categories['active']) && $categories['active'] == $category->term_id,
              ])
              data-term_id="{{ $category->term_id }}"
            >
              {!! $category->name !!}
            </span>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@php
  if (! is_array($items)) {
    return;
  }
@endphp

<div class="accordion">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="accordion__list">
          @foreach ($items as $key => $item)
            <div class="accordion-item">
              <details name="faq" class="accordion-item__details">
                <summary class="accordion-item__summary">
                  <span class="accordion-item__title typo-subtitle-1" role="term" aria-details="accordion-{{ $key }}">
                    {{ $item['title'] }}
                  </span>
                  <div class="accordion-item__arrow"></div>
                </summary>
              </details>
              <div class="accordion-item__content" term="definition" id="accordion-{{ $key }}">
                <div class="accordion-item__content-body">
                  {!! $item['text'] !!}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@if (! empty($faq_schema_markup_enabled))
  @php
    $faq = array_map(function ($item) {
      return [
        'question' => $item['title'],
        'answer' => $item['text'],
      ];
    }, $items);
  @endphp

  <x-schema.faq :faq="$faq" />
@endif

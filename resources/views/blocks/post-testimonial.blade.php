@php
  if (empty($testimonial)) {
    return;
  }
@endphp

<div class="post-testimonial">
  <p class="review-card__text typo-body-2">“{{ $testimonial['text'] }}”</p>
  @if (! empty($testimonial['author']))
    <div class="review-card__reviewer">
      @if (! empty($testimonial['author']['avatar']))
        <div class="review-card__photo">
          {!! Html::get_image(['attachment_id' => $testimonial['author']['avatar']]) !!}
        </div>
      @endif

      <div class="review-card__reviewer-text">
        <span class="review-card__name typo-caption-3">{{ $testimonial['author']['name'] }}</span>
        <span class="review-card__occupation typo-caption-2">{{ $testimonial['author']['position'] }}</span>
      </div>
    </div>
  @endif
</div>

<a
  href="{{ get_permalink($post['post']->ID) }}"
  @class([
    'navigation-card',
    'navigation-card_wide' => $post['card_size'] == 'large',
  ])
>
  <div class="navigation-card__image-wrapper">
    <div class="navigation-card__image-cover">
      <div class="navigation-card__image-cover-icon"></div>
      <span class="navigation-card__image-cover-text">{{ __('Case study', 'sage') }}</span>
    </div>
    <div class="navigation-card__image">
      {!! Html::get_image(['attachment_id' => get_post_thumbnail_id($post['post']->ID)]) !!}
    </div>
  </div>
  <div class="navigation-card__bottom">
    <p class="navigation-card__text">{{ $post['post']->post_title }}</p>
    <div class="navigation-card__icon"></div>
  </div>
</a>

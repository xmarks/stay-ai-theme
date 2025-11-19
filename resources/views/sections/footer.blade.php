@php
  if (! empty($socials)) {
    $social_items = array_map(
      fn ($social): string => sprintf(
        '<li class="footer__social">%s</li>',
        Html::link([
          'href' => $social['link'],
          'target' => '_blank',
          'rel' => 'me',
          'class' => 'footer__social-icon',
          'style' => 'mask-image: url(' . $social['icon'] . ')',
        ]),
      ),
      $socials,
    );

    $socials = sprintf(
      '<ul class="footer__socials-list">%s</ul>',
      implode('', $social_items),
    );
  }
@endphp

<footer class="footer">
  <div class="footer__top">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="footer__form">
            <div class="newsletter-form load-form">
              @if (! empty($subscription_form))
                <h3 class="newsletter-form__title">{{ $subscription_form['caption'] }}</h3>
              @endif

              <div class="newsletter-form__container">
                <div class="hbspt-form"></div>
                <div class="newsletter-form__loader">
                  <div class="loader"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__main">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="footer__content">
            <div class="footer__left">
              @if (! empty($footer_logo))
                {!!
                  Html::link([
                    'href' => $home_url,
                    'class' => 'footer__logo',
                    'text' => Html::get_image(['attachment_id' => $footer_logo]),
                  ])
                !!}
              @endif
            </div>
            <div class="footer__right">
              {!! wp_nav_menu(['theme_location' => 'footer_primary_navigation', 'menu_class' => 'footer__navigation', 'echo' => false]) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="footer__bottom-content">
            <div class="footer__socials footer__socials_mobile">
              <span class="footer__socials-title typo-subtitle-1">{{ __('Get in touch', 'sage') }}</span>
              @if (! empty($socials))
                {!! $socials !!}
              @endif
            </div>
            <span class="footer__copyright typo-caption-3">{{ $copyright }}</span>
            <div class="footer__policy-socials">
              {!! wp_nav_menu(['theme_location' => 'footer_secondary_navigation', 'menu_class' => 'footer__policy-menu', 'echo' => false]) !!}
              <div class="footer__socials">
                @if (! empty($socials))
                  {!! $socials !!}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

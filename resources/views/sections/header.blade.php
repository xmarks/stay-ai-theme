@php
  $cta_button = Html::link(($cta_button ?? []) + ['class' => 'header__button btn btn_primary']);
@endphp

<header class="header">
  @includeWhen(isset($notification_bar), 'partials.notification-bar', $notification_bar)

  <div class="header__content">
    @if (! empty($header_logo))
      {!!
        Html::link([
          'href' => $home_url,
          'class' => 'header__logo',
          'text' => Html::get_image(['attachment_id' => $header_logo]),
        ])
      !!}
    @endif

    <button class="header__burger burger">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <div class="header__navigation navigation-desktop">
      @if (has_nav_menu('header_desktop_navigation'))
        <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('header_desktop_navigation') }}">
          {!!
            wp_nav_menu([
              'theme_location' => 'header_desktop_navigation',
              'container_class' => 'menu-header-desktop-navigation-container',
              'menu_class' => 'navigation',
              'walker' => app('header_menu_walker'),
              'echo' => false,
            ])
          !!}
        </nav>
      @endif
    </div>

    <div class="header__navigation-mobile navigation-mobile">
      <div class="header__navigation-mobile-wrapper">
        @if (has_nav_menu('header_mobile_navigation'))
          <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('header_mobile_navigation') }}">
            {!!
              wp_nav_menu([
                'theme_location' => 'header_mobile_navigation',
                'container_class' => 'menu-header-mobile-navigation-container',
                'menu_class' => 'navigation',
                'walker' => app('header_mobile_menu_walker'),
                'echo' => false,
              ])
            !!}
          </nav>
        @endif

        {!! $cta_button !!}
      </div>
    </div>

    {!! $cta_button !!}
  </div>
</header>

/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/sage/docs sage documentation}
 * @see {@link https://bud.js.org/learn/config bud.js configuration guide}
 *
 * @param {import('@roots/bud').Bud} app
 */
export default async (app) => {
  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/reference/bud.entry}
   * @see {@link https://bud.js.org/reference/bud.assets}
   */
  app
    .entry('accordion', ['@styles/organisms/_accordion'])
    .entry('admin', ['@styles/admin'])
    .entry('app', ['@scripts/app', '@styles/app', '@styles/organisms/_header', '@styles/organisms/_footer'])
    .entry('benefits-grid', ['@styles/organisms/_benefits-grid'])
    .entry('bento-cards', ['@styles/organisms/_bento-cards'])
    .entry('brief-description', ['@styles/organisms/_brief-description'])
    .entry('case-study-articles', [
      '@styles/organisms/_case-study-articles',
      '@styles/organisms/_load-more-articles',
      '@styles/organisms/_chips',
      '@styles/organisms/_empty-resources',
    ])
    .entry('case-study-article-page', [
      '@styles/atoms/_tag',
      '@styles/organisms/article-page/index',
      '@styles/organisms/_metrics',
      '@styles/organisms/_case-study-slider',
    ])
    .entry('case-study-reviews-slider', ['@styles/organisms/_case-study-reviews-slider'])
    .entry('case-study-slider', ['@styles/organisms/_case-study-slider'])
    .entry('container-template', ['@styles/organisms/_container-template'])
    .entry('content-scrolling-steps', ['@styles/organisms/_multi-steps'])
    .entry('custom-list', ['@styles/organisms/_custom-list'])
    .entry('editor', ['@scripts/editor', '@scripts/register-format-type', '@styles/editor'])
    .entry('error-page', ['@styles/organisms/_not-found'])
    .entry('experts-team', ['@styles/organisms/_experts-team'])
    .entry('feature-cards', ['@styles/organisms/_feature-cards'])
    .entry('featured-post', ['@styles/organisms/_featured-post'])
    .entry('featured-posts', ['@styles/organisms/_featured-posts'])
    .entry('hero-with-img', ['@styles/organisms/_hero-with-img'])
    .entry('hubspot-form', ['@styles/organisms/_hubspot-form-wrapper'])
    .entry('logo-carousel', ['@styles/organisms/_logos-carousel'])
    .entry('metrics', ['@styles/organisms/_metrics'])
    .entry('multi-column-cards', ['@styles/organisms/_multi-column-cards'])
    .entry('offered-articles', [
      '@styles/organisms/_offered-articles',
      '@styles/organisms/_load-more-articles',
      '@styles/organisms/_chips',
      '@styles/organisms/_empty-resources',
    ])
    .entry('photo-grid', ['@styles/organisms/_photo-grid'])
    .entry('pricing-cards', ['@styles/organisms/_pricing-cards'])
    .entry('reviews', ['@styles/organisms/_reviews'])
    .entry('reviews-slider', ['@styles/organisms/_reviews-slider'])
    .entry('section-template', ['@styles/organisms/_section-template'])
    .entry('spacer', ['@styles/organisms/_spacer'])
    .entry('table', ['@styles/organisms/_table'])
    .entry('tag', ['@styles/atoms/_tag'])
    .entry('team', ['@styles/organisms/_team'])
    .entry('info-badges', ['@styles/molecules/_info-badges'])
    .entry('tools-cards', ['@styles/organisms/_tools-cards'])
    .entry('two-column-form-content', ['@styles/organisms/_book-a-demo'])
    .entry('two-column-image-content', ['@styles/organisms/_dynamic-content'])
    .entry('video', ['@styles/organisms/_video'])
    .entry('table', ['@styles/organisms/_table'])
    .entry('tools-cards', ['@styles/organisms/_tools-cards'])
    .entry('pricing-cards', ['@styles/organisms/_pricing-cards'])
    .entry('reviews', ['@styles/organisms/_reviews'])
    .entry('team', ['@styles/organisms/_team'])
    .entry('photo-grid', ['@styles/organisms/_photo-grid'])
    .entry('hero-with-img', ['@styles/organisms/_hero-with-img'])
    .entry('webinar-summary', ['@styles/organisms/_webinar-summary'])
    .entry('blog-articles', [
      '@styles/organisms/_blog-articles',
      '@styles/organisms/_load-more-articles',
      '@styles/organisms/_chips',
      '@styles/organisms/_empty-resources',
      '@styles/organisms/_search-container',
    ])
    .entry('blog-article-page', ['@styles/atoms/_tag', '@styles/organisms/article-page/index'])
    .entry('highlighted-section', ['@styles/organisms/_highlighted-section'])
    .entry('cover', ['@styles/molecules/_alternative-cover'])
    .assets(['images']);

  /**
   * Set path aliases
   *
   */
  app.alias('@node_modules', app.path('@modules'));

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/reference/bud.setPublicPath}
   */
  app.setPublicPath('/wp-content/themes/stay-ai-theme/public/');

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/reference/bud.setUrl}
   * @see {@link https://bud.js.org/reference/bud.setProxyUrl}
   * @see {@link https://bud.js.org/reference/bud.watch}
   */
  app.setUrl('http://stay-ai.localhost:3000').setProxyUrl('http://stay-ai.localhost').watch(['resources/views', 'app']);

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .setSettings({
      background: {
        backgroundImage: true,
      },
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
        palette: [
          {
            slug: 'standard_black',
            color: '#020202',
            name: 'Standard Black',
          },
          {
            slug: 'black_opacity_60',
            color: 'rgba(2, 2, 2, 0.6)',
            name: 'Black Opacity 60',
          },
          {
            slug: 'black_opacity_70',
            color: 'rgba(2, 2, 2, 0.7)',
            name: 'Black Opacity 70',
          },
          {
            slug: 'White',
            color: '#FFFFFF',
            name: 'White',
          },
          {
            slug: 'Pink_01',
            color: '#FEF0FA',
            name: 'Pink 01',
          },
          {
            slug: 'Pink_06',
            color: '#CF088B',
            name: 'Pink 06',
          },
        ],
      },
      custom: {
        spacing: {},
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      spacing: {
        padding: false,
        units: ['px', '%', 'em', 'rem', 'vw', 'vh'],
      },
      typography: {
        customFontSize: false,
        letterSpacing: false,
        fontSizes: [
          {
            slug: 'headline_1',
            size: '70px',
            name: 'Headline 1',
          },
          {
            slug: 'headline_2',
            size: '56px',
            name: 'Headline 2',
          },
          {
            slug: 'headline_3',
            size: '42px',
            name: 'Headline 3',
          },
          {
            slug: 'headline_4',
            size: '32px',
            name: 'Headline 4',
          },
          {
            slug: 'headline_5',
            size: '24px',
            name: 'Headline 5',
          },
          {
            slug: 'headline_6',
            // NOTE: using rems to prevent size duplication issue with body_2 (known issue)
            // https://github.com/WordPress/gutenberg/issues/42683
            size: '1.25rem',
            name: 'Headline 6',
          },
          {
            slug: 'body_1',
            size: '22px',
            name: 'Body 1',
          },
          {
            slug: 'body_2',
            size: '20px',
            name: 'Body 2',
          },
          {
            slug: 'caption_2',
            size: '14px',
            name: 'Caption',
          },
        ],
      },
    })
    .enable();

  app.sass.importGlobal(['@src/styles/global']);

  app.copyFile(['styles/ashby.css', 'css/ashby.css']);
};

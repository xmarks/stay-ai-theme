import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  window.globalVariables = {
    adminBarHeight: document.querySelector('#wpadminbar')?.offsetHeight || 0,
    headerHeight: document.querySelector('header')?.offsetHeight || 0,
  };

  const refs = [
    {
      path: './components/case-study-slider.js',
      selectors: ['.case-study-slider'],
    },
    {
      path: './components/reviews-slider.js',
      selectors: ['.reviews-slider'],
    },
    {
      path: './components/header.js',
      selectors: ['.header'],
    },
    {
      path: './components/newsletter-form.js',
      selectors: ['.newsletter-form'],
    },
    {
      path: './components/video.js',
      selectors: ['.video'],
    },
    {
      path: './components/offered-articles.js',
      selectors: ['.offered-articles'],
    },
    {
      path: './components/blog-articles.js',
      selectors: ['.blog-articles'],
    },
    {
      path: './components/case-study-articles.js',
      selectors: ['.case-study-articles'],
    },
    {
      path: './components/case-study-reviews-slider.js',
      selectors: ['.case-study-reviews-slider'],
    },
    {
      path: './components/multi-steps.js',
      selectors: ['.multi-steps'],
    },
    {
      path: './components/reviews.js',
      selectors: ['section.reviews'],
    },
    {
      path: './components/progress-bar.js',
      selectors: ['.progress-bar'],
    },
    {
      path: './components/featured-posts.js',
      selectors: ['section.featured-posts'],
    },
    {
      path: './components/clipboard.js',
      selectors: ['.clipboard'],
    },
    {
      path: './components/case-study-page.js',
      selectors: ['.single-app_case_study'],
    },
  ];

  refs.forEach((ref) => {
    const { path, selectors } = ref;

    if (!path) return;

    const htmlElements = document.querySelectorAll(selectors?.join(','));
    if (htmlElements && htmlElements.length) {
      import(`${path}`).then((module) => {
        const Module = module.default;
        htmlElements.forEach((htmlElement) => new Module(htmlElement));
      });
    }
  });
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);

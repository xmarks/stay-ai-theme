import { debounce } from '@scripts/helpers';

/**
 * @see {@link https://bud.js.org/extensions/bud-preset-wordpress/editor-integration/filters}
 */
roots.register.filters('@scripts/filters');

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);

export const loadComponents = async () => {
  const refs = [
    {
      path: './components/case-study-slider.js',
      selectors: ['.case-study-slider'],
    },
    {
      path: './components/reviews-slider.js',
      selectors: ['.reviews-slider'],
    },
  ];

  refs.forEach((ref) => {
    const { path, selectors } = ref;

    if (!path) return;

    const elements = document.querySelectorAll(selectors?.join(','));
    if (elements && elements.length) {
      import(`${path}`).then((module) => {
        const Module = module.default;
        elements.forEach((el) => new Module(el));
      });
    }
  });
};

const watchBlockChanges = () => {
  let oldBlocks = [];
  let newBlocks = [];

  wp.data.subscribe(
    debounce(() => {
      const editor = wp.data.select('core/block-editor');
      newBlocks = editor.getBlocks();

      if (JSON.stringify(oldBlocks) === JSON.stringify(newBlocks)) {
        return;
      }

      loadComponents();
      console.log('[editor] components loaded');

      oldBlocks = newBlocks;
    }, 1000),
  );
};

watchBlockChanges();

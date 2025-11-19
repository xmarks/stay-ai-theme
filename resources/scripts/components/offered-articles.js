import LoadMoreArticles from './load-more-articles';
import Chips from './chips';

const CATEGORY_KEY = 'category';

export default class OfferedArticles extends LoadMoreArticles {
  constructor(el) {
    super({
      el,
      endpoint: window.api.route.get.resources.posts,
      maxRequest: el.dataset.auto_scroll,
      categoryKey: CATEGORY_KEY,
    });
    this.updateContent.bind(this);
    this.load();
  }

  updateContent() {
    this.reset();
    this.getContent();
  }

  debouncedUpdate() {
    clearTimeout(this.timerId);

    this.timerId = setTimeout(() => {
      this.updateContent();
    }, 500);
  }

  load() {
    const url = new URL(window.location.href);

    new Chips({
      onChange: ({ categoryId }) => {
        if (categoryId === '0') {
          url.searchParams.delete(this.categoryKey);
        } else {
          url.searchParams.set(this.categoryKey, categoryId);
        }

        history.replaceState(null, '', url.toString());

        this.debouncedUpdate();
      },
    });
  }
}

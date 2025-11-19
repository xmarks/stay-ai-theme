import LoadMoreArticles from './load-more-articles';
import Chips from './chips';
import SearchInput from './search-input';

const CATEGORY_KEY = 'category';
const SEARCH_KEY = 's';

export default class BlogArticles extends LoadMoreArticles {
  constructor(el) {
    super({
      el,
      endpoint: window.api.route.get.blog.posts,
      maxRequest: el.dataset.auto_scroll,
      categoryKey: CATEGORY_KEY,
      searchKey: SEARCH_KEY,
    });
    this.updateContent = this.updateContent.bind(this);
    this.handleSearchChange = this.handleSearchChange.bind(this);
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

  handleSearchChange({ e, value }) {
    e.preventDefault();

    if (value) {
      this.url.searchParams.set(this.searchKey, value);
    } else {
      this.url.searchParams.delete(this.searchKey);
    }

    history.replaceState(null, '', this.url.toString());
    this.debouncedUpdate();
  }

  load() {
    const url = new URL(window.location.href);
    this.url = url;

    new Chips({
      onChange: ({ categoryId }) => {
        if (categoryId === '0') {
          this.url.searchParams.delete(this.categoryKey);
        } else {
          this.url.searchParams.set(this.categoryKey, categoryId);
        }

        history.replaceState(null, '', this.url.toString());
        this.debouncedUpdate();
      },
    });

    const searchValue = this.url.searchParams.get(this.searchKey);
    new SearchInput({
      defaultValue: searchValue,
      onChange: this.handleSearchChange,
      onSubmit: this.handleSearchChange,
    });
  }
}

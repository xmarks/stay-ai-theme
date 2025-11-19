export default class LoadMoreArticles {
  constructor({ el, endpoint, maxRequest, categoryKey, searchKey }) {
    this.requestWasSent = false;
    this.el = el.querySelector('.load-more-articles');
    this.noRequestOnInit = this.el?.classList?.contains('no-request-on-init');
    this.contentSection = el.querySelector('.load-more-container');
    this.track = this.el?.querySelector('.load-more-articles__track');
    this.button = this.el?.querySelector('.load-more-articles__button');
    this.buttonInitialized = false;
    this.page = 1;
    this.endpoint = endpoint;
    this.initMaxRequest = maxRequest ? Number(maxRequest) || 0 : 2;
    this.maxAutoRequest = this.initMaxRequest;
    this.getContent = this.getContent.bind(this);
    this.categoryKey = categoryKey;
    this.searchKey = searchKey;
    this.controller = new AbortController();

    this.init();
  }

  reset() {
    this.controller?.abort();
    this.noRequestOnInit = false;
    this.pagination = null;
    this.page = 0;
    this.maxAutoRequest = this.initMaxRequest;
    this.contentSection.innerHTML = '';
    this.buttonInitialized = false;
    this.requestWasSent = false;
    this.el?.classList.remove('load-more-articles_show-button');
    this.button?.removeEventListener('click', this.getContent);
  }

  async getContent(e) {
    e?.preventDefault();
    if (this.pagination && this.pagination.max_num_pages === this.page) return;
    if (this.requestWasSent) return;
    this.el?.classList.add('requesting');

    this.requestWasSent = true;
    this.page += 1;

    const urlWithParams = new URL(`${this.endpoint}`);
    urlWithParams.searchParams.set('page', this.page);
    urlWithParams.searchParams.set('nonce', window.api.nonce);

    const searchParams = new URLSearchParams(window.location.search);
    const category = searchParams.get(this.categoryKey);
    category && urlWithParams.searchParams.append(this.categoryKey, category);

    const search = searchParams.get(this.searchKey);
    search && urlWithParams.searchParams.append(this.searchKey, search);

    let resData = '';

    try {
      this.controller = new AbortController();
      const request = await fetch(urlWithParams.toString(), {
        signal: this.controller.signal,
      });

      const { data, pagination } = await request.json();

      resData = data;

      this.el?.classList.remove('requesting');
      if (!pagination) throw new Error();

      this.pagination = pagination;
      this.page = this.pagination.current_page;
      if (this.pagination.max_num_pages === this.page) {
        this.el?.classList.remove('load-more-articles_show-button');

        this.button?.removeEventListener('click', this.getContent);
      } else {
        if (this.page >= this.maxAutoRequest) {
          this.initLoadButton();
        }
      }
    } catch (e) {
      this.pagination = {
        max_num_pages: this.page,
      };
      this.el?.classList.remove('load-more-articles_show-button');
    } finally {
      if (Array.isArray(resData)) {
        this.contentSection.insertAdjacentHTML(
          'beforeend',
          resData.reduce((acc, cur) => (acc += cur), ''),
        );
      } else {
        if (resData) {
          this.contentSection.insertAdjacentHTML('beforeend', resData);
        }
      }

      this.el?.classList.remove('requesting');
      this.requestWasSent = false;
    }
  }

  initLoadButton() {
    this.el?.classList.add('load-more-articles_show-button');

    if (this.button && !this.buttonInitialized) {
      this.buttonInitialized = true;
      this.button.addEventListener('click', this.getContent);
    }
  }

  init() {
    if (!this.contentSection || !this.track) return;

    if (this.maxAutoRequest === 0) {
      this.initLoadButton();
    }

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            if (!this.noRequestOnInit) {
              if (this.page <= this.maxAutoRequest) {
                this.getContent();
              }
            }
          }
        });
      },
      { threshold: 0 },
    );

    observer.observe(this.track);
  }
}

export default class CaseStudyPage {
  constructor(page) {
    this.page = page;
    this.textContainer = this.page?.querySelector('.simple-text_article-page');
    this.sideBar = this.page?.querySelector('.article-page-text-content__sidebar');
    this.init();
  }

  init() {
    this.setIndentToSidebarCTA();
  }

  setIndentToSidebarCTA() {
    const calcSidebarTopIndent = () => {
      const title = this.textContainer.querySelector('*:first-child');
      let _titleHeight = title?.offsetHeight;

      switch (title?.nodeName) {
        case 'H2': {
          _titleHeight += 80;
          break;
        }
        case 'FIGURE': {
          _titleHeight += 120;
        }
        default: {
          _titleHeight += 24;
          break;
        }
      }

      this.sideBar.style.marginTop = `${_titleHeight}px`;
      this.sideBar.style.height = `calc(100% - ${_titleHeight}px)`;
    };

    calcSidebarTopIndent();

    window.addEventListener('resize', calcSidebarTopIndent);
  }
}

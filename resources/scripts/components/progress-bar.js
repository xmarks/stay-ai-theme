export default class ProgressBar {
  constructor(element) {
    this.bar = element;
    this.progressBar = this.bar?.querySelector('.article-page-progress-bar__line-active');

    this.init();
  }

  init() {
    this.handleScrollPage();

    window.addEventListener('scroll', () => {
      this.handleScrollPage();
      this.changePositionOnScroll();
    });
  }

  handleScrollPage() {
    const scrollTop = window.scrollY;
    const docHeight =
      document.querySelector('header').scrollHeight + document.querySelector('main').scrollHeight - window.innerHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;
    this.progressBar.style.width = `${scrollPercent}%`;
  }

  changePositionOnScroll() {
    const getScrollYPosition = () => window.scrollY || document.documentElement.scrollTop;

    let prevScrollYPosition = getScrollYPosition();
    let currentScrollYPosition = getScrollYPosition();

    window.addEventListener('scroll', () => {
      const scrollPosition = getScrollYPosition();
      currentScrollYPosition = scrollPosition < 0 ? 0 : scrollPosition;

      if (currentScrollYPosition > prevScrollYPosition) {
        this.bar.style = this.isMobile() ? 0 : `top: ${window.globalVariables.adminBarHeight}px`;
      }

      if (currentScrollYPosition < prevScrollYPosition) {
        this.bar.style = this.isMobile()
          ? `top: ${window.globalVariables.headerHeight}px`
          : `top: ${window.globalVariables.adminBarHeight + window.globalVariables.headerHeight}px`;
      }

      prevScrollYPosition = currentScrollYPosition;
    });
  }

  isMobile() {
    return window.innerWidth < 600;
  }
}
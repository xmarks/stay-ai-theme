import { removeBodyScroll, addBodyScroll } from '@scripts/helpers/utils.js';
import { DELAY } from '@scripts/constants/delay.js';

export default class Header {
  constructor(element) {
    this.header = element;

    this.navigationDesktop = this.header?.querySelector('.navigation-desktop .navigation');

    // Desktop
    this.headerNavElements = this.navigationDesktop.querySelectorAll('.navigation > .menu-item-has-children');

    this.secondNestingItemsClass =
      '.navigation > .menu-item > .menu-item__container > .menu-item__items > .sub-menu .menu-item';
    this.secondNestingItems = this.navigationDesktop.querySelectorAll(this.secondNestingItemsClass);

    // Mobile
    this.burgerButton = this.header?.querySelector('.burger');
    this.navigationMobile = this.header?.querySelector('.navigation-mobile');

    this.navigationListNode = this.navigationMobile.querySelector('.navigation');
    this.menuItems = this.navigationMobile.querySelectorAll('.navigation-mobile .navigation > .menu-item-has-children');

    this.subMenuItems = this.navigationMobile.querySelectorAll('.menu-item-has-children.sub-menu-item');

    this.allMenuItems = this.navigationMobile.querySelectorAll('.menu-item');
    this.currentParentItems = this.navigationMobile?.querySelectorAll('.current-menu-ancestor');

    this.init();
  }

  init() {
    this.headerNavElements.forEach((elem) => {
      elem.addEventListener('mouseenter', this.hoverOnNavElement.bind(this));
      elem.addEventListener('mouseleave', this.leaveFromNavElement.bind(this));
    });

    this.calcHeaderHeight();
    this.setTopPositionForMobileNavigation();

    this.hideOnScroll();

    // Desktop
    this.addIndentToComplexItem();

    // Mobile
    this.currentParentItems.length && this.openAccordionWithCurrentItem();
    this.burgerButton.addEventListener('click', this.handleBurger.bind(this));
    this.menuItems.forEach((menuItem) => {
      menuItem.addEventListener('click', this.handleMenuItem.bind(this));
    });
    this.subMenuItems.forEach((subMenuItem) => {
      subMenuItem.addEventListener('click', this.handleSubMenuItem.bind(this));
    });
  }

  calcHeaderHeight() {
    const setHeaderHeight = () => {
      window.globalVariables.adminBarHeight = document.querySelector('#wpadminbar')?.offsetHeight || 0;

      window.globalVariables.headerHeight = this.header.offsetHeight;

      this.isMobile()
        ? this.header.setAttribute('style', `--headerHeight: ${window.globalVariables.headerHeight}px; --top: ${0}px;`)
        : this.header.setAttribute(
            'style',
            `--headerHeight: ${window.globalVariables.headerHeight}px; --top: ${window.globalVariables.adminBarHeight}px;`,
          );

      this.setTopPositionForMobileNavigation();
    };

    setHeaderHeight();

    window.addEventListener('resize', setHeaderHeight);
  }

  isMobile() {
    return window.innerWidth < 600;
  }

  setTopPositionForMobileNavigation() {
    this.navigationMobile.style.top = `${window.globalVariables.headerHeight}px`;
  }

  hideOnScroll() {
    const getScrollYPosition = () => window.scrollY || document.documentElement.scrollTop;

    let prevScrollYPosition = getScrollYPosition();
    let currentScrollYPosition = getScrollYPosition();

    window.addEventListener('scroll', () => {
      this.navigationDesktop.querySelector('.hover')?.classList.remove('hover');

      const scrollPosition = getScrollYPosition();
      currentScrollYPosition = scrollPosition < 0 ? 0 : scrollPosition;

      if (currentScrollYPosition > prevScrollYPosition) {
        this.header.classList.add('header_hide');
      }

      if (currentScrollYPosition < prevScrollYPosition) {
        this.header.classList.remove('header_hide');
      }

      prevScrollYPosition = currentScrollYPosition;
    });
  }

  // Desktop
  addIndentToComplexItem() {
    this.secondNestingItems.forEach((menuItem) => {
      const menuItemText = menuItem.querySelector('.menu-item-link .text p:nth-child(2)')?.innerText;

      if (!menuItemText) return;

      menuItem.classList.add('menu-item-indent-for-complex-item');
    });
  }

  hoverOnNavElement(e) {
    const navElement = e.target;
    navElement.classList.add('hover');
  }

  leaveFromNavElement(e) {
    const navElement = e.target;
    navElement.classList.remove('hover');
  }

  // Mobile
  openAccordionWithCurrentItem() {
    this.currentParentItems.forEach((item) => this.addActiveClass(item));
  }

  handleBurger() {
    this.navigationMobile.classList.contains('active') ? this.closeSideMenu() : this.openSideMenu();
  }

  handleMenuItem(e) {
    if (e.target.classList.contains('sub-menu-item')) return;

    const navItem = e.target;
    const activeNavItem = [...this.menuItems].find((item) => item.classList.contains('active'));

    if (activeNavItem) {
      activeNavItem.classList.remove('active');
      this.closeSubMenuItem(activeNavItem);
      this.removeActiveClass(activeNavItem);
    }

    if (navItem !== activeNavItem) {
      this.addActiveClass(navItem);
    }
  }

  handleSubMenuItem(e) {
    if (!e.target.classList.contains('sub-menu-item') && !e.target.classList.contains('menu-item-has-children')) return;

    const navItem = e.target;
    const activeNavItem = [...this.subMenuItems].find((item) => item.classList.contains('active'));

    if (navItem !== activeNavItem) {
      this.addActiveClass(navItem);
    }

    if (activeNavItem) {
      activeNavItem.classList.remove('active');
    }
  }

  getSubMenuItemWithActiveClass(container) {
    return container.querySelector('.active');
  }

  closeSubMenuItem(container) {
    const subMenuItem = this.getSubMenuItemWithActiveClass(container);
    if (subMenuItem === this.currentParentItems[1]) return;

    subMenuItem && this.removeActiveClass(subMenuItem);

    setTimeout(() => {
      this.addActiveClass(this.currentParentItems[1]);
    }, DELAY.SM);
  }

  openSideMenu() {
    this.addActiveClass(this.navigationMobile);
    this.addActiveClass(this.burgerButton);
    removeBodyScroll();
  }

  closeSideMenu() {
    this.removeActiveClass(this.navigationMobile);
    this.removeActiveClass(this.burgerButton);
    addBodyScroll();

    setTimeout(() => {
      this.allMenuItems.forEach((item) => this.removeActiveClass(item));
      this.openAccordionWithCurrentItem();
    }, DELAY.SM);
  }

  addActiveClass(element) {
    element.classList.add('active');
  }

  removeActiveClass(element) {
    element.classList.remove('active');
  }
}

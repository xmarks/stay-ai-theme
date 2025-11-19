import Swiper from 'swiper';

export default class FeaturedPosts {
  constructor(HTML_Element) {
    this.parent = HTML_Element;
    this.swiperNode = this.parent.querySelector('.swiper');
    this.init();
  }

  init() {
    new Swiper(this.swiperNode, {
      slidesPerView: 1.07,
      spaceBetween: 16,
      breakpoints: {
        420: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 32,
        },
      },
    });
  }
}

import Swiper from 'swiper';
import { Pagination } from 'swiper/modules';

export default class ReviewsSlider {
  constructor(HTML_Element) {
    this.reviewSliderNode = HTML_Element;
    this.swiperNode = this.reviewSliderNode?.querySelector(
      '.reviews-slider__swiper',
    );
    this.swiperPaginationNode =
      this.reviewSliderNode?.querySelector('.swiper-pagination');
    this.swiper = null;
    this.init();
  }

  init() {
    this.swiper = this.initSwiper();
  }

  initSwiper() {
    return new Swiper(this.swiperNode, {
      modules: [Pagination],

      spaceBetween: 24,
      pagination: {
        el: this.swiperPaginationNode,
        dynamicBullets: true,
        dynamicMainBullets: 4,
        clickable: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1.04,
          spaceBetween: 12,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
      },
    });
  }
}

import Swiper from "swiper";
import { Navigation, Pagination } from 'swiper/modules';

export default class CaseStudyReviewsSlider {
  constructor(element) {
    this.section = element;
    this.swiperContainer = this.section?.querySelector('.swiper');
    this.prevButton = this.section?.querySelector('.swiper-navigation-button_prev');
    this.nextButton = this.section?.querySelector('.swiper-navigation-button_next');
    this.pagination = this.section?.querySelector('.case-study-reviews-slider__pagination');
    this.slides = this.swiperContainer?.querySelectorAll('.swiper-slide');
    this.init();
  }

  init() {   
    this.initSwiper();
    this.showPagination();
    this.showNavigation();
  }

  showPagination() {
    if (this.slides.length > 1) {
      this.section.classList.add('show-pagination');
    }
  }

  showNavigation() {
    if (this.slides.length > 1) {
      this.section.classList.add('show-navigation');
    }
  }

  initSwiper() {
    new Swiper(this.swiperContainer, {
      modules: [Navigation, Pagination],
      spaceBetween: 24,
      slidesPerView: 1.07,
      navigation: {
        prevEl: this.prevButton,
        nextEl: this.nextButton,
      },
      pagination: {
        el: this.pagination,
        dynamicBullets: true,
        dynamicMainBullets: 4,
        clickable: false,
      },
      breakpoints: {
        992: {
          slidesPerView: 1,
        },
      },
    })
  }
}
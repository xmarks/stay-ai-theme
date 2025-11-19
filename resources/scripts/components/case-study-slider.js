import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

export default class CaseStudySlider {
  constructor(nodeElement) {
    this.componentNode = nodeElement;
    this.swiperNode = this.componentNode?.querySelector('.case-study-slider__swiper');
    this.buttonPrevNode = this.componentNode?.querySelector('.swiper-navigation-button_prev');
    this.buttonNextNode = this.componentNode?.querySelector('.swiper-navigation-button_next');

    this.slides = this.swiperNode?.querySelectorAll('.swiper-slide');
    this.init();
  }

  init() {
    this.initSwiper();
    this.showNavigation();
  }

  showNavigation() {
    if (this.slides.length > 3) {
      this.componentNode.classList.add('show-navigation');
    } else {
      const turnOnNavigation = () => {
        window.innerWidth <= 991
          ? this.componentNode.classList.add('show-navigation')
          : this.componentNode.classList.remove('show-navigation');
      };

      turnOnNavigation();
      window.addEventListener('resize', turnOnNavigation);
    }
  }

  initSwiper() {
    new Swiper(this.swiperNode, {
      modules: [Navigation],
      slidesPerView: 1.07,
      spaceBetween: 16,
      navigation: {
        prevEl: this.buttonPrevNode,
        nextEl: this.buttonNextNode,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 24,
        },
      },
    });
  }
}

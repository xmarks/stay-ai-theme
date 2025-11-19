import { debounce } from '@scripts/helpers/index.js';

export default class MultiSteps {
  constructor(block) {
    this.block = block;
    this.cardActiveClass = 'multi-steps-card_active';
    this.cardsWrapper = null;
    this.cards = null;

    this.init();
  }

  init() {
    this.cardsWrapper = this.block.querySelector('.multi-steps__cards');
    this.cards = this.block.querySelectorAll('.multi-steps-card');

    if (!this.cards || !this.cards.length) return;

    this.setCSSVariable();

    window.addEventListener(
      'resize',
      debounce(() => this.setCSSVariable(), 500),
    );

    const options = {
      root: null,
      rootMargin: '-50% 0% -50% 0%', // horizontal line vertically centered
      threshold: 0,
    };

    const observer = new IntersectionObserver((entries, observer) => this.handleIntersect(entries, observer), options);

    this.cards.forEach((card) => {
      observer.observe(card);
    });
  }

  handleIntersect(entries, observer) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        this.cards.forEach((card) => card.classList.remove(this.cardActiveClass));
        entry.target.classList.add(this.cardActiveClass);
      }
    });
  }

  setCSSVariable() {
    const totalCards = this.cards.length;
    const lastCard = this.cards[totalCards - 1];
    const lastCardHeight = lastCard.clientHeight;

    this.cardsWrapper.style.setProperty('--last-card-height', lastCardHeight + 'px');
  }
}

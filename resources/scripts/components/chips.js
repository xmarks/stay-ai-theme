export default class Chips {
  constructor(params) {
    this.activeItem = null;
    this.params = params;
    this.init();
  }

  clickHandler(i) {
    const categoryId = i.dataset.term_id;

    i.addEventListener('click', () => {
      this.activeItem.classList.remove('chips-item_active');
      i.classList.add('chips-item_active');
      this.activeItem = i;

      this.params?.onChange({ categoryId });
    });
  }

  init() {
    const chipsContainer = document.querySelector('.chips');
    const items = chipsContainer?.querySelectorAll('.chips-item');
    this.activeItem = chipsContainer?.querySelector('.chips-item_active');

    items?.forEach(this.clickHandler.bind(this));
  }
}

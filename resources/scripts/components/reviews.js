export default class Reviews {
  constructor(block) {
    this.block = block;
    this.loadMoreBtn = this.block.querySelector('.reviews__load-more');

    if (!this.loadMoreBtn) return;

    this.loadMoreBtn.addEventListener('click', (e) => this.handleLoadMore(e));
  }

  handleLoadMore(event) {
    event.preventDefault();
    const perPage = Number(this.loadMoreBtn.dataset.perPage) || 0;

    this.showMore(perPage);
  }

  getHiddenReviews() {
    return [...this.block.querySelectorAll('.review-item.hidden')];
  }

  showMore(perPage) {
    const hiddenReviews = this.getHiddenReviews().slice(0, perPage);

    hiddenReviews.forEach((review) => review.classList.remove('hidden'));

    if (this.getHiddenReviews().length === 0) this.loadMoreBtn.remove();
  }
}

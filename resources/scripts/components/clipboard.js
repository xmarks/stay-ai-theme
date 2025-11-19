export default class Clipboard {
  constructor(element) {
    this.clipboard = element;
    this.clipBoardBtn = this.clipboard?.querySelector('.clipboard__button');
    this.clipboardMessage = this.clipboard?.querySelector('.clipboard__message');
    this.init();
  }

  init() {
    this.clipBoardBtn.addEventListener('click', this.handleClipboardBtn.bind(this));
  }

  handleClipboardBtn() {
    navigator.clipboard.writeText(window.location.href).then(() => {
      this.clipboard.classList.add('clipboard_active');
      setTimeout(() => {
        this.clipboard.classList.remove('clipboard_active');
      }, 3000);
    });
  }
}

export default class SearchInput {
  constructor(params) {
    this.params = params;
    this.init();
  }

  init() {
    const container = document.querySelector('.search-input');
    const button = container.querySelector('.search-input__submit-button');
    const input = container.querySelector('.search-input__input');
    const clearButton = container.querySelector('.search-input__clear-button');

    const checkClearButtonVisibility = () => {
      if (input.value) {
        container.classList.add('search-input_has-value');
      } else {
        container.classList.remove('search-input_has-value');
      }
    };

    if (this.params.defaultValue) {
      input.value = this.params.defaultValue;
      checkClearButtonVisibility();
    }

    input.addEventListener('focus', () => {
      container.classList.add('search-input_focused');
    });

    input.addEventListener('blur', () => {
      container.classList.remove('search-input_focused');
    });

    input.addEventListener('keyup', (e) => {
      this.params?.onChange({ e, value: input.value });
      checkClearButtonVisibility();
    });

    button.addEventListener('click', (e) => {
      this.params?.onSubmit({ e, value: input.value });
    });

    clearButton.addEventListener('click', (e) => {
      input.value = '';
      this.params?.onSubmit({ e, value: '' });
      checkClearButtonVisibility();
    });
  }
}

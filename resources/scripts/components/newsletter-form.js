export default class NewsletterForm {
  constructor(componentNode) {
    this.componentNode = componentNode;
    this.formContainerSelector = '.newsletter-form__container .hbspt-form';
    this.formContainer = this.componentNode.querySelector(this.formContainerSelector);

    this.portalId = null;
    this.formId = null;

    this.init();
  }

  init() {
    const { portalId, formId } = window.app_hbspt?.newsletter_form || {};

    if (!this.formContainer || !portalId || !formId) {
      return;
    }

    this.portalId = portalId;
    this.formId = formId;

    if (window.hbspt) {
      this.createForm();
    } else {
      this.loadHubspotScript()
        .then(() => this.createForm())
        .catch(() => this.hideForm());
    }
  }

  createForm() {
    window.hbspt.forms.create({
      portalId: this.portalId,
      formId: this.formId,
      target: this.formContainerSelector,
      onFormReady: () => {
        this.replaceDefaultSubmitBtn();
        this.removeLoader();
      },
    });
  }

  replaceDefaultSubmitBtn() {
    const inputElements = this.formContainer.querySelectorAll('input[type="submit"]');

    for (let i = 0; i < inputElements.length; i++) {
      const buttonElement = document.createElement('button');

      buttonElement.className = inputElements[i].className;
      buttonElement.classList.add('btn', 'btn_secondary');
      buttonElement.type = inputElements[i].type;
      buttonElement.onclick = inputElements[i].onclick;

      const spanElement = document.createElement('span');
      spanElement.textContent = inputElements[i].value;

      buttonElement.appendChild(spanElement);

      inputElements[i].parentNode.replaceChild(buttonElement, inputElements[i]);
    }
  }

  loadHubspotScript() {
    return new Promise((resolve, reject) => {
      if (!window.app_hbspt || !window.app_hbspt.src) {
        return reject(new Error('HubSpot script source is not defined'));
      }

      const script = document.createElement('script');
      script.src = window.app_hbspt.src;
      script.async = true;
      script.onload = () => resolve();
      script.onerror = () => reject(new Error('Failed to load HubSpot script'));

      try {
        document.body.appendChild(script);
      } catch (error) {
        reject(new Error('Failed to append script to the document: ' + error.message));
      }
    });
  }

  removeLoader() {
    this.componentNode.classList.remove('load-form');
  }

  hideForm() {
    this.componentNode.parentNode.classList.add('hide-form');
  }
}

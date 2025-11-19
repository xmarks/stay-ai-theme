<section class="search-container">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="search-container__content">
          <form class="search-input">
            <div class="search-input__container">
              <button type="submit" class="search-input__submit-button"><x-icon name="search" /></button>
              <input
                type="text"
                class="search-input__input typo-body-3"
                placeholder="{{ __('Search blog posts', 'sage') }}"
              />
              <button class="search-input__clear-button"><x-icon name="close-small" /></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

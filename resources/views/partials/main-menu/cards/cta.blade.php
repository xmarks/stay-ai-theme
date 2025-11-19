<div class="cta-card">
  <div class="cta-card__content">
    <div class="cta-card__icon">
      @if (! empty($cta['icon']))
        <div class="cta-card__icon-image" style="mask-image: url('{{ wp_get_attachment_url($cta['icon']) }}')"></div>
      @endif
    </div>
    <div class="cta-card__title">
      @if (! empty($cta['title']))
        <p>{{ $cta['title'] }}</p>
      @endif
    </div>
    @if (! empty($cta['button']))
      {!! Html::link(array_merge($cta['button'], ['class' => 'cta-card__button btn btn_secondary'])) !!}
    @endif
  </div>
</div>

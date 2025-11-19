<section class="bento-cards">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12 offset-md-2 offset-lg-0">
        <div class="bento-cards__wrapper">
          @foreach ($cards as $card)
            @include('blocks.bento-cards.cards.' . $card['type'], ['card' => $card])
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

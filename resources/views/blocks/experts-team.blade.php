<section class="experts-team">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if (! empty($team_members))
          <div class="experts-team__cards-wrapper">
            @foreach ($team_members as $team_member)
              @if (! empty($team_member['link']) )
                <a href="{{ $team_member['link'] }}" target="_blank" rel="noopener noreferrer" class="experts-team-card experts-team-card_link">
              @else 
                <div class="experts-team-card">
              @endif
              @if (! empty($team_member['photo']))
                <div class="experts-team-card__image">
                  {!! Html::get_image(['attachment_id' => $team_member['photo']]) !!}
                </div>
              @endif

              <div class="experts-team-card__content">
                @if (! empty($team_member['logo']))
                  {!! Html::get_image(['attachment_id' => $team_member['logo'], 'class' => 'experts-team-card__logo']) !!}
                @endif
                <div class="experts-team-card__text-content">
                  @if (! empty($team_member['title']))
                    <h5 class="typo-subtitle-1 experts-team-card__name">{{ $team_member['title'] }}</h5>
                  @endif

                  @if (! empty($team_member['designation']))
                    <p class="typo-body-2 experts-team-card__position">{{ $team_member['designation'] }}</p>
                  @endif
                </div>
              </div>
              @if (! empty($team_member['link']) )
                </a>
              @else 
                </div>
              @endif
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

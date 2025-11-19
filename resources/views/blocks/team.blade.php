<section class="team">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if (! empty($team_members))
          <div class="team__cards-wrapper">
            @foreach ($team_members as $team_member)
              @if (! empty($team_member['linkedin']) )
                <a href="{{ $team_member['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="team-card">
              @else 
                <div class="team-card">
              @endif
              @if (! empty($team_member['attachment_id']))
                <div class="team-card__image">
                  {!! Html::get_image(['attachment_id' => $team_member['attachment_id']]) !!}
                </div>
              @endif

              <div class="team-card__content">
                <div class="team-card__text-content">
                  @if (! empty($team_member['title']))
                    <h5 class="typo-subtitle-1 team-card__name">{{ $team_member['title'] }}</h5>
                  @endif

                  @if (! empty($team_member['designation']))
                    <p class="typo-body-2 team-card__position">{{ $team_member['designation'] }}</p>
                  @endif
                </div>
                @if (! empty($team_member['linkedin']))
                  <div class="team-card__social-media-icon">
                    <x-icon name="linkedin" />
                  </div>
                @endif
              </div>
              @if (! empty($team_member['linkedin']) )
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

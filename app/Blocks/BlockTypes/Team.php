<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class Team extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_team_data();
    }

    /**
     * @return void
     */
    private function prepare_team_data(): void
    {
        if ( empty( $this->data['team_members'] ) ) {
            return;
        }

        $this->data['team_members'] = array_map(
            function ( $team ) {
                $fields = ACF::get_fields( $team );
                $fields += ['title' => $team->post_title, 'attachment_id' => get_post_thumbnail_id( $team )];
                return $fields;
            },
            $this->data['team_members']
        );
    }
}

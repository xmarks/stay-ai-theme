<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class BriefDescription extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_data();
    }

    /**
     * @return void
     */
    private function prepare_data(): void
    {
        if ( empty( $this->data['rc_speakers'] ) ) {
            return;
        }

        $this->data['rc_speakers'] = array_map(
            function ( $speaker ) {
                $fields = ACF::get_fields( $speaker );
                $fields += ['title' => $speaker->post_title, 'attachment_id' => get_post_thumbnail_id( $speaker )];
                return $fields;
            },
            $this->data['rc_speakers']
        );
    }
}

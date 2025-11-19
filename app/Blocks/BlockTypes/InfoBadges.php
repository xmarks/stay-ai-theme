<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class InfoBadges extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        global $post;
        $post_fields = ACF::get_fields( $post->ID ) ?: [];
        $this->data = [
            'date' => $post_fields['date'] ?? null,
            'time' => $post_fields['time'] ?? null,
        ];
    }
}

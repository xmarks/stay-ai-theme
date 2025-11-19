<?php

namespace App\Blocks\BlockTypes;

use App\DTO\FeaturedPostDTO;

class FeaturedPost extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_post_data();
    }

    /**
     * @return void
     */
    private function prepare_post_data(): void
    {
        if ( empty( $this->data['post'] ) ) {
            return;
        }

        $this->data['post'] = ( new FeaturedPostDTO( $this->data['post'] ) )->toArray();
    }
}

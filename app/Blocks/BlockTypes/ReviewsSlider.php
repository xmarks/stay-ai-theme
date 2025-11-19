<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class ReviewsSlider extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_reviews_data();
    }

    /**
     * @return void
     */
    private function prepare_reviews_data(): void
    {
        if ( empty( $this->data['reviews'] ) ) {
            return;
        }

        $this->data['reviews'] = array_map(
            function ( $review ) {
                $attachment_id = get_post_thumbnail_id( $review );
                $fields = ACF::get_fields( $review );

                return [
                    'attachment_id' => $attachment_id,
                    'text' => $fields['text'],
                    'author' => $fields['author'],
                ];
            },
            $this->data['reviews']
        );
    }
}

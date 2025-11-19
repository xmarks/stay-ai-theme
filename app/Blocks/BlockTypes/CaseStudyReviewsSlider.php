<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class CaseStudyReviewsSlider extends BaseBlock
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
                    'title' => $review->post_title,
                    'attachment_id' => $attachment_id,
                    'description' => $fields['description'],
                    'brand_logo' => $fields['brand_logo'],
                    'link' => $fields['link'],
                    'member' => $fields['member'],
                ];
            },
            $this->data['reviews']
        );
    }
}

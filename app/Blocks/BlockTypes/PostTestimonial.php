<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class PostTestimonial extends BaseBlock
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
        $this->data['testimonial'] = null;

        if ( empty( $this->data['testimonials'] ) ) {
            return;
        }

        $testimonial = $this->data['testimonials'][0];
        $fields = ACF::get_fields( $testimonial );

        $this->data['testimonial'] = [
            'text' => $fields['text'],
            'author' => $fields['author'],
        ];
    }
}

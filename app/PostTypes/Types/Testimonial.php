<?php

namespace App\PostTypes\Types;

use App\PostTypes\Contracts\PostType;

class Testimonial extends PostType
{
    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_testimonial';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Testimonial';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Testimonials';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        return [
            'show_ui' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'thumbnail'],
            'menu_position' => 20,
            'menu_icon' => 'dashicons-testimonial',
            'rewrite' => false
        ];
    }
}

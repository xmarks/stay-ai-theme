<?php

namespace App\PostTypes\Types;

use App\PostTypes\Contracts\PostType;

class CaseStudyReview extends PostType
{
    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_cs_review';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Review';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Reviews';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        return [
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_menu' => 'edit.php?post_type=' . CaseStudy::get_post_type_key(),
            'supports' => ['title', 'thumbnail'],
            'menu_icon' => 'dashicons-testimonial',
            'rewrite' => false
        ];
    }
}
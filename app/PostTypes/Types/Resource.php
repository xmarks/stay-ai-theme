<?php

namespace App\PostTypes\Types;

use App\PostTypes\Contracts\PostType;

class Resource extends PostType
{

    /**
     * @var int
     */
    protected static $posts_per_page = 9;

    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_resource';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Resource';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Resources';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        return [
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt'],
            'menu_position' => 20,
            'menu_icon' => 'dashicons-admin-post',
            'rewrite' => false,
        ];
    }
}
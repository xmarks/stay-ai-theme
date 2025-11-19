<?php

namespace App\PostTypes\Types;

use App\PostTypes\Contracts\PostType;

class Author extends PostType
{
    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_author';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Author';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Authors';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        return [
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_menu' => 'edit.php',
            'supports' => ['title'],
            'menu_position' => 20,
            'menu_icon' => 'dashicons-groups',
            'rewrite' => false,
        ];
    }
}

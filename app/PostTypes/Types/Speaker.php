<?php

namespace App\PostTypes\Types;

use App\PostTypes\Contracts\PostType;

class Speaker extends PostType
{
    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_speaker';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Speaker';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Speakers';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        return [
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_menu' => 'edit.php?post_type=' . Resource::get_post_type_key(),
            'supports' => ['title', 'thumbnail'],
            'menu_icon' => 'dashicons-buddicons-buddypress-logo',
            'rewrite' => false
        ];
    }
}
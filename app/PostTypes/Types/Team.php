<?php

namespace App\PostTypes\Types;

use App\PostTypes\Contracts\PostType;

class Team extends PostType
{
    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_team';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Team';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Team';
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
            'menu_icon' => 'dashicons-buddicons-buddypress-logo',
            'rewrite' => false
        ];
    }
}
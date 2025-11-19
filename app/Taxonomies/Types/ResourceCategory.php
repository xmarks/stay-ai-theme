<?php

namespace App\Taxonomies\Types;

use App\PostTypes\Types\Resource;
use App\Taxonomies\Contracts\Taxonomy;

class ResourceCategory extends Taxonomy
{
    /**
     * @inheritDoc
     */
    public static function get_taxonomy_key(): string
    {
        return 'app_resource_category';
    }

    /**
     * @inheritDoc
     */
    public static function get_associated_object_types(): array|string
    {
        return Resource::get_post_type_key();
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Category';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Categories';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        return [
            'public' => false,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'meta_box_cb' => false
        ];
    }
}
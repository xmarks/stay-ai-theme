<?php

namespace App\Taxonomies\Types;

use App\PostTypes\Types\CaseStudy;
use App\Taxonomies\Contracts\Taxonomy;

class CaseStudyTag extends Taxonomy
{
    /**
     * @inheritDoc
     */
    public static function get_taxonomy_key(): string
    {
        return 'app_case_study_tag';
    }

    /**
     * @inheritDoc
     */
    public static function get_associated_object_types(): array|string
    {
        return CaseStudy::get_post_type_key();
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Tag';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Tags';
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
            'hierarchical' => true
        ];
    }
}

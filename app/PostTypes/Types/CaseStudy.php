<?php

namespace App\PostTypes\Types;

use App\Helpers\CaseStudy as CaseStudyHelper;
use App\PostTypes\Contracts\PostType;

class CaseStudy extends PostType
{
    /**
     * @var int
     */
    protected static $posts_per_page = 9;
    
    /**
     * @var string
     */
    protected static string $slug = 'casestudy';

    /**
     * @inheritDoc
     */
    public static function get_post_type_key(): string
    {
        return 'app_case_study';
    }

    /**
     * @inheritDoc
     */
    protected function get_singular_name(): string
    {
        return 'Case Study';
    }

    /**
     * @inheritDoc
     */
    protected function get_plural_name(): string
    {
        return 'Case Studies';
    }

    /**
     * @inheritDoc
     */
    protected function get_custom_args(): array
    {
        $archive_page = CaseStudyHelper::get_main_page();

        return [
            'public' => true,
            'has_archive' => $archive_page
                ? $archive_page->post_name
                : 'case-studies',
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt'],
            'menu_position' => 20,
            'menu_icon' => 'dashicons-businessman',
            'rewrite' => ['slug' => static::$slug, 'with_front' => false],
        ];
    }
}

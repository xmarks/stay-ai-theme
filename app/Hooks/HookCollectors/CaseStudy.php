<?php

namespace App\Hooks\HookCollectors;

use App\Hooks\Contracts\HookCollector;
use App\PostTypes\Types\CaseStudy as CaseStudyType;
use App\Taxonomies\Types\CaseStudyTag;

class CaseStudy implements HookCollector
{
    /**
     * @inheritDoc
     */
    public function collect(): void
    {
        add_action( 'acf/init', [$this, 'add_options_page'] );
        add_action( 'pre_get_posts', [$this, 'set_pre_get_posts_value'] );
    }

    /**
     * @return void
     */
    public function add_options_page(): void
    {
        if ( ! function_exists( 'acf_add_options_page' ) ) {
            return;
        }

        acf_add_options_page( [
            'page_title' => 'Case Study Settings',
            'menu_title' => 'Settings',
            'menu_slug' => 'case-study-settings',
            'capability' => 'edit_posts',
            'parent_slug' => 'edit.php?post_type=' . CaseStudyType::get_post_type_key(),
            'redirect' => false
        ] );
    }

    /**
     * Modify the main query to set the correct posts_per_page value on the Case Study archive page
     *
     * @param \WP_Query $query
     * @return void
     */
    public static function set_pre_get_posts_value( \WP_Query $query ): void
    {
        if ( ! is_admin()
            && $query->is_post_type_archive( CaseStudyType::get_post_type_key() )
            && $query->is_main_query()
        ) {
            $query->set( 'posts_per_page', CaseStudyType::get_posts_per_page() );

            if ( isset( $_GET['category'] ) ) {
                $tax_query = [
                    [
                        'taxonomy' => CaseStudyTag::get_taxonomy_key(),
                        'field' => 'term_id',
                        'terms' => $_GET['category'],
                    ]
                ];
                $query->set( 'tax_query', $tax_query );
            }

        }
    }
}

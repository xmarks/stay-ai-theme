<?php

namespace App\Helpers;

use App\PostTypes\Types\CaseStudy as CaseStudyType;
use App\Taxonomies\Types\{CaseStudyCategory, CaseStudyTag};

class CaseStudy
{
    /**
     * @param int|\WP_Post $post
     * @return array|null
     */
    public static function get_categories( int|\WP_Post $post ): ?array
    {
        return App::get_the_terms( $post, CaseStudyCategory::get_taxonomy_key() );
    }

    /**
     * @param int|\WP_Post $post
     * @return array|null
     */
    public static function get_tags( int|\WP_Post $post ): ?array
    {
        return App::get_the_terms( $post, CaseStudyTag::get_taxonomy_key() );
    }

    /**
     * @return \WP_Post|null
     */
    public static function get_main_page(): \WP_Post|null
    {
        $settings = ACF::get_field( CaseStudyType::get_post_type_key() . '_settings', 'option' );
        return $settings['archive_page'] ?? null;
    }
}

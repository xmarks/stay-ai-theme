<?php

namespace App\Services;

use App\PostTypes\Types\CaseStudy;
use App\Taxonomies\Types\CaseStudyTag;

class CaseStudyService
{
    /**
     * @param array $args
     * @return array|null
     * @throws \Throwable
     */
    public function get_posts( array $args ): ?array
    {
        $wp_query = $this->build_query( $args );
        if ( empty( $wp_query->posts ) ) {
            return null;
        }

        global $post;
        $result = [];

        foreach ( $wp_query->posts as $post ) {
            setup_postdata( $post );
            $result['data'][] = view( 'partials.content-' . CaseStudy::get_post_type_key() )->render();
        }
        wp_reset_postdata();

        $result['pagination'] = [
            'current_page' => $wp_query->query_vars['paged'],
            'max_num_pages' => (int) $wp_query->max_num_pages
        ];

        return $result;
    }

    /**
     * @param array $args
     * @return \WP_Query
     */
    private function build_query( array $args ): \WP_Query
    {
        $args = array_merge( [
            'post_type' => CaseStudy::get_post_type_key(),
            'post_status' => 'publish',
            'posts_per_page' => CaseStudy::get_posts_per_page(),
            'orderby' => 'date title',
        ], $args );

        if ( ! empty( $args['category'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => CaseStudyTag::get_taxonomy_key(),
                    'field' => 'term_id',
                    'terms' => $args['category'],
                ]
            ];
            unset( $args['category'] );
        }

        return new \WP_Query( $args );
    }
}
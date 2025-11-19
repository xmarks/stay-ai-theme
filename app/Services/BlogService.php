<?php

namespace App\Services;

class BlogService
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
            $result['data'][] = view( 'partials.content-post' )->render();
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
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => get_option( 'posts_per_page' ),
            'orderby' => 'date title',
        ], $args );

        if ( ! empty( $args['category'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $args['category'],
                ]
            ];
            unset( $args['category'] );
        }

        return new \WP_Query( $args );
    }
}
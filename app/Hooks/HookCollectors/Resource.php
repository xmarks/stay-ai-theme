<?php

namespace App\Hooks\HookCollectors;

use App\Helpers\{ACF, App};
use App\Hooks\Contracts\HookCollector;
use App\PostTypes\Types\Resource as ResourceType;
use App\Taxonomies\Types\ResourceCategory;

class Resource implements HookCollector
{
    /**
     * @inheritDoc
     */
    public function collect(): void
    {
        add_action( 'acf/init', [$this, 'add_options_page'] );
        add_action( 'init', [$this, 'rewrite_rules'] );
        add_action( 'pre_get_posts', [$this, 'set_pre_get_posts_value'] );
        add_filter( 'post_type_link', [$this, 'post_type_permalink'], 10, 2 );
        add_filter( 'rest_prepare_taxonomy', [$this, 'hide_custom_taxonomy_metabox'], 10, 3 );
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
            'page_title' => 'Resource Settings',
            'menu_title' => 'Settings',
            'menu_slug' => 'resource-settings',
            'capability' => 'edit_posts',
            'parent_slug' => 'edit.php?post_type=' . ResourceType::get_post_type_key(),
            'redirect' => false
        ] );
    }

    /**
     * Hides the custom taxonomy metabox in the editor, if the `meta_box_cb` is set to false
     *
     * @param \WP_REST_Response $response
     * @param \WP_Taxonomy $taxonomy
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response $response
     */
    public function hide_custom_taxonomy_metabox(
        \WP_REST_Response $response,
        \WP_Taxonomy $taxonomy,
        \WP_REST_Request $request
    ): \WP_REST_Response
    {
        $context = ! empty( $request['context'] ) ? $request['context'] : 'view';
        // Context is edit in the editor
        if( $context === 'edit' && $taxonomy->meta_box_cb === false ) {
            $data_response = $response->get_data();
            $data_response['visibility']['show_ui'] = false;
            $response->set_data( $data_response );
        }
        return $response;
    }

    /**
     * @param string $post_link
     * @param \WP_Post $post
     *
     * @return string
     */
    public function post_type_permalink( string $post_link, \WP_Post $post ): string
    {
        if ( $post->post_type !== ResourceType::get_post_type_key() ) {
            return $post_link;
        }
    
        $terms = App::get_the_terms( $post->ID, ResourceCategory::get_taxonomy_key() );
        if ( $terms ) {
            $category_slug = $terms[0]->slug;
            return home_url( "/$category_slug/" . $post->post_name );
        }
    
        return home_url( "/resource/" . $post->post_name );
    }

    /**
     * @return void
     */
    public function rewrite_rules():void
    {
        $post_type = ResourceType::get_post_type_key();
        $query = 'index.php?' . $post_type . '=$matches[1]';
        $categories = App::get_terms( [
            'taxonomy'   => ResourceCategory::get_taxonomy_key(),
            'hide_empty' => false,
            'fields'     => 'slugs',
        ] );

        // Create the rewrite rules
        $rules['resource/([^/]+)/?$'] = $query;
        foreach ( $categories as $slug ) {
            $rules["{$slug}/([^/]+)/?$"] = $query;
        }

        // Add rules for archive page
        $resource_settings = ACF::get_field( $post_type . '_settings', 'option' );
        if ( $resource_settings && ! empty( $resource_settings['archive_page'] ) ) {
            $rules["^{$resource_settings['archive_page']->post_name}/?$"] = 'index.php?post_type=' . $post_type;
        }

        // Add the rules
        foreach ( $rules as $rule => $query ) {
            add_rewrite_rule( $rule, $query, 'top' );
        }
    }

    /**
     * Modify the main query to set the correct posts_per_page value on the Resource archive page
     *
     * @param \WP_Query $query
     * @return void
     */
    public static function set_pre_get_posts_value( \WP_Query $query ): void
    {
        if ( ! is_admin()
            && $query->is_post_type_archive( ResourceType::get_post_type_key() )
            && $query->is_main_query()
        ) {
            $query->set( 'posts_per_page', ResourceType::get_posts_per_page() );

            if ( isset( $_GET['category'] ) ) {
                $tax_query = [
                    [
                        'taxonomy' => ResourceCategory::get_taxonomy_key(),
                        'field' => 'term_id',
                        'terms' => $_GET['category'],
                    ]
                ];
                $query->set( 'tax_query', $tax_query );
            }

        }
    }
}

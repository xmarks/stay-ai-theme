<?php

namespace App\Hooks\HookCollectors;

use App\Hooks\Contracts\HookCollector;

class Blog implements HookCollector
{
    /**
     * @inheritDoc
     */
    public function collect(): void
    {
        add_action( 'acf/init', [$this, 'add_options_page'] );
        add_action( 'save_post_post', [$this, 'set_post_reading_time'], 10, 2 );
        add_action( 'pre_get_posts', [$this, 'set_pre_get_posts_value'] );
        add_filter( 'wpseo_canonical', '__return_false' );
        remove_action( 'template_redirect', 'redirect_canonical' );
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
            'page_title' => 'Blog Settings',
            'menu_title' => 'Settings',
            'menu_slug' => 'blog-settings',
            'capability' => 'edit_posts',
            'parent_slug' => 'edit.php',
            'redirect' => false
        ] );
    }

    /**
     * @param int     $post_id
     * @param WP_Post $post
     * @return void
     */
    public function set_post_reading_time( int $post_id, \WP_Post $post ): void
    {
        $content = $post->post_content;
        $word_count = str_word_count( strip_tags( $content ) );
        $reading_time = ceil( $word_count / 189 );
        update_post_meta( $post_id, 'reading_time', $reading_time );
    }

    /**
     * @param \WP_Query $query
     * @return void
     */
    public static function set_pre_get_posts_value( \WP_Query $query ): void
    {
        if ( ! is_admin()
            && $query->is_home()
            && $query->is_main_query()
        ) {
            if ( isset( $_GET['category'] ) ) {
                $tax_query = [
                    [
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $_GET['category'],
                    ]
                ];
                $query->set( 'tax_query', $tax_query );
            }

        }
    }
}

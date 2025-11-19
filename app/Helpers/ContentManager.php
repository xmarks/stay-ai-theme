<?php

namespace App\Helpers;

class ContentManager
{
    private static array $contents = [];

    /**
     * @param string   $name
     * @param callable $method
     * @return void
     */
    public static function content_for( string $name, callable $method ): void
    {
        self::$contents[$name] = $method;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function yield( string $name ): mixed
    {
        if ( ! array_key_exists( $name, self::$contents ) ) {
            return null;
        }

        return ( self::$contents[$name] )();
    }

    /**
     * @param string $post_type
     * @return string|null
     */
    public static function custom_post_type_content( string $post_type = '' ): ?string
    {
        $post_type_object = ! empty( $post_type )
            ? get_post_type_object( $post_type )
            : get_queried_object();

        if ( ! $post_type_object instanceof \WP_Post_Type ) {
            return null; 
        }

        $post_type_slug = false;
        $post_type_settings = ACF::get_field( "{$post_type_object->name}_settings", 'option' );
        if ( ! empty ( $post_type_settings['archive_page'] ) ) {
            $post_type_slug = $post_type_settings['archive_page']->post_name;
        } elseif ( ! empty( $post_type_object->rewrite['slug'] ) ) {
            $post_type_slug = $post_type_object->rewrite['slug'];
        }

        if ( ! $post_type_slug ) {
            return null;
        }

        $static_page = get_page_by_path( $post_type_slug );

        return isset( $static_page ) && $static_page->post_status === 'publish'
            ? apply_filters( 'the_content', $static_page->post_content )
            : null;
    }

    /**
     * @return string
     */
    public static function the_posts_page_content(): string
    {
        $page_id = get_option( 'page_for_posts' );
        $post = get_post( $page_id );

        setup_postdata( $post );        
        $content = apply_filters( 'the_content', $post->post_content );
        wp_reset_postdata();

        return $content;
    }
}

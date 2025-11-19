<?php

namespace App\Hooks\HookCollectors;

use App\Helpers\ACF;
use App\Hooks\Contracts\HookCollector;

class App implements HookCollector
{
    /**
     * @inheritDoc
     */
    public function collect(): void
    {
        add_action( 'init', [$this, 'set_user_js'] );
        add_filter( 'init', [$this, 'replace_yoast_seo_post_author'] );
        add_filter( 'block_categories_all', [$this, 'add_block_categories'], 10, 2 );
        add_filter( 'get_pagenum_link', [$this, 'remove_query_arg_from_pagenum_link'] );
        add_filter( 'walker_nav_menu_start_el', [$this, 'edit_menu_item'], 10, 4 );
        add_filter( 'wpseo_canonical', '__return_false' );
        remove_action( 'template_redirect', 'redirect_canonical' );
    }

    /**
     * @param array $block_categories
     * @param \WP_Block_Editor_Context $block_editor_context
     * @return array
     */
    public function add_block_categories( array $block_categories, \WP_Block_Editor_Context $block_editor_context ): array
    {
        if ( ! empty( $block_editor_context->post ) ) {
            array_splice( $block_categories, 4, 0, [
                [
                    'slug' => 'archive-blocks',
                    'title' => __( 'Archive', 'sage' ),
                    'icon' => null,
                ]
            ] );
        }

        return $block_categories;
    }

    /**
     * Modifies the menu item output by replacing anchor tags with div tags for items with href="#".
     *
     * @param string $item_output
     * @param object $item
     * @param int    $depth
     * @param array  $args
     * @return string
     */
    public function edit_menu_item( $item_output, $item, $depth, $args ): string
    {
        $pattern = '/<a\s+([^>]*?)\s*href=["\']#["\']([^>]*)>([\s\S]*?)<\/a>/i';
        $replacement = '<div $1 $2>$3</div>';
        $item_output = preg_replace( $pattern, $replacement, $item_output );
        return preg_replace( '/<div\s+>(.*?)<\/div>/', '<div>$1</div>', $item_output );
    }

    /**
     * @return void
     */
    public function set_user_js(): void
    {
        $custom_js_block = ACF::get_field( 'custom_js', 'option' );

        if ( ! $custom_js_block ) {
            return;
        }

        $header_js = $custom_js_block['header_custom_js'] ?? false;
        $footer_js = $custom_js_block['footer_custom_js'] ?? false;

        if ( $header_js ) {
            add_action( 'wp_head', function () use ( $header_js ) {
                echo $header_js;
            } );
        }

        if ( $footer_js ) {
            add_action( 'wp_footer', function () use ( $footer_js ) {
                echo $footer_js;
            } );
        }
    }

    /**
     * @param string $link
     * @return string
     */
    public function remove_query_arg_from_pagenum_link( string $link ): string
    {
        return preg_replace( '/\?.*/', '', $link );
    }

    /**
     * Replace the Yoast SEO author name with the custom author name.
     *
     * @return void
     */
    public static function replace_yoast_seo_post_author(): void
    {
        /**
         * Gets the author for the current post.
         *
         * @return \WP_Post|null
         */
        $get_author = function (): ?\WP_Post
        {
            if ( ! is_singular( 'post' ) ) {
                return null;
            }

            global $post;
            return ACF::get_field( 'author', $post->ID );
        };

        /**
         * Filter to replace the Yoast SEO author name with the custom author name.
         *
         * @param string $author_name
         * @return string
         */
        $replace_author_name = function ( string $author_name ) use ( $get_author ): string {
            $author = $get_author();
            return $author ? $author->post_title : $author_name;
        };

        /**
		 * <meta name="author" content="John Doe" />
		 */
        add_filter( 'wpseo_meta_author', $replace_author_name );
        
        /**
         * <meta property="twitter:data" content="John Doe" />
         */
        add_filter( 'wpseo_enhanced_slack_data', function ( array $data ) use ( $replace_author_name ): array {
            if ( ! empty( $data['Written by'] ) ) {
                $data['Written by'] = $replace_author_name( $data['Written by'] );
            }
            return $data;
        }, 10, 1 );

        /**
         * <script type="application/ld+json"> { "@type": "Person", "name": "John Doe" } </script>
         */
        add_filter( 'wpseo_schema_person_data', function ( array $person_data ) use ( $get_author ): array {
            $author = $get_author();
            if ( $author && ! empty( $person_data ) ) {
                $person_data['name'] = $author->name;
                $person_data['image']['caption'] = $author->name;
                if ( $author->image_id ) {
                    $avatar = wp_get_attachment_image_url( $author->image_id );
                    $personData['image']['url'] = $avatar;
                    $personData['image']['contentUrl'] = $avatar;
                }
            }
            return $person_data;
        });
    }
}

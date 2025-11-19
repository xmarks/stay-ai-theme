<?php

namespace App\PostTypes\Contracts;

abstract class PostType
{
    /**
     * @return string
     */
    public abstract static function get_post_type_key(): string;

    /**
     * @return string
     */
    protected abstract function get_singular_name(): string;

    /**
     * @return string
     */
    protected abstract function get_plural_name(): string;
    
    /**
     * Initializes the post type by registering the 'init' action hook.
     *
     * This method adds an action to WordPress's 'init' hook, which will call
     * the 'register' method to register the custom post type.
     *
     * @return void
     */
    public function init(): void
    {
        add_action( 'init', [$this, 'register'] );
    }
    
    /**
     * Registers the custom post type.
     *
     * This method merges the default arguments defined by this class with any
     * custom arguments defined by the child class. It then passes the merged
     * arguments to WordPress's register_post_type() method to register the
     * custom post type.
     *
     * @return void
     */
    public function register(): void
    {
        $args = array_merge(
            $this->get_default_args(),
            $this->get_custom_args()
        );

        register_post_type( static::get_post_type_key(), $args );
    }

    /**
     * Gets the number of posts to display per page for the post type.
     *
     * If the class property `posts_per_page` is defined, it will be used.
     * Otherwise, the value of the WordPress option `posts_per_page` will be used.
     *
     * @return int
     */
    public static function get_posts_per_page(): int
    {
        return property_exists( static::class, 'posts_per_page' )
            ? (int)static::$posts_per_page
            : (int)get_option( 'posts_per_page' );
    }
    
    /**
     * Retrieves all published posts for the post type.
     *
     * @return \WP_Post[]|int[]
     */
    public static function get_published(): array
    {
        return get_posts( [
            'posts_per_page' => -1,
            'post_type' => self::get_post_type_key(),
            'post_status' => ['publish'],
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ] );
    }

    /**
     * Override this method to define custom arguments for register_post_type.
     *
     * This method should return an associative array of key => value pairs, where
     * the key is the name of the argument, and the value is the value of that
     * argument. For example:
     *
     * [
     *     'public' => true,
     *     'has_archive' => true,
     * ]
     *
     * The custom arguments will be merged with the default arguments defined in
     * `get_default_args()`.
     *
     * @return array
     */
    protected function get_custom_args(): array
    {
        return [];
    }

    /**
     * Gets the labels for the post type.
     *
     * The labels are generated automatically based on the singular and plural
     * names of the post type. The singular and plural names should be provided
     * as strings, and will be used to generate the labels for the post type.
     *
     * @param string $singular
     * @param string $plural
     * @return array
     */
    protected static function get_labels( string $singular, string $plural ): array
    {
        $singular = ucwords( $singular );
        $lsingular = strtolower( $singular );
        $plural = ucwords( $plural );
        $lplural = strtolower( $plural );

        return [
            'name' => __( $plural, 'text-domain' ),
            'singular_name' => __( $singular, 'text-domain' ),
            'menu_name' => __( $plural, 'text-domain' ),
            'all_items' => __( $plural, 'text-domain' ),
            'edit_item' => __( "Edit $singular", 'text-domain' ),
            'view_item' => __( "View $singular", 'text-domain' ),
            'view_items' => __( "View $plural", 'text-domain' ),
            'add_new_item' => __( "Add New $singular", 'text-domain' ),
            'new_item' => __( "New $singular", 'text-domain' ),
            'search_items' => __( "Search $plural", 'text-domain' ),
            'not_found' => __( "No $lplural found", 'text-domain' ),
            'not_found_in_trash' => __( "No $lplural found in Trash", 'text-domain' ),
            'archives' => __( "$singular Archives", 'text-domain' ),
            'attributes' => __( "$singular Attributes", 'text-domain' ),
            'insert_into_item' => __( "Insert into $lsingular", 'text-domain' ),
            'uploaded_to_this_item' => __( "Uploaded to this $lsingular", 'text-domain' ),
            'filter_items_list' => __( "Filter $lplural list", 'text-domain' ),
            'items_list_navigation' => __( "$singular list navigation", 'text-domain' ),
            'items_list' => __( "$plural list", 'text-domain' ),
            'item_published' => __( "$singular published.", 'text-domain' ),
            'item_published_privately' => __( "$singular published privately.", 'text-domain' ),
            'item_reverted_to_draft' => __( "$singular reverted to draft.", 'text-domain' ),
            'item_scheduled' => __( "$singular scheduled.", 'text-domain' ),
            'item_updated' => __( "$singular updated.", 'text-domain' ),
            'item_link' => __( "$singular Link", 'text-domain' ),
            'item_link_description' => __( "A link to a $lsingular.", 'text-domain' )
        ];
    }

    /**
     * Default arguments for register_post_type.
     *
     * By default, we only define the labels. If you want to add more
     * arguments, you can override `get_custom_args()` in your child class.
     *
     * @return array
     */
    private function get_default_args(): array
    {
        return [
            'labels' => static::get_labels( $this->get_singular_name(), $this->get_plural_name() ),
        ];
    }
}

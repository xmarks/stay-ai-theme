<?php

namespace App\Taxonomies\Contracts;

use App\Helpers\App;

abstract class Taxonomy
{
    /**
     * @return string
     */
    public abstract static function get_taxonomy_key(): string;

    /**
     * @return array|string
     */
    public abstract static function get_associated_object_types(): array|string;

    /**
     * @return string
     */
    protected abstract function get_singular_name(): string;

    /**
     * @return string
     */
    protected abstract function get_plural_name(): string;
    
    /**
     * Initializes the taxonomy by registering the 'init' action hook.
     *
     * This method adds an action to WordPress's 'init' hook, which will call
     * the 'register' method to register the custom taxonomy.
     *
     * @return void
     */
    public function init(): void
    {
        add_action( 'init', [$this, 'register'] );
    }
    
    /**
     * Registers the custom taxonomy.
     *
     * This method merges the default arguments defined by this class with any
     * custom arguments defined by the child class. It then passes the merged
     * arguments to WordPress's register_taxonomy() method to register the
     * custom taxonomy.
     *
     * @return void
     */
    public function register(): void
    {
        $args = array_merge(
            $this->get_default_args(),
            $this->get_custom_args()
        );

        register_taxonomy(
            static::get_taxonomy_key(),
            static::get_associated_object_types(),
            $args
        );
    }
    
    
    /**
     * Retrieves all published terms for the taxonomy.
     *
     * @return \WP_Term[]|int[]|string[]|string|\WP_Error
     */
    public static function get_published(): array
    {
        return App::get_terms( [
            'taxonomy' => self::get_taxonomy_key(),
            'hide_empty' => true
        ] );
    }

    /**
     * Override this method to define custom arguments for register_taxonomy.
     *
     * This method should return an associative array of key => value pairs, where
     * the key is the name of the argument, and the value is the value of that
     * argument. For example:
     *
     * [
     *     'public' => true,
     *     'hierarchical' => true,
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
     * Gets the labels for the taxonomy.
     *
     * The labels are generated automatically based on the singular and plural
     * names of the taxonomy. The singular and plural names should be provided
     * as strings, and will be used to generate the labels for the taxonomy.
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
            'search_items' => __( "Search $lplural", 'text-domain' ),
            'all_items' => __( "All $lplural", 'text-domain' ),
            'parent_item' => __( "Parent $lsingular", 'text-domain' ),
            'parent_item_colon' => __( "Parent $lsingular:", 'text-domain' ),
            'edit_item' => __( "Edit $lsingular", 'text-domain' ),
            'update_item' => __( "Update $lsingular", 'text-domain' ),
            'add_new_item' => __( "Add new $lsingular", 'text-domain' ),
            'new_item_name' => __( "New $lsingular name", 'text-domain' ),
            'not_found' => __( "No $lplural found", 'text-domain' ),
            'item_link' => __( "$singular Link", 'text-domain' ),
            'item_link_description' => __( "A link to a $lsingular.", 'text-domain' ),
            'view_item' => __( "View $lsingular", 'text-domain' ),
            'back_to_items' => __( "← Go to $lplural", 'text-domain' ),
        ];
    }

    /**
     * Default arguments for register_taxonomy.
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

<?php

namespace App\Walkers;

use App\Helpers\ContentManager;
use stdClass;

class HeaderMobileMainMenuWalker extends HeaderMainMenuWalker
{
    /**
     * @inheritDoc
     */
    public function start_lvl( &$output, $depth = 0, $args = null ): void
    {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
    
        // Default class.
        $classes = ['sub-menu'];
    
        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
    
        $atts          = array();
        $atts['class'] = ! empty( $class_names ) ? $class_names : '';
    
        /**
         * Filters the HTML attributes applied to a menu list element.
         *
         * @since 6.3.0
         *
         * @param array $atts {
         *     The HTML attributes applied to the `<ul>` element, empty strings are ignored.
         *
         *     @type string $class    HTML CSS class attribute.
         * }
         * @param stdClass $args      An object of `wp_nav_menu()` arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $atts       = apply_filters( 'nav_menu_submenu_attributes', $atts, $args, $depth );
        $attributes = $this->build_atts( $atts );

        $submenu_data = ContentManager::yield( "level_{$depth}_last_menu_item_data" );
        $output .= view( 'partials.main-menu.mobile.submenu-start', $submenu_data )->render();
    
        $output .= "{$n}{$indent}<ul{$attributes}>{$n}";
    }

    /**
     * @inheritDoc
     */
    public function end_lvl( &$output, $depth = 0, $args = null ): void
    {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent  = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";

        $submenu_data = ContentManager::yield( "level_{$depth}_last_menu_item_data" );
        $output .= view( 'partials.main-menu.mobile.submenu-end', $submenu_data )->render();
    }
    

    /**
     * @inheritDoc
     */
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ): void
    {
        // Restores the more descriptive, specific name for use within this method.
        $menu_item = $data_object;

        $item_output = $this->get_menu_item_output( $menu_item, $depth, $args );

        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
        } else {
            $t = "\t";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes = empty( $menu_item->classes ) ? [] : (array) $menu_item->classes;
        $classes[] = 'menu-item-' . $menu_item->ID;

        if ( $depth === 1 ) {
            $classes[] = 'sub-menu-item';
        }

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param WP_Post $menu_item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 4.4.0
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

        /**
         * Filters the CSS classes applied to a menu item's list item element.
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post $menu_item The current menu item object.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         */
        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filters the ID attribute applied to a menu item's list item element.
         *
         * @param string $menu_item_id The ID attribute applied to the menu item's `<li>` element.
         * @param WP_Post $menu_item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        /**
         * Filters a menu item's starting output.
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param WP_Post $menu_item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @since 3.0.0
         */

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );

        ContentManager::content_for(
            "level_{$depth}_last_menu_item_data",
            fn () => $this->get_menu_item_data( $menu_item )
        );
    }
}

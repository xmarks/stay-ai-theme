<?php

namespace App\Walkers;

use App\Helpers\{ACF, ContentManager};
use stdClass;

class HeaderMainMenuWalker extends \Walker_Nav_Menu
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

        if ( $depth === 0 ) {
            $submenu_data = ContentManager::yield( 'level_0_last_menu_item_data' );
            $output .= view( 'partials.main-menu.submenu-start', $submenu_data )->render();
        }
    
        $output .= "{$n}{$indent}<ul{$attributes}>{$n}";
    }

    /**
     * @inheritDoc
     */
    public function end_lvl( &$output, $depth = 0, $args = null ): void
    {
        parent::end_lvl( $output, $depth, $args );

        if ( $depth === 0 ) {
            $submenu_data = ContentManager::yield( 'level_0_last_menu_item_data' );
            $output .= view( 'partials.main-menu.submenu-end', $submenu_data )->render();
        }
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
        if ( $depth > 0 ) {
            $fields = $this->get_menu_item_data( $menu_item );
            if ( ! empty( $fields['bold_type'] ) ) {
                $class_names .= ' second-nesting';
            }
        }
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

        if ( $depth === 0 ) {
            ContentManager::content_for(
                "level_{$depth}_last_menu_item_data",
                fn () => $this->get_menu_item_data( $menu_item )
            );
        }
    }

    /**
     * @param object $menu_item
     * @param int|null $depth
     * @param array $args
     * @return string
     */
    protected function get_menu_item_output( $menu_item, $depth, $args ): string
    {
        $atts = [];
        $atts['title'] = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
        $atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
        if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $menu_item->xfn;
        }

        if ( ! empty( $menu_item->url ) ) {
            if ( get_privacy_policy_url() === $menu_item->url ) {
                $atts['rel'] = empty( $atts['rel'] ) ? 'privacy-policy' : $atts['rel'] . ' privacy-policy';
            }

            $atts['href'] = $menu_item->url;
        } else {
            $atts['href'] = '';
        }

        $atts['aria-current'] = $menu_item->current ? 'page' : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * @type string $aria -current The aria-current attribute.
         * }
         * @param WP_Post $menu_item The current menu item object.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );
        $atts['class'] = '';

        if ( $depth > 0 ) {
            $atts['class'] = 'menu-item__link menu-item-link';
        }

        $attributes = '';
        $item_tag = 'span';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                if ( $attr === 'href' ) {
                    $item_tag = 'a';
                    $value = esc_url( $value );
                } else {
                    $value = esc_attr( $value );
                }

                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

        /**
         * Filters a menu item's title.
         *
         * @param string $title The menu item's title.
         * @param WP_Post $menu_item The current menu item object.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 4.4.0
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

        if ( $depth > 0 ) {
            $args = [
                'before' => $args->before,
                'after' => $args->after,
                'link_before' => $args->link_before,
                'link_after' => $args->link_after,
                'tag' => $item_tag,
                'title' => $title,
                'description' => $menu_item->description,
            ];

            $fields = $this->get_menu_item_data( $menu_item );
            if ( ! empty( $fields['icon_enabled'] ) && ! empty( $fields['item_icon'] ) ) {
                $args['icon'] = $fields['item_icon'];
            }

            return $this->get_menu_view_item_depth_more_0( $args, $attributes );
        }

        $item_output = $args->before;
        $item_output .= sprintf( '<%s%s>', $item_tag, $attributes );
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= "</$item_tag>";
        $item_output .= $args->after;

        return $item_output;
    }

    

    /**
     * @param stdClass|\WP_Post $item
     * @return array|false
     */
    protected function get_menu_item_data( stdClass|\WP_Post $item ): array|false
    {
        return ACF::get_fields( $item->ID ) ?: [];
    }

    /**
     * @param array $args
     * @param string $attributes
     * @return string
     */
    protected function get_menu_view_item_depth_more_0( array $args, string $attributes ): string
    {
        return view( 'partials.main-menu.item-depth-more-0', compact( 'args', 'attributes' ) )->render();
    }
}

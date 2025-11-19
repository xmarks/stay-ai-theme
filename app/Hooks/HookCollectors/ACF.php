<?php

namespace App\Hooks\HookCollectors;

use App\Hooks\Contracts\HookCollector;

class ACF implements HookCollector
{
    /**
     * @inheritDoc
     */
    public function collect(): void
    {
        add_action( 'acf/init', [$this, 'add_options_page'] );
        add_filter( 'acf/format_value/type=relationship', [$this, 'filter_reference_field_value'], 10, 1 );
        add_filter( 'acf/format_value/type=post_object', [$this, 'filter_reference_field_value'], 10, 1 );
    }

    /**
     * @return void
     */
    public function add_options_page(): void
    {
        if ( ! function_exists( 'acf_add_options_page' ) ) {
            return;
        }

        $theme_options = acf_add_options_page( [
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug' => 'theme-options',
            'redirect' => true,
        ] );

        $menu_slug = $theme_options['menu_slug'];
        $submenu_items = [
            'general' => 'General',
            'header' => 'Header',
            'footer' => 'Footer',
            'global_cta' => 'Global CTA',
            '404-page' => '404 Page',
        ];

        foreach ( $submenu_items as $submenu_slug => $submenu_title ) {
            acf_add_options_sub_page( [
                'page_title' => $submenu_title,
                'menu_title' => $submenu_title,
                'menu_slug' => "$menu_slug-$submenu_slug",
                'parent_slug' => $menu_slug,
                'autoload' => true
            ] );
        }
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function filter_reference_field_value( mixed $value ): mixed
    {
        if ( is_array( $value ) && ! empty( $value ) ) {
            $value = array_filter( $value, function ($post_id) {
                return get_post_status( $post_id ) === 'publish';
            } );
        } elseif ( $value && get_post_status( $value ) !== 'publish' ) {
            return null;
        }
        return $value;
    }
}

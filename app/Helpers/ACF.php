<?php

namespace App\Helpers;

class ACF
{
    /**
     * @param string $selector
     * @param mixed|null $post_id
     * @param bool $format_value
     * @return mixed
     */
    public static function get_field( string $selector, mixed $post_id = false, bool $format_value = true ): mixed
    {
        if ( ! function_exists( 'get_field' ) ) {
            return null;
        }

        return get_field( $selector, $post_id, $format_value );
    }

    /**
     * @param mixed|null $post_id
     * @param bool $format_value
     * @return mixed
     */
    public static function get_fields( mixed $post_id = false, bool $format_value = true ): mixed
    {
        if ( ! function_exists( 'get_fields' ) ) {
            return null;
        }

        return get_fields( $post_id, $format_value );
    }
}

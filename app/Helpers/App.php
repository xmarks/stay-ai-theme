<?php

namespace App\Helpers;

use App\Helpers\ACF;

class App
{
    /**
     * Retrieves HubSpot data for the footer form.
     *
     * @return array
     */
    public static function get_hbspt_data(): array
    {
        $data = ACF::get_field( 'footer_form', 'option' );

        return [
            'src' => $data['script_src'] ?? '',
            'newsletter_form' => [
                'portalId' => $data['portal_id'] ?? '',
                'formId' => $data['form_id'] ?? '',
            ]
        ];
    }

    /**
     * @param int|\WP_Post $post
     * @param string $taxonomy
     * @return null|\WP_Term
     */
    public static function get_term( int|\WP_Post $post, string $taxonomy = 'category' ): ?\WP_Term
    {
        if ( is_int( $post ) ) {
            $post = get_post( $post );
        }

        if ( ! $post ) {
            return null;
        }

        if ( class_exists( 'WPSEO_Primary_Term' ) ) {
            $wpseo_primary_term = new \WPSEO_Primary_Term( $taxonomy, $post->post_ID );
            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();

            if ( $wpseo_primary_term ) {
                return get_term( $wpseo_primary_term );
            }
        }

        $terms = self::get_the_terms( $post, $taxonomy );
        return ! empty( $terms ) ? $terms[0] : null;
    }

    /**
     * @param int|\WP_Post $post
     * @param string $taxonomy
     * @return array|null
     */
    public static function get_the_terms( int|\WP_Post $post, string $taxonomy = 'category' ): ?array
    {
        $terms = get_the_terms( $post, $taxonomy );
        return is_array( $terms ) ? $terms : null;
    }

  
    /**
     * @param array|string $args
     * @return array|null
     */
    public static function get_terms( array|string $args = [] ): ?array
    {
        $terms = get_terms( $args );
        return is_array( $terms ) ? $terms : null;
    }
}

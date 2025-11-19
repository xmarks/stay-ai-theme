<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Helpers\ACF;
use App\Services\Breadcrumbs\Enums\LinkType;

class PageLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $post = get_queried_object();

        if ( ! $post->post_parent ) {
            $links = $this->default_home_link();
        } else {
            $ancestors = array_reverse( get_post_ancestors( $post->ID ) );

            foreach ( $ancestors as $ancestor ) {
                $link = get_permalink( $ancestor );
                $title = get_the_title( $ancestor );
                $links[] = [
                    'title' => $title,
                    'link' => $link,
                    'type' => LinkType::LINK
                ];
            }
        }

        return $this->adjust_last_lvl( $post, $links );
    }

    /**
     * @param \WP_Post $post
     * @param array    $links
     * @return array
     */
    private function adjust_last_lvl( \WP_Post $post, array $links ): array
    {
        $settings = ACF::get_fields( $post->ID );

        if ( isset( $settings['show_in_breadcrumbs'] ) && ! $settings['show_in_breadcrumbs'] ) {
            $links[array_key_last( $links )]['type'] = LinkType::TEXT;
            return $links;
        }

        $links[] = [
            'title' => $post->post_title,
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

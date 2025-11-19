<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class BlogLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->get_home_links();

        if ( is_paged() ) {
            $links[count( $links ) - 1]['title'] .= $this->paged_postfix();
        }

        return $links;
    }

    /**
     * @return array[]
     */
    private function get_home_links(): array
    {
        $posts_page = get_option( 'page_for_posts' );

        if ( ! $posts_page ) {
            return $this->default_home_link();
        }

        $posts_page = get_post( $posts_page );
        $links = $this->default_home_link();

        $links[] = [
            'title' => $posts_page->post_title,
            'link' => get_permalink( $posts_page ),
            'type' => LinkType::TEXT,
        ];

        return $links;
    }
}

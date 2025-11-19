<?php

namespace App\Services\Breadcrumbs\Collectors\Single;

use App\Helpers\CaseStudy;
use App\Services\Breadcrumbs\{
    Collectors\Collector,
    Enums\LinkType
};

class CaseStudySingleLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->get_home_links();
        $post = get_queried_object();
        $links[] = [
            'title' => $post->post_title,
            'type' => LinkType::TEXT
        ];

        return $links;
    }

    /**
     * @return array[]
     */
    private function get_home_links(): array
    {
        $links = $this->default_home_link();

        $main_page = CaseStudy::get_main_page();
        if ( $main_page ) {
            $links[] = [
                'title' => $main_page->post_title,
                'link' => get_permalink( $main_page ),
                'type' => LinkType::LINK
            ];
        }

        return $links;
    }
}

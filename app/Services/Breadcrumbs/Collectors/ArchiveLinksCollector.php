<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\{
    Collectors\Collector,
    Enums\LinkType
};

class ArchiveLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->default_home_link();
        $static_page = $this->retrieve_static_page_link();
        if ( $static_page ) {
            $links[] = $static_page;
        } else {
            $links[] = [
                'title' => post_type_archive_title( '', false ),
                'type' => LinkType::TEXT
            ];
        }

        return $links;
    }

    /**
     * @return array|null
     */
    private function retrieve_static_page_link(): array|null
    {
        $queried_object = get_queried_object();
        if ( empty( $queried_object?->rewrite['slug'] ) ) {
            return null;
        }
        
        $static_page = get_page_by_path( $queried_object->rewrite['slug'] );
        if ( ! $static_page ) {
            return null;
        }

        return [
            'title' => $static_page->post_title,
            'type' => LinkType::TEXT
        ];
    }
}

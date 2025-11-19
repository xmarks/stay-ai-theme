<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class SearchLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->default_home_link();
        $links[] = [
            'title' => sprintf( '%s: %s', __( 'Search results for', 'sage' ), get_search_query() ),
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

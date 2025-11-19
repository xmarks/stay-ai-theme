<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class PagedLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        if ( is_archive() ) {
            $archive_collector = new ArchiveLinksCollector();
            $links = $archive_collector->collect();
            $links[array_key_last( $links )]['title'] .= $this->paged_postfix();
        } else {
            $links = $this->default_home_link();
            $links[] = [
                'title' => sprintf( '%s %s', __( 'Page', 'sage' ), get_query_var( 'paged' ) ),
                'type' => LinkType::TEXT
            ];
        }

        return $links;
    }
}

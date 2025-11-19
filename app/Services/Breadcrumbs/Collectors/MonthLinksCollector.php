<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class MonthLinksCollector extends Collector
{
    /**
     * @var \App\Services\Breadcrumbs\Collectors\BlogLinksCollector $blog_links_collector
     */
    private BlogLinksCollector $blog_links_collector;

    public function __construct() {
        $this->blog_links_collector = new BlogLinksCollector();
    }

    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->blog_links_collector->collect();
        $links[array_key_last( $links )]['type'] = LinkType::LINK;
        $year = get_the_time( 'Y' );

        // Year link
        $links[] = [
            'title' => sprintf( '%s %s', $year, __( 'Archives', 'sage' ) ),
            'link' => get_year_link( $year ),
            'type' => LinkType::LINK
        ];
        // Month
        $links[] = [
            'title' => sprintf( '%s %s', get_the_time( 'M' ), __( 'Archives', 'sage' ) ),
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

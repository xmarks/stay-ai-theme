<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class AuthorLinksCollector extends Collector
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

        $author_id = get_queried_object_id();
        $author_data = get_userdata($author_id);
        $name = $author_data->first_name ?: '';
        $name .= $author_data->last_name ? ' ' . $author_data->last_name : '';
        $name = $name ? trim( $name ) : $author_data->nickname;
        $links[] = [
            'title' => $name,
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

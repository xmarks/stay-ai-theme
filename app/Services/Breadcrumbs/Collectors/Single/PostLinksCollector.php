<?php

namespace App\Services\Breadcrumbs\Collectors\Single;

use App\Services\Breadcrumbs\{
    Collectors\BlogLinksCollector,
    Collectors\Collector,
    Enums\LinkType
};
    
class PostLinksCollector extends Collector
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

        $post = get_queried_object();

        $links[] = [
            'title' => $post->post_title,
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class TagLinksCollector extends Collector
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

        $term_id = get_query_var( 'tag_id' );
        $taxonomy = 'post_tag';
        $args = "include=$term_id";
        $terms = get_terms( $taxonomy, $args );

        $links[] = [
            'title' => $terms[0]->name,
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

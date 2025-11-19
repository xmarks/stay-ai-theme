<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class TaxLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->default_home_link();

        $post_type = get_post_type();
        if ( $post_type !== 'post' ) {
            $post_type_object = get_post_type_object( $post_type );
            $post_type_archive = get_post_type_archive_link( $post_type );
            $links[] = [
                'title' => $post_type_object->labels->name,
                'link' => $post_type_archive,
                'type' => LinkType::LINK
            ];
        }

        $post = get_queried_object();
        $links[] = [
            'title' => $post->name,
            'type' => LinkType::TEXT
        ];

        return $links;
    }
}

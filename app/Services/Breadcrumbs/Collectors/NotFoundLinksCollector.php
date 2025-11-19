<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

class NotFoundLinksCollector extends Collector
{
    /**
     * @return array
     */
    public function collect(): array
    {
        $links = $this->default_home_link();
        $links[] = [
            'title' => __( 'Page Not Found', 'sage' ),
            'type' => LinkType::TEXT
        ];
        
        return $links;
    }
}

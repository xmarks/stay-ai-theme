<?php

namespace App\Services\Breadcrumbs;

use App\Enums\QueryType;
use App\Services\Breadcrumbs\Factories\LinksCollectorFactory;

class BreadcrumbsService
{
    const SETTINGS_KEY = 'breadcrumbs_settings';

    /**
     * @param \App\Services\Breadcrumbs\Factories\LinksCollectorFactory $collector_factory
     * @param \App\Services\Breadcrumbs\QueryTypeResolver $query_type_resolver
     */
    public function __construct(
        protected readonly LinksCollectorFactory $collector_factory,
        protected readonly QueryTypeResolver $query_type_resolver
    ) {
    }

    /**
     * @return array|null
     */
    public function get_links(): ?array
    {
        try {
            $query_type = $this->query_type_resolver->resolve();
            if ( $query_type === QueryType::FRONT_PAGE ) {
                return null;
            }

            $collector = $this->collector_factory->make( $query_type );
            return $collector->collect();
        } catch ( \Exception ) {
            return null;
        }
    }
}

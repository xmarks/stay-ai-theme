<?php

namespace App\Services\Breadcrumbs\Factories;

use App\Enums\PostType;
use App\Services\Breadcrumbs\Collectors\Collector;
use App\Services\Breadcrumbs\Collectors\Single\{
    PostLinksCollector,
    CaseStudySingleLinksCollector,
};
use UnexpectedValueException;

class SingleCollectorFactory
{
    /**
     * @param \App\Enums\PostType $post_type
     * @return \App\Services\Breadcrumbs\Collectors\Collector
     */
    public function make( PostType $post_type ): Collector
    {
        return match ( $post_type ) {
            PostType::POST => new PostLinksCollector(),
            PostType::CASE_STUDY => new CaseStudySingleLinksCollector(),
            default => throw new UnexpectedValueException( "Breadcrumbs handler for $post_type->value not exists" ),
        };
    }
}

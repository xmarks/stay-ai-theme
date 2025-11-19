<?php

namespace App\Services\Breadcrumbs\Factories;

use App\Enums\QueryType;
use App\Services\Breadcrumbs\Collectors\{
    ArchiveLinksCollector,
    AuthorLinksCollector,
    BlogLinksCollector,
    CategoryLinksCollector,
    Collector,
    DayLinksCollector,
    MonthLinksCollector,
    NotFoundLinksCollector,
    PagedLinksCollector,
    PageLinksCollector,
    SearchLinksCollector,
    SingleLinksCollector,
    TagLinksCollector,
    TaxLinksCollector,
    YearLinksCollector
};
use UnexpectedValueException;

class LinksCollectorFactory
{
    /**
     * @param \App\Enums\QueryType $query_type
     * @return \App\Services\Breadcrumbs\Collectors\Collector
     */
    public function make( QueryType $query_type ): Collector
    {
        return match ( $query_type ) {
            QueryType::HOME => new BlogLinksCollector(),
            QueryType::PAGE => new PageLinksCollector(),
            QueryType::SINGLE => new SingleLinksCollector(),
            QueryType::CATEGORY => new CategoryLinksCollector(),
            QueryType::TAG => new TagLinksCollector(),
            QueryType::ARCHIVE => new ArchiveLinksCollector(),
            QueryType::TAX => new TaxLinksCollector(),
            QueryType::DAY => new DayLinksCollector(),
            QueryType::MONTH => new MonthLinksCollector(),
            QueryType::YEAR => new YearLinksCollector(),
            QueryType::AUTHOR => new AuthorLinksCollector(),
            QueryType::PAGED => new PagedLinksCollector(),
            QueryType::SEARCH => new SearchLinksCollector(),
            QueryType::NOT_FOUND => new NotFoundLinksCollector(),
            default => throw new UnexpectedValueException( "Breadcrumbs handler for $query_type->value not exists" ),
        };
    }
}

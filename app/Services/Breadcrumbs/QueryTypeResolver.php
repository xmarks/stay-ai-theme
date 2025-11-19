<?php

namespace App\Services\Breadcrumbs;

use App\Enums\QueryType;

class QueryTypeResolver
{
    /**
     * @return \App\Enums\QueryType
     * @throws \Exception
     */
    public function resolve(): QueryType
    {
        $conditionals = [
            'is_home' => QueryType::HOME,
            'is_front_page' => QueryType::FRONT_PAGE,
            'is_page' => QueryType::PAGE,
            'is_single' => QueryType::SINGLE,
            'is_category' => QueryType::CATEGORY,
            'is_tag' => QueryType::TAG,
            'is_day' => QueryType::DAY,
            'is_month' => QueryType::MONTH,
            'is_year' => QueryType::YEAR,
            'is_author' => QueryType::AUTHOR,
            'is_search' => QueryType::SEARCH,
            'is_paged' => QueryType::PAGED,
            'is_404' => QueryType::NOT_FOUND,
        ];

        foreach ( $conditionals as $conditional => $type ) {
            if ( function_exists( $conditional ) && $conditional() ) {
                return $type;
            }
        }

        if ( is_tax() && ! is_category() && ! is_tag() ) {
            return QueryType::TAX;
        }

        if ( is_archive() ) {
            return QueryType::ARCHIVE;
        }

        throw new \Exception( 'Unable to resolve the type of the query' );
    }
}
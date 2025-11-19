<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Services\Breadcrumbs\Enums\LinkType;

abstract class Collector
{
    /**
     * @return array
     */
    public abstract function collect(): array;

    /**
     * @return array[]
     */
    protected function default_home_link(): array
    {
        return [
            [
                'title' => __( 'Home', 'sage' ),
                'link' => home_url( '/' ),
                'type' => LinkType::LINK
            ]
        ];
    }

    /**
     * @return string
     */
    protected function paged_postfix(): string
    {
        return sprintf( ' - %s %s', __( 'Page', 'sage' ), get_query_var( 'paged' ) );
    }    
}
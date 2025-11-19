<?php

namespace App\Services\Breadcrumbs\Collectors;

use App\Helpers\App;
use App\Services\Breadcrumbs\{
    PostTypeResolver,
    Factories\SingleCollectorFactory
};

class SingleLinksCollector extends Collector
{
    /**
     * @var \App\Services\Breadcrumbs\PostTypeResolver
     */
    private PostTypeResolver $post_type_resolver;

    /**
     * @var \App\Services\Breadcrumbs\Factories\SingleCollectorFactory
     */
    private SingleCollectorFactory $single_collector_factory;

    public function __construct()
    {
        $this->post_type_resolver = new PostTypeResolver();
        $this->single_collector_factory = new SingleCollectorFactory();
    }

    /**
     * @return array[]
     */
    public function collect(): array
    {
        $post_type = $this->post_type_resolver->resolve();

        $single_collector = $this->single_collector_factory->make( $post_type );
        return $single_collector->collect();
    }
}

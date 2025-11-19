<?php

namespace App\Blocks;

use App\Blocks\Contracts\BlockContract;

class BlockFactory
{
    /**
     * @param \App\Blocks\BlockBuilder $builder
     */
    final public function __construct( private BlockBuilder $builder )
    {
        $this->builder->build_block();
    }

    /**
     * @return \App\Blocks\Contracts\BlockContract
     */
    final public function create(): BlockContract
    {
        return $this->builder->get_block();
    }
}
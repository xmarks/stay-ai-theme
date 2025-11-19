<?php

namespace App\Blocks\BlockTypes;

use App\Helpers\ACF;

class Counters extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_block_data();
    }

    /**
     * @return void
     */
    private function prepare_block_data(): void
    {
        $this->data['counters'] = ACF::get_field( 'counters' );
    }
}

<?php

namespace App\Blocks\BlockTypes;

use App\Blocks\Contracts\BlockContract;
use App\Helpers\ACF;
use Illuminate\Support\Facades\View;

class BaseBlock implements BlockContract
{
    public function __construct(
        protected string $id,
        protected string $view,
        protected array $data = [],
        protected array $attributes = []
    ) {
        $this->fill_data();
        $this->set_block_attributes();
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        return View::first(
            ["blocks/$this->view", "blocks/$this->view/index"],
            [...$this->data, 'attributes' => $this->attributes]
        )->render();
    }

    
    /**
     * Fills the block data with the fields from the Advanced Custom Fields plugin.
     * If no fields are found for the given block id, an empty array is used instead.
     */
    protected function fill_data(): void
    {
        $this->data = ACF::get_fields( $this->id ) ?: [];
    }

    /**
     * Applies the block supports to the attributes array.
     *
     * Uses the {@see \WP_Block_Supports} class to apply the block supports to the block attributes.
     * The resulting attributes are then stored in the `attributes` property for later use.
     */
    protected function set_block_attributes(): void
    {
        $this->attributes = \WP_Block_Supports::get_instance()->apply_block_supports();
    }
}
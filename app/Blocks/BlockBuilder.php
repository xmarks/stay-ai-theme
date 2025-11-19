<?php

namespace App\Blocks;

use App\Blocks\BlockTypes\BaseBlock;
use App\Blocks\Contracts\BlockContract;

class BlockBuilder
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var \App\Blocks\Contracts\BlockContract
     */
    protected $block;

    /**
     * @param array $attributes
     */
    public function __construct( array $attributes = [] )
    {
        $this->attributes = $attributes;
    }

    /**
     * @return \App\Blocks\Contracts\BlockContract|null
     */
    final public function get_block(): ?BlockContract
    {
        return $this->block;
    }

    /**
     * @return void
     */
    final public function build_block(): void
    {
        if ( empty( $this->attributes['id'] ) || empty( $this->attributes['name'] ) ) {
            throw new \InvalidArgumentException( 'ID or name block not specified' );
        }

        $name = str_replace( 'acf/', '', $this->attributes['name'] );

        $class_name = str_replace( '-', '', ucwords( $name, '-' ) );
        $class = __NAMESPACE__ . '\\BlockTypes\\' . $class_name;

        if ( ! class_exists( $class ) ) {
            $class = BaseBlock::class;
        }

        $this->block = new $class( $this->attributes['id'], $name, $this->attributes['data'] );
    }
}
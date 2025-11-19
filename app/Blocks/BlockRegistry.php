<?php

namespace App\Blocks;

class BlockRegistry
{
    /**
     * @return void
     */
    public static function initialize_blocks(): void
    {
        $directory = resource_path( 'blocks' );
        if ( ! is_dir( $directory ) ) {
            return;
        }

        $block_directory = new \DirectoryIterator( $directory );
        foreach ( $block_directory as $block ) {
            if ( $block->isDir() && ! $block->isDot() ) {
                register_block_type( $block->getRealpath(), [
                    'render_callback' => function ( $args ) {
                        if ( isset( $args['style_handles'] ) ) {
                            AssetsHandler::register_assets( $args['style_handles'] );
                        }

                        $block_factory = new BlockFactory( new BlockBuilder( $args ) );
                        echo $block_factory->create()->render();
                    }
                ] );
            }
        }
    }
}
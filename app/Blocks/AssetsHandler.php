<?php

namespace App\Blocks;

class AssetsHandler
{
    /**
     * @param array $assets
     * @return void
     */
    public static function register_assets( array $assets ): void
    {
        app( 'bundler' )->register_bundles( $assets );
    }
}

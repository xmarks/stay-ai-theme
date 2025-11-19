<?php

namespace App\Traits;

trait BundleRegistrar
{
    /**
     * @param string $bundle
     * @return void
     */
    protected function register_bundle( string $bundle ): void
    {
        app( 'bundler' )->register_bundle( $bundle );
    }
}

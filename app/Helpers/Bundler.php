<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class Bundler
{
    /**
     * @var stdClass
     */
    private \stdClass $entrypoints;

    public function __construct()
    {
        $this->load_entrypoints(); 
    }

    /**
     * Loads the theme bundle entrypoints from the asset manifest.
     *
     * The manifest is a JSON file created by the `build` command in the theme.
     * It contains a mapping of bundle names to their corresponding entrypoints (CSS + JS).
     *
     * @return void
     */
    private function load_entrypoints(): void
    {
        $entrypoints_path = Config::get( 'assets.manifests.theme.bundles', '' );
        if ( ! file_exists( $entrypoints_path ) ) {
            return;
        }

        $this->entrypoints = json_decode( file_get_contents( $entrypoints_path ) );
    }

    /**
     * Registers multiple bundles.
     *
     * Iterates over the provided array of bundle names and registers each one
     * using the register_bundle method.
     *
     * @param array $bandles An array of bundle names to register.
     * @return void
     */
    public function register_bundles( array $bandles ): void
    {
        foreach ( $bandles as $bandle ) {
            $this->register_bundle( $bandle );
        }
    }

    /**
     * Registers a single bundle.
     *
     * Checks if the bundle exists in the asset manifest, and if so, enqueues it
     * using the Roots\bundle() helper.
     *
     * @param string $bandle The bundle name to register.
     * @return void
     */
    public function register_bundle( string $bandle ): void
    {
        if ( ! isset( $this->entrypoints->{$bandle} ) ) {
            return;
        }

        \Roots\bundle( $bandle )->enqueue();
    }
}

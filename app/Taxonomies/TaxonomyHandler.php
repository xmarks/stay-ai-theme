<?php

namespace App\Taxonomies;

use App\Taxonomies\Contracts\Taxonomy;
use Illuminate\Support\Facades\Config;

class TaxonomyHandler
{
    /**
     * @var array
     */
    protected static array $taxonomies;

    /**
     * @return void
     */
    public static function handle(): void
    {
        self::load_taxonomies();

        foreach ( self::$taxonomies as $taxonomy ) {
            self::create_and_init_taxonomy( $taxonomy );
        }
    }

    /**
     * @return void
     */
    protected static function load_taxonomies(): void
    {
        if ( empty( self::$taxonomies ) ) {
            self::$taxonomies = Config::get( 'taxonomies', [] );
        }
    }

    /**
     * @param string $class
     * @return void
     */
    protected static function create_and_init_taxonomy( string $class ): void
    {
        if ( self::is_valid_taxonomy( $class ) ) {
            ( new $class() )->init();
        }
    }

    /**
     * @param string $class
     * @return bool
     */
    protected static function is_valid_taxonomy( string $class ): bool
    {
        return class_exists( $class ) && is_subclass_of( $class, Taxonomy::class );
    }
}

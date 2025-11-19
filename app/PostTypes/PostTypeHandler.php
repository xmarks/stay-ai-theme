<?php

namespace App\PostTypes;

use App\PostTypes\Contracts\PostType;
use Illuminate\Support\Facades\Config;

class PostTypeHandler
{
    /**
     * @var array
     */
    protected static array $post_types;

    /**
     * @return void
     */
    public static function handle(): void
    {
        self::load_post_types();

        foreach ( self::$post_types as $post_type ) {
            self::create_and_init_post_type( $post_type );
        }
    }

    /**
     * @return void
     */
    protected static function load_post_types(): void
    {
        if ( empty( self::$post_types ) ) {
            self::$post_types = Config::get( 'post-types', [] );
        }
    }

    /**
     * @param string $class
     * @return void
     */
    protected static function create_and_init_post_type( string $class ): void
    {
        if ( self::is_valid_post_type( $class ) ) {
            ( new $class() )->init();
        }
    }

    /**
     * @param string $class
     * @return bool
     */
    protected static function is_valid_post_type( string $class ): bool
    {
        return class_exists( $class ) && is_subclass_of( $class, PostType::class );
    }
}

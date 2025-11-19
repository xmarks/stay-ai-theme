<?php

namespace App\Hooks;

use App\Hooks\Contracts\HookCollector;
use Illuminate\Support\Facades\Config;

class HooksHandler
{
    /**
     * @var array
     */
    protected static array $hook_collectors;

    /**
     * @return void
     */
    public static function register_hooks(): void
    {
        self::load_collectors();

        foreach ( self::$hook_collectors as $collector ) {
            self::create_and_init_collector( $collector );
        }
    }

    /**
     * @return void
     */
    protected static function load_collectors(): void
    {
        if ( empty( self::$hook_collectors ) ) {
            self::$hook_collectors = Config::get( 'hooks.collectors', [] );
        }
    }

    /**
     * @param string $class
     * @return void
     */
    protected static function create_and_init_collector( string $class ): void
    {
        if ( self::is_valid_collector( $class ) ) {
            ( new $class() )->collect();
        }
    }

    /**
     * @param string $class
     * @return bool
     */
    protected static function is_valid_collector( string $class ): bool
    {
        return class_exists( $class ) && is_subclass_of( $class, HookCollector::class );
    }
}
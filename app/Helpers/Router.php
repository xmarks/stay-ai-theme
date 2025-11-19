<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class Router
{
    private const METHODS = [
        Request::METHOD_GET,
        Request::METHOD_POST,
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    /**
     * @return array
     */
    public static function get_api_routes(): array
    {
        $api_routes = [];
        foreach ( Route::getRoutes()->getRoutesByMethod() as $method => $routes ) {
            if ( ! in_array( $method, self::METHODS ) ) {
                continue;
            }

            $result = [];
            foreach ( $routes as $route ) {
                if ( $route->getPrefix() && str_starts_with( $route->getPrefix(), 'api' ) ) {
                    $path = explode( '.', $route->getName() );
                    $temp = &$result;

                    foreach ( $path as $key => $part ) {
                        $temp[$part] = $temp[$part] ?? ( $key === array_key_last( $path ) ? route( $route->getName() ) : [] );
                        $temp = &$temp[$part];
                    }
                }
            }

            if ( ! empty( $result ) ) {
                $api_routes[strtolower( $method )] = $result;
            }
        }

        return $api_routes;
    }
}
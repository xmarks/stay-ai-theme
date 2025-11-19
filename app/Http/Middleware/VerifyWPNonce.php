<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

class VerifyWPNonce
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle( Request $request, Closure $next ): mixed
    {
        if ( $this->verify_nonce( $request ) ) {
            return $next($request);
        }

        throw new TokenMismatchException( 'WP nonce mismatch.' );
    }

    /**
     * Verify the nonce from the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function verify_nonce( Request $request ): bool
    {
        $nonce = $this->get_wp_nonce_from_request( $request );

        return wp_verify_nonce( $nonce, 'wp_nonce' );
    }

    /**
     * Get the nonce from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function get_wp_nonce_from_request( Request $request ): ?string
    {
        return $request->input( 'nonce' ) ?: $request->header( 'X-WP-Nonce' );
    }
}

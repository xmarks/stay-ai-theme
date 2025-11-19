<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ArrayOrInteger implements ValidationRule
{
    private const MESSAGE = 'The :attribute must be an integer or an array of integers.';

    /**
     * @inheritDoc
     */
    public function validate( string $attribute, mixed $value, Closure $fail ): void
    {
        if ( ctype_digit( $value ) ) {
            return;
        }

        if ( ! is_array( $value ) ) {
            $fail( self::MESSAGE );
        }

        if ( is_array( $value ) ) {
            foreach ( $value as $item ) {
                if ( ! ctype_digit( $item ) ) {
                    $fail( self::MESSAGE );
                }
            }
        }
    }
}

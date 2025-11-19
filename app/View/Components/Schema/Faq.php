<?php

namespace App\View\Components\Schema;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Faq extends Component
{
    public array $faq_schema;

    public function __construct( array $faq )
    {
        $this->faq_schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $this->build_schema( $faq ),
        ];
    }

    private function build_schema( array $faq ): array
    {
        return collect( $faq )
            ->filter( function ( $item ) {
                return is_array( $item )
                    && isset( $item['question'], $item['answer'] )
                    && Str::of( $item['question'] )->trim()->isNotEmpty()
                    && Str::of( $item['answer'] )->trim()->isNotEmpty();
            } )
            ->map( function ( $item ) {
                return [
                    '@type' => 'Question',
                    'name' => strip_tags( trim( $item['question'] ) ),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => strip_tags( trim( $item['answer'] ) ),
                    ],
                ];
            } )
            ->values()
            ->toArray();
    }

    public function render()
    {
        return $this->view( 'components.schema.faq' );
    }
}

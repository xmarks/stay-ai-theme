<?php

namespace App\View\Composers\Partials;

use App\DTO\FeaturedPostDTO;
use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * @inheritDoc
     */
    protected static $views = [
        'partials.content-post',
        'partials.post.related-post',
    ];

    /**
     * @inheritDoc
     */
    public function override()
    {
        global $post;

        if ( ! $post ) {
            return [];
        }

        return ( new FeaturedPostDTO( $post ) )->toArray();
    }
}

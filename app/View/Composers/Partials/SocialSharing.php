<?php

namespace App\View\Composers\Partials;

use Roots\Acorn\View\Composer;

class SocialSharing extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.social-sharing',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        global $post;
        return [
            'link' => get_permalink(),
            'text' => $post->post_title,
        ];
    }
}

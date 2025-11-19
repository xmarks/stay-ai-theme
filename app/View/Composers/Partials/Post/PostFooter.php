<?php

namespace App\View\Composers\Partials\Post;

use Roots\Acorn\View\Composer;

class PostFooter extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'partials.post.post-footer',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        $posts_page = get_option( 'page_for_posts' );

        return [
            'archive_link' => get_permalink( $posts_page ),
        ];
    }
}

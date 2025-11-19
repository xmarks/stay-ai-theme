<?php

namespace App\View\Composers\Partials;

use App\DTO\ResourceDTO;
use App\Helpers\App;
use App\Taxonomies\Types\ResourceCategory;
use Roots\Acorn\View\Composer;

class Resource extends Composer
{
    /**
     * @inheritDoc
     */
    protected static $views = [
        'partials.content-app_resource',
    ];

    /**
     * @inheritDoc
     */
    public function override()
    {
        global $post;
        $post_id = $post->ID;

        return [
            'resource' => ( new ResourceDTO(
                $post->post_title,
                get_permalink( $post_id ),
                get_post_thumbnail_id( $post_id ) ?: null,
                App::get_term( $post_id, ResourceCategory::get_taxonomy_key() )
            ) )->toArray()
        ];
    }
}

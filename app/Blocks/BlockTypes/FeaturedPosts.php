<?php

namespace App\Blocks\BlockTypes;

use App\DTO\FeaturedPostDTO;
use App\PostTypes\Types\Resource;
use App\Taxonomies\Types\ResourceCategory;

class FeaturedPosts extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_posts_data();
    }

    /**
     * @return void
     */
    private function prepare_posts_data(): void
    {
        if ( $this->data['display_mode'] === 'specific' ) {
            $this->prepare_posts();
        } else {
            match ( $this->data['post_type'] ) {
                'post' => $this->prepare_latest_posts(),
                'resource' => $this->prepare_latest_resources(),
            };
        }
    }

    /**
     * @return void
     */
    private function prepare_posts(): void
    {
        if ( empty( $this->data['posts'] ) ) {
            return;
        }

        $this->data['posts'] = array_map(
            static fn ( $post ) => ( new FeaturedPostDTO( $post ) )->toArray(),
            $this->data['posts']
        );
    }

    /**
     * @return void
     */
    private function prepare_latest_posts(): void
    {
        $this->data['posts'] = get_posts( [
            'numberposts' => $this->data['count_posts'],
            'post_type' => 'post',
        ] );
        $this->prepare_posts();
    }

    /**
     * @return void
     */
    private function prepare_latest_resources(): void
    {
        $args = [
            'numberposts' => $this->data['count_posts'],
            'post_type' => Resource::get_post_type_key(),
        ];

        if ( ! empty( $this->data['categories'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => ResourceCategory::get_taxonomy_key(),
                    'field' => 'term_id',
                    'terms' => $this->data['categories'],
                ]
            ];
        }

        $this->data['posts'] = get_posts( $args );
        $this->prepare_posts();
    }
}

<?php

namespace App\View\Composers\Partials;

use App\Helpers\ACF;
use App\Traits\BundleRegistrar;
use Carbon\Carbon;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class SinglePost extends Composer
{
    use BundleRegistrar;

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single-post',
    ];

    /**
     * @var string
     */
    protected string $bundle = 'blog-article-page';

    /**
     * @inheritDoc
     */
    public function compose( View $view ): void
    {
        $this->register_bundle( $this->bundle );
        parent::compose( $view );
    }

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        global $post;
        $post_id = $post->ID;

        return array_merge( $this->get_fields( $post_id ), [
            'post_date' => Carbon::parse( $post->post_date ),
        ] );
    }

    /**
     * @param int $post_id
     * @return array
     */
    protected function get_fields( int $post_id ): array
    {
        $data = ACF::get_fields( $post_id ) ?: [];

        if ( $data ) {
            $data = $this->update_cta_properties( $data );
            $data = $this->update_linked_blogs( $data, $post_id );
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function update_cta_properties( array $data ): array
    {
        $data['cta'] = $data['cta'] ?? ['use_global_settings' => true];

        return $data;
    }


    /**
     * @param array $data
     * @return array
     */
    protected function update_linked_blogs( array $data, string $post_id ): array
    {
        $posts = [];

        if ( ! empty( $data['linked_blogs'] ) ) {
            $posts = $data['linked_blogs'];
        } else {
            $categories = wp_get_post_categories( $post_id, ['fields' => 'ids'] );
            $posts = get_posts( [
                'post_type' => 'post',
                'posts_per_page' => 1,
                'cat' => $categories,
                'post__not_in' => [$post_id],
                'orderby' => 'date',
                'order' => 'DESC',
            ] );
        }

        $data['linked_blogs'] = [
            'posts' => $posts,
        ];

        return $data;
    }
}

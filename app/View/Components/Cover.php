<?php

namespace App\View\Components;

use App\Helpers\ACF;
use App\Traits\BundleRegistrar;
use Roots\Acorn\View\Component;

class Cover extends Component
{
    use BundleRegistrar;

    /**
     * @var int
     */
    private int $total_covers = 10;

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    public string $title = '';

    /**
     * @var string
     */
    public string $url = '';

    /**
     * @var string
     */
    protected string $bundle = 'cover';

    /**
     * @var integer|null
     */
    public int|null $thumbnail_id = null;

    /**
     * @var boolean
     */
    public bool $use_post_image = true;

    /**
     * @param mixed $post
     */
    public function __construct(
        public mixed $post,
    ) {
        if ( ! $this->post instanceof \WP_Post ) {
            $this->post = get_post( $this->post );
        }

        $this->set_use_post_image();

        if ( $this->use_post_image ) {
            $this->thumbnail_id = get_post_thumbnail_id( $this->post );
            return;
        }

        $this->id = ( crc32( $this->post->ID ) % $this->total_covers ) + 1;
        $this->title = $this->post->post_title;
        $this->url = asset('images/static/post-covers/cover-' . $this->id . '.webp');
        $this->register_bundle( $this->bundle );
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        return $this->view( 'components.cover' );
    }

    /**
     * @return void
     */
    protected function set_use_post_image(): void
    {
        if ( $this->post->post_type === 'post' ) {
            $cover_enabled = ACF::get_field( 'cover_enabled', $this->post );
            $this->use_post_image = $cover_enabled === false;
        }
    }
}

<?php

namespace App\View\Composers\Partials;

use App\Helpers\ACF;
use App\Traits\BundleRegistrar;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class SingleCaseStudy extends Composer
{
    use BundleRegistrar;

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single-app_case_study',
    ];

    /**
     * @var string
     */
    protected string $bundle = 'case-study-article-page';

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

        return $this->get_fields( $post_id );
    }

    /**
     * @param int $post_id
     * @return array
     */
    protected function get_fields( int $post_id ): array
    {
        return ACF::get_fields( $post_id ) ?: [];
    }
}

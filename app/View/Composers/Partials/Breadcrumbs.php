<?php

namespace App\View\Composers\Partials;

use App\Services\Breadcrumbs\BreadcrumbsService;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class Breadcrumbs extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'partials.breadcrumbs',
    ];

    public function __construct(
        protected readonly BreadcrumbsService $breadcrumbs_service
    ) {
    }

    /**
     * Compose the view before rendering.
     *
     * @param View $view
     * @return void
     */
    public function compose( View $view ): void
    {
        parent::compose( $view );
    }

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'links' => $this->breadcrumbs_service->get_links(),
            'trim_last' => is_singular( 'post' )
        ];
    }
}

<?php

namespace App\View\Composers;

use App\Helpers\ACF;
use App\Traits\BundleRegistrar;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class ErrorPage extends Composer
{
    use BundleRegistrar;

    /**
     * @inheritDoc
     */
    protected static $views = [
        '404',
    ];

    /**
     * @var string
     */
    protected string $bundle = 'error-page';

    /**
     * @inheritDoc
     */
    public function compose( View $view ): void
    {
        $this->register_bundle( $this->bundle );
        parent::compose( $view );
    }

    /**
     * @inheritDoc
     */
    public function with(): array
    {
        return ACF::get_field( 'error_page', 'option' ) ?? [];
    }
}

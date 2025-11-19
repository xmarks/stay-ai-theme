<?php

namespace App\View\Composers;

use App\Helpers\{ACF, App};
use App\Traits\BundleRegistrar;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class Home extends Composer
{
    use BundleRegistrar;

    /**
     * @inheritDoc
     */
    protected static $views = [
        'home',
    ];

    /**
     * @var string
     */
    protected string $bundle = 'blog-articles';

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
    public function override()
    {
        return [
            'categories' => $this->get_categories(),
            'load_more' => $this->get_load_more_settings(),
        ];
    }

    /**
     * @return array<int, \WP_Term>|null
     */
    private function get_categories(): ?array
    {
        return [
            'list' => App::get_terms( [
                'taxonomy'   => 'category',
                'hide_empty' => true,
            ] ),
            'active' => $_GET['category'] ?? null,
        ];
    }

    /**
     * @return array<int, mixed>|null
     */
    private function get_load_more_settings(): ?array
    {
        $settings = ACF::get_field( 'blog_settings', 'option' );
        return $settings && ! empty( $settings['load_more'] )
            ? $settings['load_more']
            : null;
    }
}

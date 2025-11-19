<?php

namespace App\View\Composers;

use App\Helpers\{ACF, App};
use App\PostTypes\Types\Resource;
use App\Taxonomies\Types\ResourceCategory;
use App\Traits\BundleRegistrar;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class ArchiveResource extends Composer
{
    use BundleRegistrar;

    /**
     * @inheritDoc
     */
    protected static $views = [
        'archive-app_resource',
    ];

    /**
     * @var string
     */
    protected string $bundle = 'offered-articles';

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
     * Returns a list of categories in the 'Resource Category' taxonomy.
     *
     * @return array<int, \WP_Term>|null
     */
    private function get_categories(): ?array
    {
        return [
            'list' => App::get_terms( [
                'taxonomy'   => ResourceCategory::get_taxonomy_key(),
                'hide_empty' => false,
            ] ),
            'active' => $_GET['category'] ?? null,
        ];
    }

    /**
     * @return array<int, mixed>|null
     */
    private function get_load_more_settings(): ?array
    {
        $settings = ACF::get_field( Resource::get_post_type_key() . '_settings', 'option' );
        return $settings && ! empty( $settings['load_more'] )
            ? $settings['load_more']
            : null;
    }
}

<?php

namespace App\View\Composers;

use App\Helpers\{ACF, App};
use App\PostTypes\Types\CaseStudy;
use App\Taxonomies\Types\CaseStudyTag;
use App\Traits\BundleRegistrar;
use Illuminate\View\View;
use Roots\Acorn\View\Composer;

class ArchiveCaseStudy extends Composer
{
    use BundleRegistrar;

    /**
     * @inheritDoc
     */
    protected static $views = [
        'archive-app_case_study',
    ];

    /**
     * @var string
     */
    protected string $bundle = 'case-study-articles';

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
     * Returns a list of categories in the 'Case Study Tag' taxonomy.
     *
     * @return array<int, \WP_Term>|null
     */
    private function get_categories(): ?array
    {
        return [
            'list' => App::get_terms( [
                'taxonomy'   => CaseStudyTag::get_taxonomy_key(),
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
        $settings = ACF::get_field( CaseStudy::get_post_type_key() . '_settings', 'option' );
        return $settings && ! empty( $settings['load_more'] )
            ? $settings['load_more']
            : null;
    }
}

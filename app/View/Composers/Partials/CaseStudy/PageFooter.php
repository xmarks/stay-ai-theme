<?php

namespace App\View\Composers\Partials\CaseStudy;

use App\Helpers\CaseStudy;
use Roots\Acorn\View\Composer;

class PageFooter extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'partials.case-study.page-footer',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        $case_studies_page = CaseStudy::get_main_page();
        return [
            'archive_link' => $case_studies_page ? get_permalink( $case_studies_page ) : '',
        ];
    }
}

<?php

namespace App\View\Composers\Partials;

use App\DTO\CaseStudyDTO;
use Roots\Acorn\View\Composer;

class CaseStudy extends Composer
{
    /**
     * @inheritDoc
     */
    protected static $views = [
        'partials.content-app_case_study',
        'partials.case-study.related-card',
    ];

    /**
     * @inheritDoc
     */
    public function override()
    {
        global $post;

        if ( ! $post ) {
            return [];
        }

        return ( new CaseStudyDTO( $post ) )->toArray();
    }
}

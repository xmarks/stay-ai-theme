<?php

namespace App\Enums;

use App\PostTypes\Types\{Author, CaseStudy};

enum PostType
{
    case POST;
    case AUTHOR;
    case CASE_STUDY;

    /**
     * @param string $post_type
     * @return \App\Enums\PostType|null
     */
    public static function try_from_post_type( string $post_type ): ?PostType
    {
        return match ( $post_type ) {
            'post' => self::POST,
            Author::get_post_type_key() => self::AUTHOR,
            CaseStudy::get_post_type_key() => self::CASE_STUDY,
            default => null
        };
    }
}

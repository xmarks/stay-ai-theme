<?php

namespace App\Services\Breadcrumbs;

use App\Enums\PostType;

class PostTypeResolver
{
    /**
     * @return \App\Enums\PostType
     * @throws \Exception
     */
    public function resolve(): PostType|null
    {
        $post_type = $this->define_post_type();

        if ( ! $post_type ) {
            throw new \Exception( 'Unable to resolve the type of the post' );
        }

        return $post_type;
    }

    /**
     * @return \App\Enums\PostType|null
     */
    private function define_post_type(): PostType|null
    {
        $post_type = get_query_var( 'post_type' );
        if ( is_array( $post_type ) ) {
            $post_type = reset( $post_type );
        }
        
        if ( ! $post_type ) {
            global $post;
            $post_type = $post->post_type;
        }

        $post_type = PostType::try_from_post_type( $post_type );
        if ( ! $post_type ) {
            return null;
        }

        return $post_type;
    }
}
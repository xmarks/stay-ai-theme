<?php

namespace App\DTO;

use App\Helpers\CaseStudy as CaseStudyHelper;
use Illuminate\Contracts\Support\Arrayable;

final class CaseStudyDTO implements Arrayable
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var integer
     */
    public int $thumbnail_id;

    /**
     * @var string
     */
    public string $link;

    /**
     * @var array
     */
    public array $categories;

    /**
     * @param int|\WP_Post $post
     *
     * @throws \Exception
     */
    public function __construct( private int|\WP_Post $post )
    {
        if ( is_int( $post ) ) {
            $post = get_post( $post );
        }

        if ( ! $post ) {
            throw new \Exception( 'Post not found' );
        }

        $this->title = $post->post_title;
        $this->thumbnail_id = get_post_thumbnail_id( $post );
        $this->link = get_the_permalink( $post );
        $this->categories = CaseStudyHelper::get_categories( $post ) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'thumbnail_id' => $this->thumbnail_id,
            'link' => $this->link,
            'categories' => $this->categories
        ];
    }
}

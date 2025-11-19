<?php

namespace App\DTO;

use App\PostTypes\Types\Resource;
use App\Taxonomies\Types\ResourceCategory;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

final class FeaturedPostDTO implements Arrayable
{
    /**
     * @var integer
     */
    public readonly int $id;

    /**
     * @var string
     */
    public readonly string $title;

    /**
     * @var integer
     */
    public readonly int $thumbnail_id;

    /**
     * @var string
     */
    public readonly string $link;

    /**
     * @var string
     */
    public readonly string $tag;

    /**
     * @var \Carbon\Carbon
     */
    public readonly Carbon $date;

    /**
     * @var string
     */
    public readonly string $excerpt;

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

        $this->id = $post->ID;
        $this->title = $post->post_title;
        $this->thumbnail_id = get_post_thumbnail_id( $post );
        $this->link = get_the_permalink( $post );
        $this->tag = $this->get_tag();
        $this->date = Carbon::parse( $post->post_date );
        $this->excerpt = $post->post_excerpt;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'thumbnail_id' => $this->thumbnail_id,
            'link' => $this->link,
            'tag' => $this->tag,
            'date' => $this->date,
            'excerpt' => $this->excerpt,
        ];
    }

    /**
     * @return string
     */
    private function get_tag(): string
    {
        $post_id = $this->post->ID;
        $post_type = $this->post->post_type;

        if ( $post_type === 'post' ) {
            $reading_time = get_post_meta( $post_id, 'reading_time', true );
            return $reading_time
                ? $reading_time . __( ' min read', 'sage' )
                : '';
        }

        if( $post_type === Resource::get_post_type_key() ) {
            return (string) wp_get_object_terms( $post_id, ResourceCategory::get_taxonomy_key(), [ 'fields' => 'names' ] )[0] ?? '';
        }

        return '';
    }
}

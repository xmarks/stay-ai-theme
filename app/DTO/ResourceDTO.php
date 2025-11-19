<?php

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;

final class ResourceDTO implements Arrayable
{

    public function __construct(
        public string     $title,
        public string     $link,
        public ?int       $attachment_id = null,
        public ?\WP_Term  $category = null
    ) {}

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'link' => $this->link,
            'attachment_id' => $this->attachment_id,
            'category' => $this->category
        ];
    }
}

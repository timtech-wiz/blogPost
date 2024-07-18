<?php

namespace App\DataTransferObjects;

class BlogData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?string $image=null
    )
    {}
}

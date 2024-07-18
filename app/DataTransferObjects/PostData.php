<?php

namespace App\DataTransferObjects;

use App\Http\Requests\UpsertPostRequest;
use App\Models\Blog;

class PostData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $body,
        public readonly Blog $blog,
        public readonly ?string $image=null
    )
    {}

    public static function fromRequest(UpsertPostRequest $request):self
    {
        return new self(
            $request->name,
            $request->body,
            $request->getBlog(),
            $request->image
        );
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            "name" => $this->name,
            "body" => $this->body,
            'blog' => BlogResource::make($this->whenLoaded('blog')),
            "image" => $this?->image
        ];
    }
}

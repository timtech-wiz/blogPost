<?php

namespace App\Actions;

use App\DataTransferObjects\PostData;
use App\Models\Post;
use Illuminate\Support\Str;


class UpsertPostAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function execute(PostData $postData, Post $post):Post
    {
        $post->name = $postData->name;
        $post->body = $postData->body;
        $post->blog_id = $postData->blog->id;
        $post->image = $postData->image;
        $post->slug = Str::slug($postData->name);   
        $post->save();

        return $post;
    }
}

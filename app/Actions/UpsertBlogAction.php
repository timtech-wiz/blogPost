<?php

namespace App\Actions;

use App\DataTransferObjects\BlogData;
use App\Models\Blog;
use Illuminate\Support\Str;

class UpsertBlogAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function execute(BlogData $blogData, Blog $blog):Blog
    {
        $blog->title = $blogData->title;
        $blog->content = $blogData->content;
        $blog->image = $blogData->image;
        $blog->slug = Str::slug($blogData->title);   
        $blog->save();

        return $blog;
    }
}

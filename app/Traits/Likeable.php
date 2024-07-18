<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\Post;

trait Likeable
{
     

    public function like(Post $post)
    {
         // Check if the user has already liked the post
    //if ($post->likes()->where('user_id', auth()->id())->exists()) {
        //return response()->json(['message' => 'You have already liked this post'], 422);
      //  return;
    //}
    // Create a new like for the post
    $post->likes()->create();

    //return response()->json(['message' => 'Post liked successfully'], 201);

    }
}

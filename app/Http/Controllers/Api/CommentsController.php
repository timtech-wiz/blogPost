<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->content = $request->content;
        $comment->save();
    
        return response()->json(['message' => 'Comment added successfully'], 201);
    
    }
}

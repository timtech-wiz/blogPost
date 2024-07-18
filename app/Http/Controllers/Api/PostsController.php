<?php

namespace App\Http\Controllers\Api;

 
use App\Actions\UpsertPostAction;
use App\DataTransferObjects\PostData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertPostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct(public readonly UpsertPostAction $upsertPostAction)
     {
        
     }
    public function index():AnonymousResourceCollection
    {
         return PostResource::collection(Post::with('blog')->cursorPaginate(50));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertPostRequest $request)
    {
        return PostResource::make($this->upsert($request, new Post()))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post->load('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertPostRequest $request, Post $post)
    {
        $this->upsert($request, $post);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(['status' => 'Post deleted successfully']);
    }

    private function upsert(
        UpsertPostRequest $request,
        Post $post
    ):Post
    {
        $postData = PostData::fromRequest($request);
        return $this->upsertPostAction->execute($postData, $post);
    }


    // public function like(Post $post)
    // {
    //     $post->like();
    //     return response()->json(['message' => 'Post liked successfully'], 201);
    // }

}

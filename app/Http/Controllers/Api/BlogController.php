<?php

namespace App\Http\Controllers\Api;

use App\Actions\UpsertBlogAction;
use App\DataTransferObjects\BlogData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct(public readonly UpsertBlogAction $upsertBlogAction)
     {
        
     }
    public function index():AnonymousResourceCollection
    {
         return BlogResource::collection(Blog::cursorPaginate(50));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertBlogRequest $request)
    {
        return BlogResource::make($this->upsert($request, new Blog()))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return BlogResource::make($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertBlogRequest $request, Blog $blog)
    {
        $this->upsert($request, $blog);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response(['status' => 'Blog deleted successfully']);
    }

    private function upsert(
        UpsertBlogRequest $request,
        Blog $blog
    ):Blog
    {
        $blogData = new BlogData(...$request->validated());
        return $this->upsertBlogAction->execute($blogData, $blog);
    }
}

<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('token')->group(function(){
    Route::apiResource('blog', BlogController::class);
    Route::apiResource('post', PostsController::class);
    Route::post('/posts/{post}/like', LikeController::class);
    Route::post('/posts/{post}/comment', CommentsController::class);
});



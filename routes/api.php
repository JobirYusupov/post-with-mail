<?php

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts/{post}', function (Post $post){
    return new PostResource($post);
});

Route::get('/posts', function (){
    return new PostCollection(Post::all());
});

Route::delete('/posts/{post}', function (Post $post){
    $post->delete();
    return "Post deleted";
});

Route::post('/posts/create', function (Request $request){
    $post = Post::create($request->all());
    return "http://blog.test/api/posts/" .$post->id;
});
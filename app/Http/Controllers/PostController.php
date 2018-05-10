<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->simplePaginate(3);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', ['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|unique:posts|max:255',
            'body'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        $path = $request->file('image')->store('/images/posts', 'public');
        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path,
            'user_id'=>\Auth::user()->id,
            'category_id'=>$request->category_id
        ]);
        return view('posts.index', ['posts'=>Post::latest()->simplePaginate(3)])->with(['message'=>'Post created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post'=>$post, 'categories'=>Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>[
                'required',
                Rule::unique('posts')->ignore($post->id),
                'max:255'
            ],
            'body'=>'required',
            'image'=>'max:2048|mimes:jpg,jpeg,png'
        ]);
        if ($request->hasFile('image'))
        {
            Storage::disk('public')->delete($post->image);
            $path = $request->image->store('images/posts', 'public');
        }else{
            $path = $post->image;
        }
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path,
            'category_id'=>$request->category_id,
        ]);
        return redirect()->route('posts.index')->with('Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function showByCategory(Category $category)
    {

    }
    public function showByTag(Tag $tag)
    {
        return view('posts.index', ['posts' => $tag->posts()->simplePaginate(3)]);
    }
}

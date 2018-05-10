<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|unique:categories|max:255',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);
        $path = $request->image->store('images/categories', 'public');
        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'image' => $path,
        ]);
        return redirect()->route('categories.index')->with('message', "Category created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('posts.index', ['posts' => $category->posts()->simplePaginate(3)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
                ],
            'image' => 'mimes:jpeg,jpg,png|max:2048',
        ]);
        if ($request->hasFile('image')){
            Storage::disk('public')->delete($category->image);
            $path = $request->image->store('images/categories', 'public');
        } else {
            $path = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'image' => $path,
        ]);
        return redirect()->route('categories.index')->with('message', "Category created");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}

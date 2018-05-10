@extends('layouts.app')
@section('title', 'Post Edit')
@section('content')
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-6 mx-auto my-3 p-4 border-info border">
                <h1 class="text-center mb-3 border-bottom border-info">Post Create</h1>
                <form action="{{ route('posts.update', ['post'=>$post]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category_id">Choose category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ($category->id == $post->category_id ? "selected":"") }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $post->title) }}">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" rows="5" class="form-control" required>{{ old('body', $post->body) }}</textarea>
                    </div>
                    <div>
                        <label for="image">Photo</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary float-right mt-2" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
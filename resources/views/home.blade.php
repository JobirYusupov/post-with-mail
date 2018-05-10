@extends('layouts.app')
@section('title', "Home")
@section('content')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Page Heading
                    <small>Secondary Text</small>
                </h1>

                @foreach($posts as $post)
                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{{ str_limit($post->body, 100) }}</p>
                            <a href="{{ route('posts.show', [$post]) }}" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ date_format($post->created_at, "F j, Y") }} by
                            <a href="#">{{ $post->user->name }}</a>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                {{ $posts->links() }}

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                @include('includes.sidebar')

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

@endsection

@extends('layouts.app')
@section('title', "Categories")
@section('content')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Categories Column -->
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h1 class="my-4">Categories</h1>

            @foreach($categories as $category)
                <!-- Blog Category -->
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset('storage/' . $category->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{ $category->name }}</h2>
                        </div>
                        <div class="card-footer text-muted">
                            Created on {{ date_format($category->created_at, "F j, Y") }} by
                            <a href="#">{{ $category->user->name }}</a>
                        </div>
                    </div>
            @endforeach

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

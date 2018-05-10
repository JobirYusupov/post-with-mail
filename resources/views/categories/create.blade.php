@extends('layouts.app')
@section('title', "Categories")
@section('content')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Categories Column -->
            <div class="col-md-8">

                <h1 class="my-4">Create category</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <input type="submit" value="Create" class="btn btn-primary">
                </form>

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

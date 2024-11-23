@extends('layouts.main')
@section('title', 'Category Edit')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/category') }}" class="text-decoration-none">Category List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <p class="fs-3">Form Edit Category</p>
    <form action="/category/{{ $category->id }}" method="post">
        @method('patch')
        @csrf
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="category_code" class="form-label text-white">Category Code</label>
                    <input type="text" class="form-control" name="category_code" id="category_code"
                        value="{{ $category->category_code }}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

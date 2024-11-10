@extends('layouts.main')
@section('title', 'Category Create')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/category') }}" class="text-decoration-none">Category List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <p class="fs-3">Category Form Input </p>
    <form action="{{ url('/category') }}" method="post">
        @csrf
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="category_code" class="form-label text-white">Category Code</label>
                    <input type="text" class="form-control" name="category_code" id="category_code"
                        placeholder="EX : C001">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="EX : Perkakas">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

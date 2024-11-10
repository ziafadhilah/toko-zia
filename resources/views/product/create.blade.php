@extends('layouts.main')
@section('title', 'Product Create')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/product') }}" class="text-decoration-none">Product List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <p class="fs-3">Product Form Input</p>
    <form action="{{ url('/product') }}" method="post">
        @csrf
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="category_id" class="form-label text-white">Category</label>
                    <select class="form-select form-select-md" aria-label=".form-select-md example" name="category_id">
                        <option selected class="text-center">-- Choose Category --</option>
                        @foreach ($getProductCategory as $gp)
                            <option value="{{ $gp->id }}">{{ $gp->name ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="EX : Iphone XXR">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label text-white">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="EX : 50">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

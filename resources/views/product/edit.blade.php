@extends('layouts.main')
@section('title', 'Product Edit')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/product') }}" class="text-decoration-none">Product List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <p class="fs-3">Form Edit Product</p>
    <form action="/product/{{ $product->id }}" method="post">
        @method('patch')
        @csrf
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="category_id" class="form-label text-white">Category</label>
                    <select class="form-select form-select-md" aria-label=".form-select-md example" name="category_id">
                        @foreach ($productCategories as $productCategory)
                            <option class="text-center"
                                {{ $product->productCategory->id == $productCategory->id ? 'selected' : '' }}
                                value="{{ $productCategory->id }}">
                                {{ $productCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label text-white">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" value="{{ $product->stock }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label text-white">Price</label>
                    <input type="number" class="form-control" name="price" id="price"
                        value="{{ $product->productPrices->price }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

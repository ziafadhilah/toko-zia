@extends('layouts.main')
@section('title', 'Price List')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('thumbnail') }}" class="text-decoration-none">Price List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <p class="fs-3">Price Form Input</p>
    <form action="{{ url('price') }}" method="post">
        @csrf
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="product_id" class="form-label text-white">Product</label>
                    <select class="form-select form-select-md" aria-label=".form-select-md example" name="product_id">
                        <option selected class="text-center">-- Choose Product --</option>
                        @foreach ($getProduct as $data)
                            <option value="{{ $data->id }}">{{ $data->name ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label text-white">Price</label>
                    <input type="number" name="price" class="form-control" id="price">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

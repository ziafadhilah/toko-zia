@extends('layouts.main')
@section('title', 'Edit Price')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('price') }}" class="text-decoration-none">Price List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <p class="fs-3">Edit Price Form</p>
    <form action="/price/{{ $price->id }}" method="post">
        @method('patch')
        @csrf
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="product_id" class="form-label text-white">Product Name</label>
                    <select class="form-select form-select-md" name="product_id">
                        @foreach ($getProduct as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $price->product_id ? 'selected' : '' }}>
                                {{ $data->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label text-white">Price</label>
                    <input type="number" name="price" class="form-control" id="price" value="{{ $price->price }}"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

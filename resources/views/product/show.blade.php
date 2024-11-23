@extends('layouts.main')
@section('title', 'Product Detail')
@section('content')
    <p class="fs-3">Product Detail</p>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/product') }}" class="text-decoration-none">Product List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    <hr>
    <div class="card mb-3 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card-header">
            <a href="{{ url('/product') }}" class="text-decoration-none"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div class="row g-0 mb-5">
            <div class="col-md-4">
                @if ($product->productThumbnail && $product->productThumbnail->thumbnail)
                    <img src="{{ asset('storage/' . $product->productThumbnail->thumbnail) }}"
                        class="img-fluid rounded-start" alt="{{ $product->name }}">
                @else
                    <img src="#" alt="No Images" class="img-fluid p-5 m-5 px-5 py-5">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title text-uppercase mb-4">{{ $product->name }}</h4>
                    <p class="card-text">Category: {{ $product->productCategory->name }}</p>
                    <p class="card-text">Stock : {{ $product->stock }}</p>
                    <p class="card-text">Price: Rp. {{ number_format($product->productPrices->price, 2, ',', '.') }}</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated {{ $product->updated_at }}</small>
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection

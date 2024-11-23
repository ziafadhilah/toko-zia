@extends('layouts.main')
@section('title', 'Thumbnail Edit')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('thumbnail') }}" class="text-decoration-none">Thumbnail List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <p class="fs-3">Form Edit Thumbnail</p>
    <form action="{{ url('/thumbnail/' . $thumbnail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card bg-dark col-lg-8 col-md-8">
            <div class="card-body">
                <div class="mb-3">
                    <label for="product_id" class="form-label text-white">Product</label>
                    <select class="form-select form-select-md" name="product_id">
                        <option class="text-center">-- Choose Product --</option>
                        @foreach ($product as $data)
                            <option value="{{ $data->id }}" {{ $thumbnail->product_id == $data->id ? 'selected' : '' }}>
                                {{ $data->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="thumbnail_code" class="form-label text-white">Thumbnail Code</label>
                    <input type="text" class="form-control" name="thumbnail_code" id="thumbnail_code"
                        value="{{ $thumbnail->thumbnail_code }}" placeholder="EX : TH01">
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label text-white">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control mb-2" id="thumbnail">
                    @if ($thumbnail->thumbnail)
                        <img src="{{ asset('storage/' . $thumbnail->thumbnail) }}" alt="Thumbnail" width="100"
                            class="mt-2">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

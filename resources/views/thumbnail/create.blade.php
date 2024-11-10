@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('thumbnail') }}" class="text-decoration-none">Thumbnail List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <p class="fs-3">Thumbnail Form Input </p>
    <form action="{{ url('/thumbnail') }}" method="post" enctype="multipart/form-data">
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
                    <label for="thumbnail_code" class="form-label text-white">Thumbnail Code</label>
                    <input type="text" class="form-control" name="thumbnail_code" id="thumbnail_code"
                        placeholder="EX : TH01">
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label text-white">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

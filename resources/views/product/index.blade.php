@extends('layouts.main')
@section('title', 'Product List')
@section('content')
    <p class="fs-3">Product List</p>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Product List</li>
        </ol>
    </nav>
    <hr>
    <a href="{{ url('product/create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create</a>
    <table class="table table-striped mt-3" border="1" id="product-table">
        <thead>
            <tr>
                <th scope="col" class="text-center" width="25">No</th>
                <th scope="col">Thumbnail</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Product Name</th>
                <th scope="col" class="text-center">Stock</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $data)
                <tr>
                    <th class="text-center">{{ $loop->iteration }}</th>
                    <td>
                        <img src="{{ optional($data->productThumbnail)->thumbnail ? asset('storage/' . $data->productThumbnail->thumbnail) : asset('images/placeholder.jpg') }}"
                            alt="No Images" class="w-25">
                    </td>
                    <td class="text-center">{{ $data->productCategory->name ?? 'Tidak ada Kategori' }}</td>
                    <td class="text-center">{{ $data->name ?? 'Tidak ada data' }}</td>
                    <td class="text-center">{{ $data->stock ?? 'Tidak ada data' }}</td>
                    <td class="text-center">
                        <div class="mb-3 input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control" disabled
                                value="{{ optional($data->productPrices)->price ? number_format($data->productPrices->price, 2, ',', '.') : 'Tidak ada data' }}">
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="/product/edit/{{ $data->id }}" class="btn btn-outline-warning btn-sm"><i
                                class="fas fa-pencil"></i></a>
                        <a href="/product/show/{{ $data->id }}" class="btn btn-outline-primary btn-sm"><i
                                class="fas fa-eye"></i></a>
                        <form action="/product/{{ $data->id }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                onclick="return confirm('Are you sure want to delete this product?')"><i
                                    class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('pagescript')
    <script>
        $(document).ready(function() {
            $('#product-table').DataTable({
                // paging: false,
                bInfo: false,
                lengthChange: false
            });
        });
    </script>
@endsection

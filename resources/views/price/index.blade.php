@extends('layouts.main')
@section('title', 'Price List')
@section('content')
    <p class="fs-3">Price List</p>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Price List</li>
        </ol>
    </nav>
    <hr>
    <a href="{{ url('price/create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create</a>
    <table class="table table-striped mt-3" border="1" id="category-table">
        <thead>
            <tr>
                <th scope="col" class="text-center" width="25">No</th>
                <th scope="col" class="text-center">Product Name</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($price as $data)
                <tr>
                    <th class="text-center">{{ $loop->iteration }}</th>
                    <td class="text-center {{ is_null($data->product) ? 'text-danger' : '' }}">
                        {{ $data->product->name ?? 'No items linked to this price.' }}
                    </td>
                    <td class="text-center">Rp. {{ number_format($data->price, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="/price/edit/{{ $data->id }}" class="btn btn-outline-warning btn-sm"><i
                                class="fas fa-pencil"></i>
                        </a>
                        <form action="/price/{{ $data->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Are you sure want to delete this product?')" type="submit"><i
                                    class="fas fa-trash-alt"></i></button>
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
            $('#category-table').DataTable({
                // paging: false,
                bInfo: false,
                lengthChange: false
            });
        });
    </script>
@endsection

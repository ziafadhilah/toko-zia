@extends('layouts.main')
@section('title', 'Category List')
@section('content')
    <p class="fs-3">Category List</p>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Category List</li>
        </ol>
    </nav>
    <hr>
    <a href="{{ url('category/create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create</a>
    <table class="table table-striped mt-3" border="1" id="category-table">
        <thead>
            <tr>
                <th scope="col" class="text-center" width="25">No</th>
                <th scope="col" class="text-center">Category Code</th>
                <th scope="col" class="text-center">Category Name</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $data)
                <tr>
                    <th class="text-center">{{ $loop->iteration }}</th>
                    <td class="text-center">{{ $data->category_code }}</td>
                    <td class="text-center">{{ $data->name }}</td>
                    <td class="text-center">
                        <a href="/category/edit/{{ $data->id }}" class="btn btn-outline-warning btn-sm"><i
                                class="fas fa-pencil"></i>
                        </a>
                        <form action="/category/{{ $data->id }}" method="post" class="d-inline">
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

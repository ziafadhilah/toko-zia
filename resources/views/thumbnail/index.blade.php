@extends('layouts.main')
@section('title', 'Thumbnail List')
@section('content')
    <p class="fs-3">Thumbnail List</p>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Thumbnail List</li>
        </ol>
    </nav>
    <hr>
    <a href="{{ url('thumbnail/create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create</a>
    <table class="table table-striped mt-3" border="1" id="thumbnail-table">
        <thead>
            <tr>
                <th scope="col" class="text-center" width="25">No</th>
                <th scope="col" class="text-center">Thumbnail Code</th>
                <th scope="col" class="text-center">Product Name</th>
                <th scope="col" class="text-center">Thumbnail</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($thumbnail as $data)
                <tr>
                    <th class="text-center">{{ $loop->iteration }}</th>
                    <td class="text-center">{{ $data->thumbnail_code ?? 'No Data' }}</td>
                    <td class="text-center">{{ $data->product->name ?? 'No Data' }}</td>
                    <td class="text-center">
                        <img src="{{ asset('storage/' . $data->thumbnail) }}" alt="" class="img-fluid w-25">
                    </td>
                    <td>
                        <a href="{{ url('thumbnail/edit/' . $data->id) }}" class="btn btn-outline-warning btn-sm"><i
                                class="fas fa-edit"></i>
                        </a>
                        <form action="{{ url('thumbnail/' . $data->id) }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this thumbnail?')">
                                <i class="fas fa-trash-alt"></i>
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
            $('#thumbnail-table').DataTable({
                // paging: false,
                bInfo: false,
                lengthChange: false
            });
        });
    </script>
@endsection

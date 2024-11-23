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
                @if ($price->product)
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
                    <p class="mb-2 text-white">Price</p>
                    <div class="mb-3 input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" name="price" class="form-control" id="price"
                            value="{{ number_format($price->price, 0, ',', '.') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                @else
                    <p class="text-danger">No items linked to this price.</p>
                    <a href="{{ url('/price') }}" class="text-decoration-none"><i class="fas fa-arrow-left"></i> Back</a>
                @endif
            </div>
        </div>
    </form>
@endsection
@section('pagescript')
    <script>
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('input', function(e) {
            // hilangkan karakter non-angka
            let value = e.target.value.replace(/[^\d]/g, '');
            // format angka dengan pemisah ribuan
            value = new Intl.NumberFormat('id-ID').format(value);
            // Masukkan hasil format kembali ke input
            e.target.value = value;
        });
        // menghilangkan pemisah ribuan sebelum dikirim ke be
        const form = priceInput.closest('form');
        form.addEventListener('submit', function() {
            priceInput.value = priceInput.value.replace(/\./g, ''); // Hilangkan titik
        });
    </script>
@endsection

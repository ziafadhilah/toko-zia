@extends('layouts.main')
@section('title', 'Create Price')
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
                    @if ($getProduct->isEmpty())
                        <div class="text-white text-center">There are no products that can be added the price</div>
                    @else
                        <label for="product_id" class="form-label text-white">Product</label>
                        <select class="form-select form-select-md" aria-label=".form-select-md example" name="product_id">
                            <option selected class="text-center">-- Choose Product --</option>
                            @foreach ($getProduct as $data)
                                <option value="{{ $data->id }}">{{ $data->name ?? '-' }}</option>
                            @endforeach
                        </select>
                </div>
                <p class="mb-2 text-white">Price</p>
                <div class="mb-3 input-group">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" name="price" class="form-control" id="price">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
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

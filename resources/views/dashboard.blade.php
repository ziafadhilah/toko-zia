@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <h1 class="fs-3 mb-3">Dashboard</h1>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text fs-2">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        @foreach ($stockPerCategory as $categoryName => $stock)
            <div class="col-md-3 mb-4">
                <div
                    class="card
                    @if ($stock <= 15) bg-danger
                    @elseif($stock <= 25) bg-warning
                    @elseif($stock >= 30) bg-success
                    @else bg-warning @endif text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $categoryName }}</h5>
                        <p class="card-text fs-2">{{ $stock }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mb-5">
        <div class="col-md-6">
            <h4>Product</h4>
            <div class="col mb-2">
                <button class="btn btn-danger"></button> Stock under 15
            </div>
            <div class="col mb-2">
                <button class="btn btn-success"></button> Stock above 30
            </div>
            <ul class="list-group">
                @foreach ($stockPerCategory as $categoryName => $stock)
                    <li
                        class="list-group-item
                        @if ($stock <= 15) bg-danger text-white
                        @elseif($stock > 30) bg-success text-white
                        @else text-dark bg-light @endif">
                        {{ $categoryName }}: {{ $stock }} Item Left
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <canvas id="stockChart" width="400" height="300"></canvas>
        </div>
    </div>
@endsection

@section('pagescript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('stockChart').getContext('2d');
            const stockData = {!! json_encode(array_values($stockPerCategory)) !!};
            const stockBackgroundColors = stockData.map(stock =>
                stock <= 15 ? 'rgba(255, 99, 132, 0.5)' :
                stock > 30 ? 'rgba(75, 192, 192, 0.5)' :
                'rgba(75, 192, 192, 0.5)'
            );
            const stockBorderColors = stockData.map(stock =>
                stock <= 15 ? 'rgba(255, 99, 132, 0.5)' :
                stock > 30 ? 'rgba(75, 192, 192, 0.5)' :
                'rgba(75, 192, 192, 0.5)'
            );

            const stockChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($stockPerCategory)) !!},
                    datasets: [{
                        label: 'Stock Graph',
                        data: stockData,
                        backgroundColor: stockBackgroundColors,
                        borderColor: stockBorderColors,
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection

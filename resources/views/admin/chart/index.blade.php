@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="d-flex gap-2 align-items-center my-4">
            <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-circle-left"
                    aria-hidden="true"></i></a>

            <h1>Statistiche vendite</h1>

        </div>

        <h3 class="text-center">Grafico ordini dell'ultimo anno</h3>
        <div class="mb-4" style="width: 80%; margin: auto;">
            <canvas id="barChart"></canvas>
        </div>


        <h3 class="text-center my-4">Seleziona un piatto per vedere le statistiche</h3>
        <select style="margin: auto;" class="form-select form-select-lg w-50 mb-4" onchange="window.location.href=this.options[this.selectedIndex].value;">
            <option selected disabled value="">Seleziona un piatto</option>
            @foreach ($plates as $plate)
                <option value="{{ route('admin.barchart.show', $plate) }}">{{ $plate->name }}</option>
            @endforeach
        </select>

    </div>
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'N° Ordini',
                    data: @json($data['data']),
                    backgroundColor: 'rgba(255, 220, 0, 0.5)',
                    borderColor: 'rgba(255, 220, 0, 1)',
                    borderWidth: 1
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

        var ctx = document.getElementById('plateChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($plateData['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($plateData['data']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
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
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-4 justify-content-center">

            <div class="d-flex gap-4 pt-4 resp_card">

                <div class="card col-6 ">
                    <div class="text-center my-4">
                        <h1>Dashboard "{{ $restaurant->restaurant_name }}"</h1>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card col-6 ">

                    <div class="card-body">
                        <div><strong>Indirizzo: </strong>{{ $restaurant->address }}</div>
                        <div><strong>Telefono: </strong>{{ $restaurant->phone_number }}</div>
                        <div><strong>Email: </strong>{{ $user->user_email }}</div>
                        <div><strong>P.IVA: </strong>{{ $restaurant->p_iva }}</div>

                    </div>
                </div>


            </div>

            <div class="d-flex gap-4 pt-4 resp_card">

                <div class="card col-6 bg-warning">
                    <a class="text-decoration-none" href="{{ route('admin.plates.create') }}">
                        <div class="card-title">
                            <div class="text-center text-dark  my-4">
                                <h2>Aggiungi un piatto</h2>
                            </div>
                        </div>
                    </a>

                </div>
                @if ($lastOrder)
                    <div class="card col-6 bg-warning">
                        <a class="text-decoration-none" href="{{ route('admin.orders.show', $lastOrder->id) }}">
                            <div class="card-title">
                                <div class="text-center text-dark my-4">
                                    <h2>Ultimo ordine ricevuto</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif


            </div>
            <div class="d-flex gap-4 pt-4 resp_card">

                <div class="card col-6">
                    <div class="text-center my-4">
                        <h2>Ordini degli ultimi 12 mesi</h2>
                        <div class="mb-4" style="width: 80%; margin: auto;">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card col-6">
                    <div class="text-center my-4">
                        <h2>Vendite degli ultimi 12 mesi</h2>
                        <div class="mb-4" style="width: 80%; margin: auto;">
                            <canvas id="sellChart"></canvas>
                        </div>
                    </div>



                </div>
            </div>


        </div>
    </div>






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


        var ctx = document.getElementById('sellChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($dataSell['labels']),
                datasets: [{
                    label: 'N° Vendite',
                    data: @json($dataSell['data']),
                    backgroundColor: 'rgba(255, 0, 0, 0.5)',
                    borderColor: 'rgba(255, 0, 0, 1)',
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

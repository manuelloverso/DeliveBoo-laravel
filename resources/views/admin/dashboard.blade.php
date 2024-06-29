@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-4 justify-content-center">

            <div class="d-flex gap-4 pt-4 resp_card">

                <div class="card col-6 ">
                    <div class="text-center my-4">
                        <h1>Benvenuto Nome risto</h1>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card col-6 ">

                    <div class="card-body">
                        Dati Ristorante

                    </div>
                </div>


            </div>

            <div class="d-flex gap-4 pt-4 resp_card">

                <div class="card col-8">
                    <div class="card-title">
                        <div class="text-center my-4">
                            <h2>Statistiche vendite</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">Ordini degli ultimi 12 mesi</h2>
                        <div class="mb-4" style="width: 80%; margin: auto;">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card col-4">
                    <div class="text-center my-4">
                        <h2>Grafico del totale degli ordini per mese</h2>
                    </div>
                    <div class="card-body text-center">
                        Da Fare

                    </div>



                </div>
            </div>
            <div class="d-flex gap-4 pt-4 resp_card">

                <div class="card col-6">
                    <a href="{{ route('admin.plates.create') }}">

                        <div class="card-title">

                            <div class="text-center my-4">
                                <h2>Aggiungi un piatto</h2>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="card col-6 ">
                    <a href="{{ route('admin.orders.show', $lastOrder->id) }}">

                        <div class="card-title">

                            <div class="text-center my-4">
                                <h2>Ultimo ordine ricevuto</h2>
                            </div>
                        </div>

                </div>
                </a>

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
    </script>
@endsection

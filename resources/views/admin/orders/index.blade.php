@extends('layouts.app')

@section('content')

    <div class="container py-4">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">N° ordine</th>
                        <th scope="col">Data ordine</th>
                        <th scope="col">Nome Cliente</th>
                        <th scope="col">Cognome Cliente</th>
                        <th scope="col">Email Cliente</th>
                        <th scope="col">Indirizzo Cliente</th>
                        <th scope="col">Tel Cliente</th>
                        <th scope="col">Stato Ordine</th>


                    </tr>
                </thead>
                <tbody>
                    @if ($orders->isEmpty())
                        
                    <tr class="">
                        <td colspan="8" scope="row">Non hai ricevuto nessun ordine</td>
                    </tr>
                    @else
                        @foreach ($orders as $order)
                            <tr class="">
                                <td scope="row">{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_lastname }}</td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ $order->customer_address }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>

@endsection

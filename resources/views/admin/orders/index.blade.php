@extends('layouts.app')

@section('content')

    <div class="container py-4">
        <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-circle-left"
                aria-hidden="true"></i></a>

        <h1 class="py-4">Tabella degli ordini ricevuti</h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">N° ordine</th>
                        <th scope="col">Data ordine</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Stato Ordine</th>
                        <th>Totale</th>
                        <th scope="col">Vedi Ordine</th>
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
                                <td>{{ $order->customer_name }} {{ $order->customer_lastname }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->total }}€</td>
                                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary"><i
                                            class="fa-solid fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{-- {{ $orders->links('pagination::bootstrap-5') }} --}}

    </div>

@endsection

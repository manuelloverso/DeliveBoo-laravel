@extends('layouts.app')

@section('content')

    <div class="container py-4 ">
        <a class="btn mb-2 " href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-circle-left"
                aria-hidden="true"></i></a>

        <div class="container table-order ">
            <div class="card p-3">

                <div class="card-title">
                    <h1 class="py-4">Ordini ricevuti</h1>
                </div>
                <p>Ordini Totali: {{ $orders->total() }}</p>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Data ordine</th>
                                    <th scope="col" class="customer-order">Cliente</th>
                                    <th>Totale</th>
                                    <th scope="col" class="text-center">Vedi Ordine</th>
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

                                            <td class="date">{{ date('d-m-Y h:m', strtotime($order->created_at)) }}</td>
                                            <td class="customer-order">{{ $order->customer_name }}
                                                {{ $order->customer_lastname }}</td>
                                            <td>{{ $order->total }}€</td>
                                            <td class="text-center"><a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                   
                        {{ $orders->links('pagination::bootstrap-5') }}
                    
                </div>
            </div>
        </div>
    </div>

@endsection

<?php
$plateList = json_decode($plates);

?>


@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-secondary mt-4" href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-circle-left"
            aria-hidden="true"></i> Torna agli ordini</a>
        <h1 class="">Dettagli ordine</h1>
        <h5 class="text-secondary pb-4">Ordine n°{{ $order->id }} del {{ $order->created_at }}</h5>

        <div class="row row-cols-1 row-cols-md-2 ">
            <div class="col">
                <h3>Lista ordine</h3>
                <div class="card border-0">
                    <div class="table-responsive">
                        <table class="table table-secondary">
                            <thead>
                                <tr>
                                    <th scope="col">Piatto</th>
                                    <th scope="col">Quantità</th>
                                    <th scope="col">Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plateList as $plate)
                                    <tr class="">
                                        <td scope="row">{{ $plate->name }}</td>
                                        <td>{{ $plate->qty }}</td>
                                        <td>{{ $plate->price }}€</td>
                                    </tr>
                                @endforeach
                                <tr class="">
                                    <td class="text-center" colspan="3" scope="row"><strong>Totale:
                                        </strong>{{ $order->total }}€</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
            <div class="col">
                <h3>Informazioni cliente</h3>

                <div class="card w-50">
                    <div class="m-1"><strong>Nome: </strong>{{ $order->customer_name }}</div>
                    <div class="m-1"><strong>Cognome: </strong>{{ $order->customer_lastname }}</div>
                    <div class="m-1"><strong>Email: </strong>{{ $order->customer_email }}</div>
                    <div class="m-1"><strong>Telefono: </strong>{{ $order->customer_phone }}</div>
                    <div class="m-1"><strong>Indirizzo: </strong>{{ $order->customer_address }}</div>
                    

                </div>

            </div>
        </div>


    </div>
@endsection

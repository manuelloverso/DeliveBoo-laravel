<?php
$plateList = json_decode($plates);

?>


@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn mt-4 mb-2" href="{{ route('admin.orders.index') }}"><i class="fa fa-arrow-circle-left"
                aria-hidden="true"></i></a>

        <div class="card p-4">
            <div class="card-title">
                <h1 class="py-4">Dettagli ordine</h1>
            </div>
            <div class="card-body">
                <h5 class="text-secondary pb-4">Ordine n°{{ $order->id }} del {{ $order->created_at }}</h5>

                <div class="row row-cols-1 row-cols-md-2 ">
                    <div class="col">

                        <div class="card text-center">
                            <div class="card-header">
                                <h3>Lista ordine</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
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

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary">
                                <tr class="">
                                    <td class="text-center" colspan="3" scope="row"><strong>Totale:
                                        </strong>{{ $order->total }}€</td>
                                </tr>
                            </div>
                        </div>



                    </div>
                    <div class="col">


                        <div class="card text-center">
                            <div class="card-header">
                                <h3>Informazioni cliente</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Cognome</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telefono</th>
                                                


                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                                <tr class="">
                                                    <td scope="row">{{ $order->customer_name }}</td>
                                                    <td>{{ $order->customer_lastname }}</td>
                                                    <td>{{ $order->customer_email }}</td>
                                                    <td>{{ $order->customer_phone }}</td>
                                                    

                                                </tr>
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary">
                                <tr >
                                   <td><strong>Indirizzo di consegna: </strong>{{ $order->customer_address }}</td> 
                                </tr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

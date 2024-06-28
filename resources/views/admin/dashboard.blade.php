@extends('layouts.appDashboard')

@section('content')
    <div class="dashboard">
        <div class=" container-fluid py-5">
            <div class="row gap-5 ">
                @include('partials.message-error')

                <!--info-restaurant-->
                <div class=" card col-12 col-sm-6 col-md-6 col-lg-12 text-body-secondary mx-auto">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if (Str::startsWith($user->restaurant->image, 'https://'))
                                <img loading="lazy" class="h-100 w-100 img-fluid rounded-start "
                                    src="{{ $user->restaurant->image }}" alt="">
                            @else
                                <img loading="lazy" class="h-100 w-100 img-fluid rounded-start "
                                    src="{{ asset('storage/' . $user->restaurant->image) }}" alt="">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body px-4">
                                <div>

                                    <h1>{{ $user->restaurant->restaurant_name }}</h1>
                                    <div class="d-flex gap-2">
                                        @foreach ($user->restaurant->types as $type)
                                            <div class="bg_orange-dark px-2 rounded text-white">{{ $type->name }}</div>
                                        @endforeach
                                    </div>
                                    <div class="py-2">
                                        <i class="fa-solid fa-location-dot"></i> {{ $user->restaurant->address }}
                                    </div>
                                    <div class="py-2">
                                        <i class="fa-solid fa-phone"></i> {{ $user->restaurant->phone_number }}
                                    </div>
                                    <div class="py-2">
                                        <strong>PI:</strong> {{ $user->restaurant->p_iva }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--statistic-->
                <div class="card grafic-card col-12 col-sm-4 col-md-6 col-lg-4 text-body-secondary mx-auto">
                    <img src="{{ Vite::asset('resources/img/grafico.jpg') }}" class="card-img-top" alt="statistic grafic">
                    <div class="card-body p-0">
                        <a class="text-decoration-none btn text-white w-100 rounded-0 text-uppercase fs-5"
                            href="{{ route('admin.barchart.index') }}">
                            Le tue statistiche
                        </a>
                        <p class="card-text px-5 py-2 text-center">
                            Ti aiutiamo a tenere sempre sotto controllo il rendimento del tuo ristorante
                        </p>
                    </div>
                </div>

                <!--menu-->
                <div class="card grafic-card col-12 col-sm-3 col-md-6 col-lg-3 text-body-secondary mx-auto">
                    <img src="{{ Vite::asset('resources/img/piatti.png') }}" class="card-img-top" alt="statistic grafic">
                    <div class="card-body p-0">
                       
                        <p class="card-text px-5 py-2 text-center ">
                            Aggiungi, modifica o elimina i piatti del tuo menù<br>
                            Quando vuoi e come vuoi!
                        </p>
                         
                    </div>
                    <a class="text-decoration-none btn text-white w-100 rounded-0 text-uppercase fs-5 rounded-bottom"
                            href="{{ route('admin.plates.index') }}">
                           Il tuo menù 
                        </a>
                </div>

                <!--info-orders-->
                <div class="card grafic-card col-12 col-sm-5 col-md-6 col-lg-4 text-body-secondary mx-auto">
                    <img src="{{ Vite::asset('resources/img/deliverome.png') }}" class="img-fluid rounded-top"
                        alt="delivery">
                    <div class="card-body p-0">
                        <a class="text-decoration-none btn text-white w-100 rounded-0 text-uppercase fs-5"
                            href="{{ route('admin.orders.index') }}">
                            Ordini ricevuti
                        </a>
                        <p class="card-text px-5 py-2 text-center">
                            Il tuo storico dal giorno zero <br>
                            Con noi nessun ordine andrá perso!

                        </p>
                    </div>
                </div>
            </div>


            {{-- @if ($user->restaurant) --}}


        </div>

        {{-- @else
                <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                    Crea il tuo ristorante!
                </a>
            @endif --}}

    </div>
    </div>
@endsection

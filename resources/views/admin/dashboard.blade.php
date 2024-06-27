@extends('layouts.appDashboard')

@section('content')
    <div class="dashboard">
        <div class=" container py-4">
            <div class="row gap-4">
                @include('partials.message-error')

                <!--info-restaurant-->
                <div class="card mb-3 mx-auto col-12">
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
                            <div class="card-body">
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

                <div class="col">
                    <div class="row gap-4 ">
                        <!--statistic-->
                        <div class="card grafic-card mt-4 col-12 col-sm-4">
                            <img src="{{ Vite::asset('resources/img/grafico.jpg') }}" class="card-img-top"
                                alt="statistic grafic">
                            <div class="card-body p-0">
                                <a class="text-decoration-none btn text-white w-100"
                                    href="{{ route('admin.barchart.index') }}">
                                    Le tue statistiche
                                </a>
                                <p class="card-text px-5 py-2 text-center">
                                    Tieni sempre sotto controllo il rendimento del tuo ristorante
                                </p>
                            </div>
                        </div>

                        <!--info-orders-->
                        <div class="card mb-3 col-12 col-sm-4 mt-4 ">
                            <div class="row g-0">

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural
                                            lead-in to
                                            additional content. This content is a little bit longer.</p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins
                                                ago</small></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <img src="..." class="img-fluid rounded-start" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            {{-- @if ($user->restaurant) --}}


        </div>



        <div class="d-flex flex-column align-items-end">
            <div class="py-1">
                <a class="text-decoration-none btn btn-lg btn_yellow" href="{{ route('admin.plates.index') }}">
                    Menu
                </a>
            </div>
            <div>
                <a class="text-decoration-none btn btn-lg  btn_yellow" href="{{ route('admin.barchart.index') }}">
                    Statistiche
                </a>
                <a class="text-decoration-none btn btn-lg  btn_orange" href="{{ route('admin.orders.index') }}">
                    Ordini
                </a>
            </div>

            {{-- @else
                <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                    Crea il tuo ristorante!
                </a>
            @endif --}}

        </div>
    </div>
@endsection

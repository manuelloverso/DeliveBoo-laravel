@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <div class=" container py-4">
            @include('partials.message-error')

            {{-- @if ($user->restaurant) --}}
            <div class="row">

                <div class="card col-12 col-lg-6 m-auto rounded-3 ">

                    <div class="card-image">
                        @if (Str::startsWith($user->restaurant->image, 'https://'))
                            <img loading="lazy" class="w-100 rounded-top-3 " src="{{ $user->restaurant->image }}"
                                alt="">
                        @else
                            <img loading="lazy" class="w-100 rounded-top-3 "
                                src="{{ asset('storage/' . $user->restaurant->image) }}" alt="">
                        @endif
                    </div>
                    <div class="card-body d-flex justify-content-between  p-5">

                        <div>

                            <h1>{{ $user->restaurant->restaurant_name }}</h1>
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

                        <div class="d-flex flex-column gap-3 justify-content-between align-items-end">

                            <div class="d-flex gap-2">
                                @foreach ($user->restaurant->types as $type)
                                    <div class="bg_orange-dark px-2 rounded text-white">{{ $type->name }}</div>
                                @endforeach
                            </div>

                            <div class="d-flex flex-column align-items-end">
                                <div class="py-1">
                                    <a class="text-decoration-none btn btn-lg btn_yellow"
                                        href="{{ route('admin.plates.index') }}">
                                        Menu
                                    </a>
                                </div>
                                <div>
                                    <a class="text-decoration-none btn btn-lg  btn_yellow" href="#">
                                        Statistiche Vendite
                                    </a>
                                    <a class="text-decoration-none btn btn-lg  btn_orange" href="{{ route('admin.orders.index') }}">
                                        Ordini
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- @else
                <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                    Crea il tuo ristorante!
                </a>
            @endif --}}

        </div>
    </div>
@endsection

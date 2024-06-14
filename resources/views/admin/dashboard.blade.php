@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @include('partials.message-error')

        @if ($user->restaurant)
            <div class="row">

                <div class="card col-12 col-lg-8 m-auto ">

                    <div class="card-image">
                        <img class="w-100 p-1 " src="{{ $user->restaurant->image }}" alt="">
                    </div>
                    <div class="card-body d-flex justify-content-between">

                        <div>
                            <h1>{{ $user->restaurant->name }}</h1>

                            <div class="div">
                                Indirizzo: {{ $user->restaurant->address }}
                            </div>
                            <div>
                                e-mail: {{ $user->restaurant->mail }}
                            </div>
                            <div>
                                Tel: {{ $user->restaurant->phone_number }}
                            </div>
                            <div>
                                PI: {{ $user->restaurant->vat }}
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <a class="text-decoration-none btn btn-primary" href="{{ route('admin.plates.index') }}">
                                Piatti
                            </a>
                            <a class="text-decoration-none btn btn-primary" href="{{ route('admin.plates.create') }}">
                                Crea Nuovo Piatto
                            </a>
                            <a class="text-decoration-none btn btn-primary"
                                href="{{ route('admin.restaurants.show', $user->restaurant) }}">
                                Statistiche
                            </a>
                            <a class="text-decoration-none btn btn-warning"
                                href="{{ route('admin.restaurants.show', $user->restaurant) }}">
                                Ordini
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                Crea il tuo ristorante!
            </a>
        @endif

    </div>
@endsection

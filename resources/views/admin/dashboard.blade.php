@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @include('partials.message-error')

        @if ($user->restaurant)
            <a href="{{ route('admin.restaurants.show', $user->restaurant) }}">

                <div class="card">
                    <h1>{{ $user->restaurant->name }}</h1>
                </div>
            </a>
        @else
            <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                Crea il tuo ristorante!
            </a>
        @endif

    </div>
@endsection

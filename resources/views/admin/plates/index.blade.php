@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach ($plates as $plate)
            <h1>{{ $plate->name }}</h1>
            <a class="btn btn-secondary" href="{{ route('admin.plates.edit', $plate) }}">Modifica il piatto</a>
        @endforeach
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach ($plates as $plate)
            <h1>{{ $plate->name }}</h1>
        @endforeach
    </div>
@endsection

@extends('layouts.app')


@section('content')
    <div class="container not-found ">
        <div class="d-flex justify-content-center">
            <div class="four">4</div>
            <img class="nofound_img" src="{{ Vite::asset('resources/img/logo.svg') }}" alt="no found page">
            <div class="four">4</div>
        </div>

        <div class="text_nofound text-center">
            Oops! La pagina che stai cercando non esiste
        </div>

    </div>
@endsection

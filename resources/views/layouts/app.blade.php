<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliveRome</title>

    {{-- chart.js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fonts -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Puritan:ital,wght@0,400;0,700;1,400;1,700&family=Rubik:ital,wght@0,300..900;1,300..900&family=Sawarabi+Mincho&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-sm navbar-light bg_orange ">
            <div class="container">
                <a class="navbar-brand" href="http://localhost:5173/">
                    <img class="nav-logo" src="{{ Vite::asset('resources/img/logo.svg') }}" alt="">

                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="collapsibleNavId">

                    <ul class="navbar-nav me-auto mt-2 mt-lg-0 w-100 ">
                        <li class="nav-item btn btn-success m-2">
                            <a class="nav-link active text-white fs-5 " href="{{ route('admin.orders.index') }}"
                                aria-current="page">Ordini
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item btn btn-light m-2">
                            <a class="nav-link active fs-5" href="{{ route('admin.plates.index') }}"
                                aria-current="page">Piatti
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item btn btn-danger m-2">
                            <a class="nav-link active text-white fs-5" href="{{ route('admin.barchart.index') }}"
                                aria-current="page">Statistiche
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                    </ul>


                    <div class="nav-item dropdown">

                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white"
                                            href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        {{ Auth::user()->user_name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </div>
            </div>
        </nav>



        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>

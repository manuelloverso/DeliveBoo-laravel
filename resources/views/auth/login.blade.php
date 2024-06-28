@extends('layouts.appRegisterLogin')

@section('content')
    <section class="">

        <div class="container">
            <div class="row justify-content-center p-5">
                <div class="card col-lg-6">


                    <div class="card-body">

                        <h3 class="text-center ">Accedi</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4 m-auto w-75">
                                <label for="user_email" class=" form-label">{{ __('E-Mail') }}</label>

                                <div class="">
                                    <input id="user_email" type="email"
                                        class="form-control @error('user_email') is-invalid @enderror" name="user_email"
                                        value="{{ old('user_email') }}" required autocomplete="user_email" autofocus>

                                    @error('user_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 m-auto w-75">
                                <label for="password" class=" form-label">{{ __('Password') }}</label>

                                <div class="">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-75 m-auto">
                                <div>


                                    <div class="form-check w-75">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class=" form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="text-center">


                                    <button type="submit" class="btn btn-dark mt-4">
                                        {{ __("Esegui l'accesso") }}
                                    </button>

                                </div>
                                <div class="text-center">

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link " href="{{ route('password.request') }}">
                                            {{ __('Password dimenticata?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

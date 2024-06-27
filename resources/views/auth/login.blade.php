@extends('layouts.app')

@section('content')



    <section class="login">

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card w-50">


                        <div class="card-body">

                            <h3 class="text-center text-white">Accedi</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-4 m-auto w-75">
                                    <label for="user_email" class="text-white form-label">{{ __('E-Mail') }}</label>

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
                                    <label for="password" class="text-white form-label">{{ __('Password') }}</label>

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

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="text-white form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>



                                    <button type="submit" class="btn bg_btn mt-4 w-100">
                                        {{ __("Esegui l'accesso") }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                            {{ __('Password dimenticata?') }}
                                        </a>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

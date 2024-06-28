<script>
    function handleData() {
        var form_data = new FormData(document.querySelector("form"));
        if (!form_data.has("types[]")) {
            document.getElementById("chk_option_error").style.visibility = "visible";
            return false;
        } else {
            document.getElementById("chk_option_error").style.visibility = "hidden";
            return true;
        }
    }

    function checkPassword() {
        let password = document.getElementById("password").value;
        let passwordConfirm = document.getElementById("password-confirm").value;
        console.log(password, passwordConfirm);
        if (password != passwordConfirm) {
            document.getElementById("chk_option_error_passw").style.visibility = "visible";
            return false;
        } else {
            document.getElementById("chk_option_error_passw").style.visibility = "hidden";
            return true;
        }
    }

    function validateForm() {
        const a = handleData();
        const b = checkPassword();
        return a && b;
    }
</script>


<template>


    @extends('layouts.appRegisterLogin')

    @section('content')
        <section class="register">

            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-12 pb-5">
                        <div class="card">


                            <div class="card-body">

                                <h2 class="text-center ">Registrati</h2>
                                <div class="mb-4 m-auto w-75  text-center">
                                    <p>I campi contrassegnati con ⚠️ sono obbligatori</p>
                                </div>
                                <div>

                                    <form onsubmit="return validateForm()" method="POST" action="{{ route('register') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- User Form --}}
                                        <div class="d-flex smart_view">
                                            <div class="col-6 W_100">

                                                <h3 class="text-center ">Dati Utente</h3>


                                                <div class="mb-4 m-auto w-75 ">
                                                    <label for="user_name"
                                                        class="col-md-4 col-form-label  text-md-right">{{ __('Nome') }}
                                                        <span class="text-danger">⚠️</span>
                                                    </label>
                                                    <div class="">
                                                        <input id="user_name" type="text"
                                                            class="form-control @error('user_name') is-invalid @enderror"
                                                            name="user_name" value="{{ old('user_name') }}" required
                                                            autocomplete="user_name" autofocus>
                                                        @error('user_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-4 m-auto w-75">
                                                    <label for="lastname"
                                                        class="col-md-4 col-form-label  text-md-right">{{ __('Cognome') }}
                                                        <span class="text-danger">⚠️</span></label>

                                                    <div class="">
                                                        <input id="lastname" type="text"
                                                            class="form-control @error('lastname') is-invalid @enderror"
                                                            name="lastname" value="{{ old('lastname') }}" required
                                                            autocomplete="lastname" autofocus>

                                                        @error('lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-4 m-auto w-75">
                                                    <label for="user_email"
                                                        class="col-md-4 col-form-label  text-md-right">{{ __('E-Mail') }}
                                                        <span class="text-danger">⚠️</span></label>

                                                    <div class="">
                                                        <input id="user_email" type="email"
                                                            class="form-control @error('user_email') is-invalid @enderror"
                                                            name="user_email" value="{{ old('user_email') }}" required
                                                            autocomplete="user_email">

                                                        @error('user_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-4 m-auto w-75">
                                                    <label for="password"
                                                        class="col-md-4 col-form-label  text-md-right">{{ __('Password') }}
                                                        <span class="text-danger">⚠️</span></label>

                                                    <div class="">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="new-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-4 m-auto w-75">
                                                    <label for="password-confirm"
                                                        class="col-md-4 col-form-label  text-md-right">{{ __('Conferma Password') }}
                                                        <span class="text-danger">⚠️</span></label>

                                                    <div class="">
                                                        <input id="password-confirm" type="password" class="form-control"
                                                            name="password_confirmation" required
                                                            autocomplete="new-password">
                                                        <div style="visibility:hidden; color:red; "
                                                            id="chk_option_error_passw">
                                                            La password non corrisponde
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 W_100">

                                                <h3 class="text-center ">Dati Ristorante</h3>


                                                {{-- Restaurant Form --}}

                                                <div class="mb-4 m-auto w-75">
                                                    <label for="restaurant_name"
                                                        class="col-md-4 col-form-label  text-md-right">Nome
                                                        Ristorante <span class="text-danger">⚠️</span></label>
                                                    <div class="">
                                                        <input type="text" required
                                                            class="form-control @error('restaurant_name') is-invalid @enderror"
                                                            name="restaurant_name" id="restaurant_name"
                                                            aria-describedby="helpId" placeholder=""
                                                            value="{{ old('restaurant_name') }}" />
                                                        @error('restaurant_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-4 m-auto w-75">
                                                    <label for="address"
                                                        class="col-md-4 col-form-label  text-md-right">Indirizzo
                                                        <span class="text-danger">⚠️</span></label>
                                                    <div class="">
                                                        <input type="text" required
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            name="address" id="address" aria-describedby="helpId"
                                                            placeholder="" value="{{ old('address') }}" />
                                                        @error('address')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-4 m-auto w-75">
                                                    <label for="phone_number"
                                                        class="col-md-4 col-form-label  text-md-right">Numero di
                                                        telefono</label>
                                                    <div class="">
                                                        <input type="tel"
                                                            class="form-control @error('phone_number') is-invalid @enderror"
                                                            name="phone_number" id="phone_number"
                                                            aria-describedby="helpId" placeholder=""
                                                            value="{{ old('phone_number') }}" />
                                                        @error('phone_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-4 m-auto w-75">
                                                    <label for="p_iva"
                                                        class="col-md-4 col-form-label  text-md-right">Partita
                                                        IVA
                                                        <span class="text-danger">⚠️</span></label>
                                                    <div class="">
                                                        <input required type="text"
                                                            class="form-control @error('p_iva') is-invalid @enderror"
                                                            name="p_iva" id="p_iva" aria-describedby="helpId"
                                                            placeholder="" value="{{ old('p_iva') }}" />
                                                        @error('p_iva')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                {{-- Types input --}}
                                                <div class="mb-4 m-auto w-75">
                                                    <label for="types"
                                                        class="col-md-4 col-form-label  text-md-right">Tipologia
                                                        <span class="text-danger">⚠️</span>

                                                        @error('types')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror

                                                    </label>

                                                    <div class="col">
                                                        <div style="visibility:hidden; color:red; " id="chk_option_error">
                                                            Seleziona almeno una tipologia
                                                        </div>
                                                        <div class="col-md-6 d-flex gap-2 flex-wrap w-100">
                                                            @foreach ($types as $type)
                                                                <div class="form-check">
                                                                    <input name="types[]" class="form-check-input"
                                                                        type="checkbox" value="{{ $type->id }}"
                                                                        id="type-{{ $type->id }}"
                                                                        {{ in_array($type->id, old('types', [])) ? 'checked' : '' }} />
                                                                    <label class="form-check-label "
                                                                        for="type-{{ $type->id }}">
                                                                        {{ $type->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>

                                                {{-- Image input --}}
                                                <div class="mb-4 m-auto w-75">
                                                    <label for="image"
                                                        class="col-md-4 col-form-label  text-md-right">Immagine
                                                        <span class="text-danger">⚠️</span></label>
                                                    <div class="">

                                                        <input type="file" name="image" id="image" required
                                                            class="form-control  @error('image') is-invalid @enderror"
                                                            placeholder="add an image" />
                                                        @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div>

                                    <div class="mb-4 pt-4 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Registrati') }}
                                        </button>
                                    </div>
                                </div>

                                </form>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</template>
<style>
    .bg_card {
        background-color: orange;
    }

    .smart_view {
        @media screen and (max-width: 600px) {

            flex-direction: column;

            .W_100 {
                width: 100%;
            }


        }



    }
</style>

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- User Form --}}
                            <div class="mb-4 row">
                                <label for="user_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text"
                                        class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                                        value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>

                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="user_email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="user_email" type="email"
                                        class="form-control @error('user_email') is-invalid @enderror" name="user_email"
                                        value="{{ old('user_email') }}" required autocomplete="user_email">

                                    @error('user_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>


                            {{-- Restaurant Form --}}

                            <div class="mb-3">
                                <label for="restaurant_name" class="form-label">Nome</label>
                                <input type="text" required
                                    class="form-control @error('restaurant_name') is-invalid @enderror"
                                    name="restaurant_name" id="restaurant_name" aria-describedby="helpId" placeholder=""
                                    value="{{ old('restaurant_name') }}" />
                                @error('restaurant_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="address" class="form-label">Indirizzo</label>
                                <input type="text" required class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="address" aria-describedby="helpId" placeholder=""
                                    value="{{ old('address') }}" />
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="restaurant_email" class="form-label">Indirizzo mail</label>
                                <input type="email" class="form-control @error('restaurant_email') is-invalid @enderror"
                                    name="restaurant_email" id="restaurant_email" aria-describedby="helpId" placeholder=""
                                    value="{{ old('restaurant_email') }}" />
                                @error('restaurant_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Numero di telefono</label>
                                <input type="text" required
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    id="phone_number" aria-describedby="helpId" placeholder=""
                                    value="{{ old('phone_number') }}" />
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="p_iva" class="form-label">Partita IVA</label>
                                <input type="text" required class="form-control @error('p_iva') is-invalid @enderror"
                                    name="p_iva" id="p_iva" aria-describedby="helpId" placeholder=""
                                    value="{{ old('p_iva') }}" />
                                @error('p_iva')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Types input --}}
                            <label for="types" class="form-label">Tipologia</label>
                            <div class="mb-3 d-flex gap-4">
                                @foreach ($types as $type)
                                    <div class="form-check">
                                        <input name="types[]" class="form-check-input" type="checkbox"
                                            value="{{ $type->id }}" id="type-{{ $type->id }}"
                                            {{ in_array($type->id, old('types', [])) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="type-{{ $type->id }}">
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('types')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                            {{-- Image input --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control  @error('image') is-invalid @enderror"
                                    placeholder="add an image" />
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
@endsection

@extends('layouts.app')
@section('content')
    <div class="container py-4">

        <h1>Registra il tuo ristorante</h1>

        @include('partials.validation-errors')

        <form action="{{ route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" required class="form-control @error('name') is-invalid @enderror" name="name"
                    id="name" aria-describedby="helpId" placeholder="" value="{{ old('name') }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" required class="form-control @error('address') is-invalid @enderror" name="address"
                    id="address" aria-describedby="helpId" placeholder="" value="{{ old('address') }}" />
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="mail" class="form-label">Indirizzo mail</label>
                <input type="email" class="form-control @error('mail') is-invalid @enderror" name="mail" id="mail"
                    aria-describedby="helpId" placeholder="" value="{{ old('mail') }}" />
                @error('mail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="phone_number" class="form-label">Numero di telefono</label>
                <input type="text" required class="form-control @error('phone_number') is-invalid @enderror"
                    name="phone_number" id="phone_number" aria-describedby="helpId" placeholder=""
                    value="{{ old('phone_number') }}" />
                @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="vat" class="form-label">Partita IVA</label>
                <input type="text" required class="form-control @error('vat') is-invalid @enderror" name="vat"
                    id="vat" aria-describedby="helpId" placeholder="" value="{{ old('vat') }}" />
                @error('vat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- Types input --}}
            <label for="types" class="form-label">Tipologia</label>
            <div class="mb-3 d-flex gap-4">
                @foreach ($types as $type)
                    <div class="form-check">
                        <input name="types[]" class="form-check-input" type="checkbox" value="{{ $type->id }}"
                            id="type-{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="type-{{ $type->id }}"> {{ $type->name }}
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
                    class="form-control  @error('image') is-invalid @enderror" placeholder="add an image" />
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary" onclick="form.submit(); disabled=true;">
                Crea il tuo ristorante
            </button>





        </form>


    </div>
@endsection

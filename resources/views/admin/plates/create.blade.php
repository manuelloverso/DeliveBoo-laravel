@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex py-2">
            <span class="">
                <a class="btn btn-secondary" href="{{ route('admin.plates.index') }}"><i class="fa fa-arrow-circle-left"
                        aria-hidden="true"></i></a>
            </span>
            <div class="px-2"></div>
            <h1 class="">Aggiungi un nuovo piatto</h1>
        </div>
        @include('partials.validation-errors')
        <form action="{{ route('admin.plates.store') }}" method="post" enctype="multipart/form-data">
            @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

            {{-- name input --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" required name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="aggiungi il nome del piatto"
                    value="{{ old('name') }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- In Evidence input --}}
            <div class="mb-3 d-flex gap-4">
                @if ($errors->any())
                    <div class="form-check">
                        <label class="form-check-label" for="is_visible"> Disponibile nel menù
                        </label>
                        <input name="is_visible" class="form-check-input" type="checkbox" value="1" id="is_visible"
                            {{ old('is_visible') ? 'checked' : '' }} />
                    </div>
                @else
                    <div class="form-check">
                        <label class="form-check-label" for="is_visible"> Disponibile nel menù
                        </label>
                        <input name="is_visible" class="form-check-input" type="checkbox" value="1" id="is_visible"
                            checked />
                    </div>
                @endif
            </div>
            @error('is_visible')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- Image input --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" name="image" id="image"
                    class="form-control  @error('image') is-invalid @enderror" placeholder="add an image" />
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>



            {{-- Description input --}}
            <div class="mb-3">
                <label for="description" class="form-label ">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="5" placeholder="aggiungi la descrizione del piatto">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- price input --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input required type="text" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" placeholder="00.00"
                    value="{{ old('price') }}" />
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" onclick="form.submit(); disabled=true;">
                Aggiungi
            </button>

        </form>
    </div>
@endsection

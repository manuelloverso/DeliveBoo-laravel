@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex py-2">
            <span class="">
                <a class="btn btn-secondary" href="{{ route('admin.plates.index') }}"><i class="fa fa-arrow-circle-left"
                        aria-hidden="true"></i></a>
            </span>
            <div class="px-2"></div>
            <h1 class="">Modifica: {{ $plate->name }}</h1>
        </div>
        @include('partials.message-error')
        <form action="{{ route('admin.plates.update', $plate) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

            {{-- name input --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome del piatto <span class="text-danger">*</span></label>
                <input required type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="aggiungi il nome del piatto"
                    value="{{ old('name', $plate->name) }}" />
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
                            {{ $plate->is_visible ? 'checked' : '' }} />
                    </div>
                @endif
            </div>
            @error('is_visible')
                <div class="text-danger">{{ $message }}</div>
            @enderror



            {{-- Image input --}}
            <label for="image" class="form-label">Immagine</label>
            <div class="d-flex gap-2 mb-3">

                @if (Str::startsWith($plate->image, 'https://'))
                    <img width="150" loading="lazy" src="{{ $plate->image }}" alt="{{ $plate->name }}">
                @else
                    <img width="150" loading="lazy" src="{{ asset('storage/' . $plate->image) }}"
                        alt="{{ $plate->name }}">
                @endif

                <div class="mb-3 align-content-center">

                    <input type="file" name="image" id="image"
                        class="form-control  @error('image') is-invalid @enderror" placeholder="add an image" />
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            {{-- Description input --}}
            <div class="mb-3">
                <label for="description" class="form-label ">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="5" placeholder="aggiungi la descrizione del piatto">{{ old('description', $plate->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- price input --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                <input required type="number" min="0" max="100" step="0.10" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" placeholder="00.00"
                    value="{{ old('price', $plate->price) }}" />
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="py-3">
                I campi contrassegnati con <span class="text-danger">*</span> sono obbligatori
            </div>
            <button type="submit" class="btn btn-primary">
                Modifica
            </button>
            {{-- <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Back</a> --}}

        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Edit {{ $plate->name }}</h1>
        @include('partials.validation-errors')
        <form action="{{ route('admin.plates.update', $plate) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

            {{-- name input --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="add the name" value="{{ old('name', $plate->name) }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- In Evidence input --}}
            <div class="mb-3 d-flex gap-4">
                @if ($errors->any())
                    <div class="form-check">
                        <label class="form-check-label" for="is_visible"> Is visible
                        </label>
                        <input name="is_visible" class="form-check-input" type="checkbox" value="{{ true }}"
                            id="is_visible" {{ old('is_visible') ? 'checked' : '' }} />
                    </div>
                @else
                    <div class="form-check">
                        <label class="form-check-label" for="is_visible"> Is visible
                        </label>
                        <input name="is_visible" class="form-check-input" type="checkbox" value="{{ true }}"
                            id="is_visible" {{ $plate->is_visible ? 'checked' : '' }} />
                    </div>
                @endif
            </div>
            @error('is_visible')
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



            {{-- Description input --}}
            <div class="mb-3">
                <label for="description" class="form-label ">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="5" placeholder="add the description">{{ old('description', $plate->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- price input --}}
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" placeholder="add the price"
                    value="{{ old('price', $plate->price) }}" />
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" onclick="form.submit(); disabled=true;">
                Submit
            </button>
            {{-- <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Back</a> --}}

        </form>
    </div>
@endsection

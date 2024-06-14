@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Add a new plate</h1>
        @include('partials.validation-errors')
        <form action="{{ route('admin.plates.store') }}" method="post" enctype="multipart/form-data">
            @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

            {{-- name input --}}
            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="add the name" value="{{ old('name') }}" />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- In Evidence input --}}
            <div class="mb-3 d-flex gap-4">
                <div class="form-check">
                    <label class="form-check-label" for="is_visible"> Is visible
                    </label>
                    <input name="is_visible" class="form-check-input" type="checkbox" value="1" id="is_visible"
                        {{ old('is_visible') ? 'checked' : '' }} />
                </div>
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
                    rows="5" placeholder="add the description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- price input --}}
            <div class="mb-3">
                <label for="price" class="form-label">price</label>
                <input type="text" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" placeholder="add the price"
                    value="{{ old('price') }}" />
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Submit
            </button>
            {{-- <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Back</a> --}}

        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">

            @foreach ($plates as $plate)
                <div class="col">
                    <div class="card card-body">

                        <h5>{{ $plate->name }}</h5>
                        <img src="{{ asset('storage/' . $plate->image) }}" alt="">
                        <div><strong>Prezzo: </strong>{{ $plate->price }}€</div>
                        <div class="d-flex justify-content-around">
                            <a class="btn btn-warning" href="{{ route('admin.plates.edit', $plate) }}">Modifica piatto</a>
                            <a class="btn btn-danger" href="{{ route('admin.plates.destroy', $plate) }}">Elimina piatto</a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection


<style>
    .col {
        margin-bottom: 2rem;

        .card {
            background-color: black;
            color: white;
            display: flex;
            flex-direction: column;
            gap: 1rem;

            img {
                height: 200px;
                object-fit: cover;

            }

        }

    }
</style>

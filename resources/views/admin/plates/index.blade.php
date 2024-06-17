@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @include('partials.message-action')

        <div class="d-flex mb-4 gap-2">
            <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-circle-left"
                    aria-hidden="true"></i></a>
            <a class="btn btn-success" href="{{ route('admin.plates.create') }}">Aggiungi un piatto</a>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
            @foreach ($plates as $plate)
                <div class="col">
                    <div class="card card-body">

                        <h5>{{ $plate->name }}</h5>
                        @if (Str::startsWith($plate->image, 'https://'))
                            <img loading="lazy" class="w-100 rounded-top-3 " src="{{ $plate->image }}" alt="">
                        @else
                            <img loading="lazy" class="w-100 rounded-top-3 " src="{{ asset('storage/' . $plate->image) }}"
                                alt="">
                        @endif
                        <div><strong>Prezzo: </strong>{{ $plate->price }}€</div>
                        <div class="d-flex justify-content-around">
                            <a class="btn btn-warning" href="{{ route('admin.plates.edit', $plate) }}">Modifica piatto</a>

                            <a class="btn btn-danger"href="#"
                                data-bs-toggle="modal"data-bs-target="#modalId-{{ $plate->id }}">Elimina piatto</a>

                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId-{{ $plate->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId-{{ $plate->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="modalTitleId-{{ $plate->id }}">
                                                Elimina piatto
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-dark">Sei sicuro di voler eliminare questo piatto?</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Annulla
                                            </button>
                                            <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="form.submit(); disabled=true;">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

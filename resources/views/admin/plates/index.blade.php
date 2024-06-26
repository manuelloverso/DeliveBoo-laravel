@extends('layouts.app')

@section('content')
    <div class="container plates py-4">
        @include('partials.message-action')


        @if ($plates->isEmpty())
            <div class="d-flex justify-content-center pt-4 gap-2">
                <h3>Inizia la tua avventura con noi e</h3>
                <div class="d-flex mb-4 gap-2">
                    <a class="btn btn-success" href="{{ route('admin.plates.create') }}">Aggiungi il tuo primo piatto</a>
                </div>
            </div>
        @else
            <div class="d-flex mb-4 gap-2">
                <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}"><i class="fa fa-arrow-circle-left"
                        aria-hidden="true"></i></a>
                <a class="btn btn-success" href="{{ route('admin.plates.create') }}">Aggiungi un piatto</a>
            </div>

            <div class="table-responsive">
                <table class="table table-warning">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Id</th>
                            <th scope="col">Immagine</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Prezzo</th>
                            <th class="text-center" scope="col">Disponibile</th>
                            <th class="text-center" scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plates as $index => $plate)
                            <tr class="align-middle">

                                <td class="text-center" scope="row">{{ $index + 1 }}</td>

                                <td>
                                    @if (Str::startsWith($plate->image, 'https://'))
                                        <img loading="lazy" class="plate-img" src="{{ $plate->image }}" alt="">
                                    @elseif ($plate->image == null)
                                        <img class="plate-img" src="{{ Vite::asset('resources/img/plate-default.jpg') }}"
                                            alt="">
                                    @else
                                        <img loading="lazy" class=" plate-img" src="{{ asset('storage/' . $plate->image) }}"
                                            alt="">
                                    @endif
                                </td>

                                <td><strong>{{ strtoupper($plate->name) }}</strong></td>

                                <td><strong>{{ $plate->price }}€</strong></td>

                                <td class="text-center">
                                    @if ($plate->is_visible)
                                        <i class="fa-solid fa-circle-check text-success fs-4"></i>
                                    @else
                                        <i class="fa-solid fa-circle-xmark text-danger fs-4"></i>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{ route('admin.plates.edit', $plate) }}"><i
                                            class="fa-solid fa-pen"></i></a>
                                    <a class="btn btn-danger text-dark"href="#"
                                        data-bs-toggle="modal"data-bs-target="#modalId-{{ $plate->id }}"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>

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
                                        <div class="modal-body text-dark">Sei sicuro di voler eliminare questo piatto?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Annulla
                                            </button>
                                            <form action="{{ route('admin.plates.destroy', $plate->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="form.submit(); disabled=true;">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

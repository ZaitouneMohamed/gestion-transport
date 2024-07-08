@extends('gazole.layouts.master')

@section('content')
    <div class="container font-weight-bold text-center">
        <div class="row">
            <h1></h1>
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title"><b>Numero Bon : {{ $data->n_bon }}</b></h1>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title"><b>{{ $data->camion?->matricule }}</b></h1>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title"><b>{{ $data->prix }}</b></h1>
                </div>
            </div>
        </div>
        <h1>Info List {{ $data->Info?->count() ?? 0 }}</h1>
        <div class="row">
            @forelse ($data->Info as $item)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body font-weight-bold text-center">
                            <form action="{{ route('EditInfoReparation', $item->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="reparation_id" value="{{ $data->id }}">
                                <select name="camion_id" id="citySelect" class="form-select">
                                    @foreach (\App\Models\Camion::all() as $camion)
                                        <option @if ($item->camion->id === $camion->id) selected @endif
                                            value="{{ $camion->id }}">{{ $camion->matricule }}</option>
                                    @endforeach
                                </select><br>
                                <select name="chaufeur_id" class="form-select">
                                    @foreach (\App\Models\Chaufeur::all() as $chaufeur)
                                        <option @if ($item->chaufeur->id === $chaufeur->id) selected @endif
                                            value="{{ $chaufeur->id }}">{{ $chaufeur->full_name }}</option>
                                    @endforeach
                                </select><br>
                                <input type="date" name="date" value="{{ $item->date }}" class="form-control"
                                    id="">
                                {{--  --}}
                                <p>prix</p><input type="text" name="prix" value="{{ $item->prix }}"
                                    class="form-control" id=""><br>
                                <p>Nature</p><input type="text" name="nature" value="{{ $item->nature }}"
                                    class="form-control" id=""><br>
                                {{--  --}}
                                <select name="type_id" class="form-select">
                                    @foreach (\App\Models\Natures::all() as $nature)
                                        <option @if ($item->type->id === $nature->id) selected @endif
                                            value="{{ $nature->id }}">{{ $nature->name }}</option>
                                    @endforeach
                                </select><br>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </form>
                            {{-- <form action="{{ route('DeleteBon', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger float-right">Supprimer</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
@endsection

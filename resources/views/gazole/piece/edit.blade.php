@extends('gazole.layouts.master')

@section('content')
    <h1 class="text text-center">Create New Piece</h1>
    <form class="row g-3" method="POST" action="{{ route('pieces.update', $piece->id) }}">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="inputState" class="form-label">Chaufeur</label>
            <select id="inputState" name="chaufeur_id" class="form-select">
                @foreach (\App\Models\Chaufeur::all() as $item)
                    <option value="{{ $item->id }}" @if ($item->id === $piece->chaufeur_id)  @endif>{{ $item->full_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Camion</label>
            <select id="inputState" name="camion_id" class="form-select">
                @foreach (\App\Models\Camion::all() as $item)
                    <option value="{{ $item->id }}" @if ($item->id === $piece->camion_id)  @endif>{{ $item->matricule }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">date</label>
            <input type="date" value="{{ $piece->date }}" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">piece</label>
            <input type="text" name="piece" id="" value="{{ $piece->piece }}" placeholder="piece info"
                class="form-control">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">Prix</label>
            <input type="text" name="prix" id="" placeholder="Price" value="{{ $piece->prix }}"
                class="form-control">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">Nature</label>
            <input type="text" name="nature" id="" placeholder="nature" class="form-control"
                value="{{ $piece->nature }}">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">Fournisseur</label>
            <input type="text" name="fournisseur" id="" placeholder="fournisseur"
                value="{{ $piece->fournisseur }}" class="form-control">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

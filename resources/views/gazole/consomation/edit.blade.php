@extends('gazole.layouts.master')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('consomations.update', $consomation->id) }}">
        @csrf
        @method('put')
        <div class="col-md-6">
            <label for="inputState" class="form-label">Chaufeur</label>
            <select id="inputState" name="chaufeur_id" class="form-select">
                @foreach (\App\Models\Chaufeur::all() as $item)
                    <option @if ($consomation->chaufeur = $item->full_name) selected @endif value="{{ $item->id }}">
                        {{ $item->full_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Camion</label>
            <select id="inputState" name="camion_id" class="form-select">
                @foreach (\App\Models\Camion::all() as $item)
                    <option @if ($consomation->camion = $item->matricule) selected @endif value="{{ $item->id }}">
                        {{ $item->matricule }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">ville</label>
            <input type="text" value="{{ $consomation->ville }}" name="ville" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">date</label>
            <input type="date" value="{{ $consomation->date }}" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

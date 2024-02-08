@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('camions.update', $camion->id) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">matricule *</label>
                <input type="text" name="matricule" placeholder="matricule" class="form-control" id="exampleInputPassword1"
                    value="{{ $camion->matricule }}">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">consommation *</label>
                <input type="text" name="consommation" placeholder="consomation" class="form-control"
                    value="{{ $camion->consommation }}" id="exampleInputPassword1">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">marque</label>
                <input type="text" name="marque" placeholder="marque" class="form-control" id="exampleInputPassword1"
                    value="{{ $camion->marque }}">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">genre</label>
                <input type="text" name="genre" placeholder="genre" class="form-control" id="exampleInputPassword1"
                    value="{{ $camion->gener }}">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">type_carburant</label>
                <input type="text" name="type_carburant" placeholder="type_carburant" class="form-control"
                    value="{{ $camion->type_carburant }}" id="exampleInputPassword1">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">n_chasie</label>
                <input type="text" name="n_chasie" placeholder="n_chasie" class="form-control"
                    value="{{ $camion->n_chasie }}" id="exampleInputPassword1">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">puissanse_fiscale</label>
                <input type="text" name="puissanse_fiscale" placeholder="puissanse_fiscale" class="form-control"
                    value="{{ $camion->puissanse_fiscale }}" id="exampleInputPassword1">
            </div>
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">premier_mise</label>
                <input type="date" name="premier_mise" placeholder="premier_mise" class="form-control"
                    value="{{ $camion->premier_mise }}" id="exampleInputPassword1">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

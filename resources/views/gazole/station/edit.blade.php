@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('stations.update', $station->id) }}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">station Name</label>
            <input type="text" name="name" value="{{ $station->name }}" placeholder="chaufeur name" class="form-control"
                id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">ville</label>
            <input type="text" name="ville" value="{{ $station->ville }}" placeholder="chaufeur name"
                class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">solde</label>
            <input type="text" name="solde" placeholder="station solde" class="form-control" id="exampleInputPassword1"
                value="{{ $station->solde }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant name</label>
            <input type="text" name="gerant_name" placeholder="gerant name" class="form-control"
                value="{{ $station->gerant_name }}" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant phone</label>
            <input type="text" name="gerant_phone" placeholder="gerant phone" class="form-control"
                value="{{ $station->gerant_phone }}" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant replacement name</label>
            <input type="text" name="gerant_rep_name" placeholder="gerant email" class="form-control"
                value="{{ $station->gerant_rep_name }}" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant replacement phone</label>
            <input type="text" name="gerant_rep_phone" placeholder="gerant replacement phone" class="form-control"
                value="{{ $station->gerant_rep_phone }}" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

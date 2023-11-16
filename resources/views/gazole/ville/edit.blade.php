@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('ville.update', $ville->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">ville</label>
            <input type="text" name="name" placeholder="station name" class="form-control" value="{{ $ville->name }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">km proposer</label>
            <input type="number" name="km_proposer" placeholder="km proposer" class="form-control"
                value="{{ $ville->km_proposer }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

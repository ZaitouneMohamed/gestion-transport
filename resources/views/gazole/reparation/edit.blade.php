@extends('gazole.layouts.master')

@section('content')
    <h1 class="text text-center">Edit Reparation</h1>
    <form class="row g-3" method="POST" action="{{ route('reparations.update' , $item->id) }}">
        @csrf
        @method("PUT")
        <div class="col-6">
            <label for="inputAddress" class="form-label">Numero bon</label>
            <input type="text" name="n_bon" class="form-control" id="inputAddress" value="{{ $item->n_bon }}"
                placeholder="numero bon">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">date</label>
            <input type="date" value="{{$item->date}}" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">solde</label>
            <input type="text" name="solde" id="" placeholder="solde" value="{{$item->prix}}" class="form-control">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

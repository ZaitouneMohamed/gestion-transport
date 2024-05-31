@extends('gazole.layouts.master')

@section('content')
    <h1 class="text text-center">Create New Reparation</h1>
    <form class="row g-3" method="POST" action="{{ route('reparations.store') }}">
        @csrf
        <div class="col-6">
            <label for="inputAddress" class="form-label">Numero bon</label>
            <input type="text" name="n_bon" class="form-control" id="inputAddress" placeholder="numero bon">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">solde</label>
            <input type="text" name="solde" id="" placeholder="solde" class="form-control">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

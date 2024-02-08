@extends('gazole.layouts.master')

@section('content')
    <form action="{{ route('factures.update', $facture->id) }}" method="POST">
        @csrf
        @method('PUT')
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">N bon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="n_bon" value="{{ $facture->n_bon }}"
                    aria-describedby="emailHelp">
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">date</label>
                <input type="date" class="form-control" name="date"
                    value="{{ $facture->date }}" aria-describedby="emailHelp">
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">station</label>
                <select name="station_id" id="citySelect"class="form-select">
                    @foreach (\App\Models\Station::all() as $item)
                        <option value="{{ $item->id }}" @if ($item->id === $facture->station_id) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">type</label>
                <select name="type" id="citySelect"class="form-select">
                    <option value="0" @if ($facture->type == 0) selected @endif>facture</option>
                    <option value="1" @if ($facture->type == 1) selected @endif>Espéce</option>
                </select>
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">total</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="prix"
                    value="{{ $facture->prix }}" aria-describedby="emailHelp">
            </div><br><br><br><br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

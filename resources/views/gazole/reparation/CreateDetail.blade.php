@extends('gazole.layouts.master')

@section('content')
    <h1 class="text text-center">Create Reparation Info</h1>
    <form class="row g-3" method="POST" action="{{ route('AddInfoToReparation' , $id) }}">
        @csrf

        <input type="hidden" name="reparation_id" value="{{$id}}">
        <div class="col-md-6">
            <label for="inputState" class="form-label">Chaufeur</label>
            <select id="inputState" name="chaufeur_id" class="form-select">
                @foreach (\App\Models\Chaufeur::active()->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Camion</label>
            <select id="inputState" name="camion_id" class="form-select">
                @foreach (\App\Models\Camion::active()->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->matricule }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">Prix</label>
            <input type="text" name="prix" id="" placeholder="prix" class="form-control">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">nature</label>
            <input type="text" name="nature" id="" placeholder="nature" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Type</label>
            <select id="inputState" name="type_id" class="form-select">
                @foreach (\App\Models\Natures::Bons()->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

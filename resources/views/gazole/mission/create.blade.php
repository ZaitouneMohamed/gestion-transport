@extends('gazole.layouts.master')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('missions.store') }}">
        @csrf
        {{-- @method() --}}
        <div class="col-6">
            <label for="inputAddress" class="form-label">date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
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
            <label for="inputState" class="form-label">ville</label>
            <select name="ville_id" class="form-select">
                @forelse (\App\Models\Ville::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">km Total</label>
            <input type="text" name="km_total" class="form-control">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">numero bon</label>
            <input type="text" name="numero_bon" class="form-control">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">nombre magasin</label>
            <input type="number" name="nombre_magasin" class="form-control">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">description</label>
            <textarea class="form-control" name="description" id="" rows="3"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

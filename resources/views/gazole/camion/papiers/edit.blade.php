@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('papiers.update', $papier->id) }}">
        @csrf
        @method('PUT') <!-- Use PUT method for update -->

        <div class="row">
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">Title *</label>
                <input type="text" name="title" placeholder="Papier title" class="form-control" id="exampleInputPassword1" value="{{ old('title', $papier->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Camion</label>
                <select id="inputState" name="camion_id" class="form-select">
                    @foreach (\App\Models\Camion::active()->get() as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $papier->camion_id ? 'selected' : '' }}>{{ $item->matricule }}</option>
                    @endforeach
                </select>
                @error('camion_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputAddress" class="form-label">Date Debut</label>
                <input type="date" name="date_debut" class="form-control" id="inputAddress" value="{{ old('date_debut', $papier->date_debut ? $papier->date_debut->format('Y-m-d') : '') }}">
                @error('date_debut')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputAddress" class="form-label">Date Fin</label>
                <input type="date" name="date_fin" class="form-control" id="inputAddress" value="{{ old('date_fin', $papier->date_fin ? $papier->date_fin->format('Y-m-d') : '') }}">
                @error('date_fin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

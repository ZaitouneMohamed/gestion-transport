@extends("gazole.layouts.master")

@section('content')
    <form method="POST" action="{{ route('camions.update', $camion->id) }}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">matricule</label>
            <input type="test" value="{{ $camion->matricule }}" name="matricule" placeholder="chaufeur name"
                class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">consommation</label>
            <input type="test" value="{{ $camion->consommation }}" name="consommation" placeholder="chaufeur name"
                class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

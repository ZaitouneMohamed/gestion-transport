@extends("gazole.layouts.master")

@section('content')
    <form method="POST" action="{{route('camions.store')}}" >
        @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">matricule</label>
            <input type="test" name="matricule" placeholder="matricule" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">consommation</label>
            <input type="test" name="consommation" placeholder="consomation" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

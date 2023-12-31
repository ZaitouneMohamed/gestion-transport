@extends("gazole.layouts.master")

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
            <input type="text" name="ville" value="{{ $station->ville }}" placeholder="chaufeur name" class="form-control"
                id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

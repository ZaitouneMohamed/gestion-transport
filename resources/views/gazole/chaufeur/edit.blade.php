@extends("gazole.layouts.master")

@section('content')
    <form method="POST" action="{{ route('chaufeur.update', $chaufeur->id) }}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Full Name</label>
            <input type="test" name="full_name" value="{{ $chaufeur->full_name }}" placeholder="chaufeur name"
                class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">phone number</label>
            <input type="test" name="phone" value="{{ $chaufeur->phone }}" placeholder="chaufeur numero"
                class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">CIN</label>
            <input type="test" name="cin" value="{{ $chaufeur->cin }}" placeholder="CIN" class="form-control"
                id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

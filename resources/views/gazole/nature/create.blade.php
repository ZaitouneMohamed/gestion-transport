@extends("gazole.layouts.master")

@section('content')
    <form method="POST" action="{{ route('natures.store') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">nature name</label>
            <input type="test" name="name" placeholder="nature name" class="form-control @error('name') is-invalid @enderror" id="exampleInputPassword1">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">type</label>
            <input type="test" name="type" placeholder="nature name" class="form-control @error('type') is-invalid @enderror" id="exampleInputPassword1">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

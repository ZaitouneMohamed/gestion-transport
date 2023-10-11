@extends('gazole.layouts.master')

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
            <label for="exampleInputPassword1" class="form-label">phone</label>
            <input type="text" name="phone" placeholder="chaufeur phone" value="{{ $chaufeur->phone }}"
                class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

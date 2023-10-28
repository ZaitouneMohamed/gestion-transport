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
            <label for="exampleInputPassword1" class="form-label">Code</label>
            <input type="test" name="code" value="{{ $chaufeur->code }}" placeholder="chaufeur name"
                class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">phone</label>
            <input type="text" name="phone" placeholder="chaufeur phone" value="{{ $chaufeur->phone }}"
                class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">numero 2</label>
            <input type="text" name="numero_2" placeholder="chaufeur phone" class="form-control" id="exampleInputPassword1" value="{{ $chaufeur->numero_2 }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">adresse</label>
            <input type="text" name="adresse" placeholder="chaufeur phone" class="form-control" id="exampleInputPassword1" value="{{ $chaufeur->adresse }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

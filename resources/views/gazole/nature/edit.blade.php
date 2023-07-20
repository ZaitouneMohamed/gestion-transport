@extends("gazole.layouts.master")

@section('content')
    <form method="POST" action="{{route('nature.update',$nature->id)}}" >
        @csrf
        @method("put")
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Full Name</label>
            <input type="test" name="name" value="{{$nature->name}}" placeholder="chaufeur name" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

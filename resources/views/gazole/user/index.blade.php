@extends('gazole.layouts.master')

@section('content')
    <div class="container text-center">
        <h1>create new user</h1>
        <div class="row g-3 align-items-center">
            <form action="{{route('add.users')}}" method="post">
                @csrf
                @method("post")
                <div class="d-flex">
                    <div class="col-auto">
                        <input type="text" placeholder="name" name="name" class="form-control" aria-labelledby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <input type="email" placeholder="email" name="email" class="form-control" aria-labelledby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <input type="password" placeholder="password" name="password" class="form-control" aria-labelledby="passwordHelpInline">
                    </div>
                    <input type="hidden"
                    @if (auth()->user()->hasRole('gazole'))
                        value="gazole"
                    @else
                        value="bons"
                    @endif
                    placeholder="password" name="role" class="form-control" aria-labelledby="passwordHelpInline">
                    <div class="col-auto">
                        <input type="submit" class="btn btn-success" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                    </div>
                </div>
            </form><br><br>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="d-flex">
                        {{-- <a href="{{ route('chaufeur.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                            class="fa fa-pen"></i></a>
                    <form action="{{ route('chaufeur.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

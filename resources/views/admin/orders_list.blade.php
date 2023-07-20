@extends('admin.layout.master')

@section("content")
    <h1>orders list {{$orders->count()}} </h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">product name</th>
                <th scope="col">Last</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <th scope="row">{{$item->id }}</th>
                    {{-- <td>{{Str::limit($item->product->title, 15, '...') }}</td> --}}
                    <td>@</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
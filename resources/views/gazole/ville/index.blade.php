@extends('gazole.layouts.master')

@section('content')
    <br>
    <a href="{{ route('ville.create') }}" class="btn btn-success">create new Ville</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">KM Proposer</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($villes as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->km_proposer }}</td>
                    <td class="d-flex">
                        <a href="{{ route('ville.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        @if ($item->Missions->count() > 0)
                            <form action="{{ route('ville.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $villes->links() }}
@endsection

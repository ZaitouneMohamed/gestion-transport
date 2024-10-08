@extends('gazole.layouts.master')

@section('content')
    <br>
    <h1 class="text-center">{{ $camion->matricule }} - {{ $camion->Consomations->count() }}</h1>
    <a class="btn btn-success " href="{{route('papiers.create')}}">Add Papier</a>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Date Debut</th>
                <th scope="col">Date Fin</th>
                <th scope="col">Difference</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($camion->Papiers as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->date_debut }}</td>
                    <td>{{ $item->date_fin }}</td>
                    <td>{{ $item->date_fin }}</td>
                    <td class="d-flex">
                        <a href="{{ route('papiers.edit', $item->id) }}" class="btn btn-warning mr-1">
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{ route('papiers.show', $item->id) }}" class="btn btn-success mr-1">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="{{ route('papiers.destroy', $item->id) }}" method="post" class="delete-form">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this);"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <h1 class="text-center">no Papier Found</h1>
            @endforelse
        </tbody>
    </table>
@endsection

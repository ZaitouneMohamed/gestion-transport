@extends('gazole.layouts.master')

@section('content')
    <br>
    <a href="{{ route('camions.create') }}" class="btn btn-success">create new camion</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">matricule</th>
                <th scope="col">consomation theorique</th>
                <th scope="col">marque</th>
                <th scope="col">genre</th>
                <th scope="col">type_carburant</th>
                <th scope="col">n_chasie</th>
                <th scope="col">puissanse_fiscale</th>
                <th scope="col">premier_mise</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($camions as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->matricule }}</td>
                    <td>{{ $item->consommation }}</td>
                    <td>{{ $item->marque }}</td>
                    <td>{{ $item->gener }}</td>
                    <td>{{ $item->type_carburant }}</td>
                    <td>{{ $item->n_chasie }}</td>
                    <td>{{ $item->puissanse_fiscale }}</td>
                    <td>{{ $item->premier_mise }}</td>
                    <td class="d-flex">
                        @if ($item->statue === 1)
                            <a href="{{ route('SwitchActiveModeForCamion', $item->id) }}" class="btn btn-success mr-1">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="{{ route('SwitchActiveModeForCamion', $item->id) }}" class="btn btn-danger mr-1">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif
                        <a href="{{ route('camions.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        @if ($item->Consomations->count() == 0)
                            <form action="{{ route('camions.destroy', $item->id) }}" method="post">
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
    {{ $camions->links() }}
@endsection

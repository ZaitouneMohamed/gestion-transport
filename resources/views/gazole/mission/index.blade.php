@extends('gazole.layouts.master')

@section('content')
    <br>
    <div class="row">
        <div class="col-2">
            <a href="{{ route('missions.create') }}" class="btn btn-success"><b>Create New Mission</b></a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">date</th>
                <th scope="col">chaufeur name</th>
                <th scope="col">chaufeur code</th>
                <th scope="col">trajet mission</th>
                <th scope="col">nombre magasin</th>
                <th scope="col">camion</th>
                <th scope="col">KM proposer</th>
                <th scope="col">KM total</th>
                <th scope="col">Statue</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($missions as $item)
                <tr>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->chaufeur->full_name }}</td>
                    <td>{{ $item->chaufeur->code }}</td>
                    <td>{{ $item->Ville->name }}</td>
                    <td>{{ $item->nombre_magasin }}</td>
                    <td>{{ $item->camion->matricule }}</td>
                    <td>{{ $item->Ville->km_proposer }}</td>
                    <td>{{ $item->km_total }}</td>
                    <td>
                        @if ($item->km_total - $item->Ville->km_proposer < 0)
                            <span class="badge bg-danger">{{ $item->km_total - $item->Ville->km_proposer }}</span>
                        @else
                            <span class="badge bg-success">{{ $item->km_total - $item->Ville->km_proposer }}</span>
                        @endif
                    </td>
                    <td class="d-flex">
                        <a href="{{ route('missions.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        <form action="{{ route('missions.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                    class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    {{ $missions->links() }}
@endsection

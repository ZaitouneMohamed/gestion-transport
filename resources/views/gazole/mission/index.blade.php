@extends('gazole.layouts.master')

@section('content')
    <br>
    <div class="row">
        <div class="col-2">
            <a href="{{ route('missions.create') }}" class="btn btn-success"><b>Create New Mission</b></a>
        </div>
        <div class="col-4">
            <form action="{{ route('missions.index') }}" method="POST">
                @csrf
                @method('GET')
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
        </div>
        <div class="col-4">
            excel
            <form action="{{ route('excel.exportMission') }}" method="POST">
                @csrf
                @method('POST')
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
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
                <th scope="col">numero bon</th>
                <th scope="col">KM proposer</th>
                <th scope="col">KM total</th>
                <th scope="col">Statue</th>
                <th scope="col">desciption</th>
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
                    <td>{{ $item->numero_bon }}</td>
                    <td>{{ $item->Ville->km_proposer }}</td>
                    <td>{{ $item->km_total }}</td>
                    <td>
                        @if ($item->Ville->km_proposer - $item->km_total < 0)
                            <span class="badge bg-danger">{{ $item->km_total - $item->Ville->km_proposer }}</span>
                        @else
                            <span class="badge bg-success">{{ $item->km_total - $item->Ville->km_proposer }}</span>
                        @endif
                    </td>
                    <td>
                        {{ $item->description }}
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
    <!-- Check if it's paginated before using links -->
    @if ($missions instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $missions->links() }}
    @endif
@endsection

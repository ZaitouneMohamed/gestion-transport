@extends('gazole.layouts.master')

@section('content')
    <br><br>
    <div class="row">
        <div class="col-4">
            <a href="{{ route('reparations.create') }}" class="btn btn-success">create new reparation</a>
        </div>
        <div class="col-4">
            <form action="{{ route('reparations.index') }}" method="post">
                @csrf
                @method('GET')
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
                <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="col-4">
            excel
            <form action="{{ route('excel.exportReparation') }}" method="POST">
                @csrf
                <input type="date" name="date_debut" value="<?php echo date('Y-m-d'); ?>" id="">
                <input type="date" name="date_fin" value="<?php echo date('Y-m-d'); ?>" id="">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
        </div>
    </div>
    <br>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">chaufeur</th>
                <th scope="col">camion</th>
                <th scope="col">date</th>
                <th scope="col">reparation</th>
                <th scope="col">prix</th>
                <th scope="col">nature</th>
                <th scope="col">fournisseur</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reparations as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->Chaufeur->full_name }}</td>
                    <td>{{ $item->Camion->matricule }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->reparation }}</td>
                    <td>{{ $item->prix }}</td>
                    <td>{{ $item->nature }}</td>
                    <td>{{ $item->fournisseur }}</td>
                    <td class="d-flex">
                        <a href="{{ route('reparations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        <form action="{{ route('reparations.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <h1 class="text text-center">No Reparation Found</h1>
            @endforelse
        </tbody>
    </table>
    {{ $reparations->links() }}
@endsection

@extends("gazole.layouts.master")

@section('content')
<br>
    <a href="{{ route('stations.create') }}" class="btn btn-success">create new station</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">ville</th>
                <th scope="col">solde</th>
                <th scope="col">gerant name</th>
                <th scope="col">gerant phone</th>
                <th scope="col">gerant rep name</th>
                <th scope="col">gerant rep phone</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stations as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->ville }}</td>
                    <td>{{ $item->solde }}</td>
                    <td>{{ $item->gerant_name }}</td>
                    <td>{{ $item->gerant_phone }}</td>
                    <td>{{ $item->gerant_rep_name }}</td>
                    <td>{{ $item->gerant_rep_phone }}</td>
                    <td class="d-flex">
                        <a href="{{ route('stations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        <form action="{{ route('stations.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $stations->links() }}
@endsection

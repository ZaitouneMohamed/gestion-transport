@extends("gazole.layouts.master")

@section('content')
    <br>
    <a href="{{ route('chaufeur.create') }}" class="btn btn-success">create new chaufeur</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">phone</th>
                <th scope="col">consomation</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chaufeurs as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->full_name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->Consomations->count() }}</td>
                    <td class="d-flex">
                        <a href="{{ route('chaufeur.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        @if ($item->Consomations->count() == 0)
                            <form action="{{ route('chaufeur.destroy', $item->id) }}" method="post">
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
    {{ $chaufeurs->links() }}
@endsection

@extends("gazole.layouts.master")

@section('content')
    <br>
    <a href="{{ route('natures.create') }}" class="btn btn-success">create new nature</a>
    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">type</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($natures as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td class="d-flex">
                        <a href="{{ route('natures.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        <form action="{{ route('natures.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $natures->links() }}
@endsection

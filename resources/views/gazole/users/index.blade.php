@extends('gazole.layouts.master')

@section('content')
    <div class="container text-center">
        <a href="{{ route('users.create') }}" class="btn btn-success">Create New User</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="d-flex">
                        <a href="{{ route('users.edit', $item) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        <form action="{{ route('users.destroy', $item) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"  onclick="confirmDelete(this);"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
<script>
    function confirmDelete(button) {
        if (confirm('Are you sure you want to delete this item?')) {
            button.closest('form').submit(); // Submit the form if confirmed
        }
    }
</script>
@endsection

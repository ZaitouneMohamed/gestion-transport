@extends('gazole.layouts.master')

@section('content')
    <br>
    <a href="{{ route('papiers.create') }}" class="btn btn-success">Create New Papier</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Camion</th>
                <th scope="col">Date Debut</th>
                <th scope="col">Date Fin</th>
                <th scope="col">Difference</th> <!-- New column for difference -->
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->Camion->matricule }}</td>
                    <td>{{ $item->date_debut }}</td>
                    <td>{{ $item->date_fin }}</td>
                    <td>
                        @if ($item->difference < 0)
                            <span class="text-danger">Expired</span>
                        @else
                            {{ $item->difference }} days
                        @endif
                    </td>
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
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
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

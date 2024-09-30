@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('papiers.update', $papier->id) }}">
        @csrf
        @method('PUT') <!-- Use PUT method for update -->

        <div class="row">
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">Title *</label>
                <input type="text" name="title" placeholder="Papier title" class="form-control" id="exampleInputPassword1"
                    value="{{ old('title', $papier->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputState" class="form-label">Camion</label>
                <select id="inputState" name="camion_id" class="form-select">
                    @foreach (\App\Models\Camion::active()->get() as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $papier->camion_id ? 'selected' : '' }}>
                            {{ $item->matricule }}</option>
                    @endforeach
                </select>
                @error('camion_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputAddress" class="form-label">Date Debut</label>
                <input type="date" name="date_debut" class="form-control" id="inputAddress"
                    value="{{ old('date_debut', $papier->date_debut ? $papier->date_debut->format('Y-m-d') : '') }}">
                @error('date_debut')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputAddress" class="form-label">Date Fin</label>
                <input type="date" name="date_fin" class="form-control" id="inputAddress"
                    value="{{ old('date_fin', $papier->date_fin ? $papier->date_fin->format('Y-m-d') : '') }}">
                @error('date_fin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">description</label>
                <textarea class="form-control" id="body" placeholder="Enter the Description" name="description">{{ $papier->description }}</textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section("style")
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endsection
@section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endsection

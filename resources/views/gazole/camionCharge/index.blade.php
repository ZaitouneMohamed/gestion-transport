@extends('gazole.layouts.master')

@section('content')
    <br>
    <h1 class="text-center">{{ $camion->matricule }} - {{ $camion->Consomations->count() }}</h1>
    <button class="btn btn-success " data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Charge</button>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">matricule</th>
                <th scope="col">chaufeur</th>
                <th scope="col">nature</th>
                <th scope="col">date</th>
                <th scope="col">Location</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($camion->Charge as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->camion->matricule }}</td>
                    <td>{{ $item->chaufeur->full_name }}</td>
                    <td>{{ $item->nature }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->prix_location }}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('camion.deleteCharge', $item) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <h1 class="text-center">no Charge Found</h1>
            @endforelse
        </tbody>
    </table>
    {{-- {{ $camions->links() }} --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $camion->matricule }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('camion.AddNewCharge') }}" method="POST">
                        @csrf
                        <input type="hidden" name="camion_id" value="{{ $camion->id }}">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">chaufeur :</label>
                            <select name="chaufeur_id" id="citySelect"class="form-select">
                                @foreach ($chaufeurs as $item)
                                    <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">date :</label>
                            <input type="date" name="date" class="form-control" id=""
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">nature :</label>
                            <select name="nature" id="citySelect"class="form-select">
                                @foreach ($natures as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="col-form-label">nature :</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" value="no"
                                    name="nature" checked>
                                <label for="customRadio1" class="custom-control-label">noo</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2" name="nature"
                                    value="yes">
                                <label for="customRadio2" class="custom-control-label">yes</label>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="col-form-label">Location Prix :</label>
                            <input type="text" name="prix_location" class="form-control" id="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

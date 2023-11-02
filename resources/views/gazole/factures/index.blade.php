@extends('gazole.layouts.master')

@section('content')
    <div x-show="page === 'crud'" x-transition>
        <h3 class="text text-center">factures crud</h3>
        <form action="{{ route('factures.store') }}" method="POST">
            @csrf
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">N bon</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="n_bon"
                        aria-describedby="emailHelp">
                </div>
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">date</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="date"
                        aria-describedby="emailHelp">
                </div>
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">station</label>
                    <select name="station_id" id="citySelect"class="form-select">
                        @foreach (\App\Models\Station::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">total</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="prix"
                        aria-describedby="emailHelp">
                </div><br><br><br><br>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        <form action="{{ route('factures.index') }}" method="POST">
            @csrf
            @method('GET')
            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
            <input type="submit" value="submit" class="btn btn-success">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">date</th>
                    <th scope="col">numero bon</th>
                    <th scope="col">station</th>
                    <th scope="col">prix</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->n_bon }}</td>
                        <td>{{ $item->station->name }}</td>
                        <td>{{ $item->prix }}</td>
                        <td class="d-flex">
                            <a href="{{ route('factures.edit', $item->id) }}" class="btn btn-warning"><i
                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                            <form action="{{ route('factures.destroy', $item->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

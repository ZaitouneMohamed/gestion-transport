@extends('gazole.layouts.master')

@section('content')
    <div class="container font-weight-bold text-center">
        <div class="row">
            <h1></h1>
            <div class="col-3">
                <div class="card text-center">
                    <h1 class="card-title"><b>papier name : {{ $papier->title }}</b></h1>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-center">
                    <h1 class="card-title"><b>Camion : {{ $papier->camion?->matricule }}</b></h1>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-center">
                    <h1 class="card-title"><b>debut : {{ $papier->date_debut }}</b></h1>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-center">
                    <h1 class="card-title"><b>Fin : {{ $papier->date_fin }}</b></h1>
                </div>
            </div>
            <div class="col-12">
                <h1 class="card-title"><b>{!! $papier->description !!}</b></h1>
            </div>
        </div>

    </div>
@endsection

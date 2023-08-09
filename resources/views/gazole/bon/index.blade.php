@extends('gazole.layouts.master')

@section('content')
    <div class="container font-weight-bold text-center">
        <div class="row">
            <h1>Trajet de</h1>
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title"><b>{{ $trajet->chaufeur->full_name }}</b></h1>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title"><b>{{ $trajet->camion->matricule }}</b></h1>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title"><b>{{ $trajet->ville }}</b></h1>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-4">
                <div class="card">
                    <h2 class="card-title"><b>Trajet Composet : {{ $trajet->QtyLittre }}</b></h2>
                    <h2 class="card-title"><b>Km Total : {{ $trajet->KmTotal }}</b></h2>
                    <h2 class="card-title"><b>Taux : {{ number_format($trajet->Taux, 2) }}</b></h2>
                    <h2 class="card-title"><b>Statue :</b> <span
                            class="badge
                    @if ($trajet->statue > 0) bg-danger
                    @else
                    bg-success @endif
                    ">{{ number_format($trajet->Statue, 2) }}</span>
                    </h2>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h2 class="card-title"><b>KM total : {{ $trajet->bons->sum('km') }}</b></h2>
                    <h2 class="card-title"><b>Prix Total : {{ $trajet->bons->sum('prix') }}</b></h2>
                    <h2 class="card-title"><b>Station : {{ $trajet->bons->count() }}</b></h2>
                    <h2 class="card-title"><b>Camion Consomation : {{ $trajet->camion->id }}</b></h2>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
        <h1>Bons List {{ $trajet->bons->count() }}</h1><a href="{{ route('createBon', $trajet->id) }}"
            class="btn btn-success">Add Bon</a>
        <div class="row">
            @foreach ($trajet->bons as $item)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body font-weight-bold text-center">
                            <form action="{{ route('UpdateBon', $item->id) }}" method="post">
                                @csrf
                                @method('post')
                                <h5>N Bon : {{ $item->numero_bon }}</h5>
                                <h5>{{ $item->date }}</h5>
                                <p>QTE littre</p><input type="text" name="qte" value="{{ $item->qte_litre }}"
                                    id="">
                                <p>prix</p><input type="text" name="prix" value="{{ $item->prix }}" id="">
                                <p>KM :</p> <input type="text" name="km" value="{{ $item->km }}"
                                    id="">
                                <h5>Station : {{ $item->Station->name }}</h5>
                                <h5>nature : {{ $item->nature }}</h5>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </form>
                            <form action="{{ route('DeleteBon', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger float-right">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

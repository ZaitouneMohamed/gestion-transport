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
                    {{-- <h2 class="card-title"><b>KM total : {{ $trajet->bons->sum('km') }}</b></h2> --}}
                    <h2 class="card-title"><b>Prix Total : {{ $trajet->Prix }}</b></h2>
                    <h2 class="card-title"><b>Station : {{ $trajet->bons->count() }}</b></h2>
                    <h2 class="card-title"><b>Camion Consomation : {{ $trajet->camion->consommation }}</b></h2>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h1 class="card-title"><b>description</b></h1>
                    <h1 class="card-title">{{ $trajet->description }}</h1>
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
                                <input type="hidden" name="numero_bon" value="{{ $item->numero_bon }}">
                                <h5>N Bon : {{ $item->numero_bon }}</h5>
                                <input type="date" name="date" value="{{ $item->date }}" id="">
                                <p>QTE littre</p><input type="text" name="qte" value="{{ $item->qte_litre }}"
                                    id="">
                                <h5>tarif : {{ number_format($item->prix / $item->qte_litre, 2) }}</h5>
                                <p>prix</p><input type="text" name="prix" value="{{ $item->prix }}" id="">
                                <p>KM :</p> <input type="text" name="km" value="{{ $item->km }}"
                                    id="">
                                <p>Station : </p>
                                <select name="station" id="citySelect"class="form-select">
                                    <option>shoose</option>
                                    @foreach (\App\Models\Station::all() as $station)
                                        <option @if ($item->Station->id === $station->id) selected @endif
                                            value="{{ $station->id }}">{{ $station->name }}</option>
                                    @endforeach
                                </select>
                                <h5>nature : {{ $item->nature }}</h5>
                                @if ($item->description)
                                    autre : {{ $item->description }} <br>
                                @endif
                                <div class="col-md-6">
                                    <select name="type" id="citySelect"class="form-select">
                                        <option value="noo">noo</option>
                                        <option value="yes">yes</option>
                                    </select>
                                </div>
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

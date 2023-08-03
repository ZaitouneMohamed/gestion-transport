@extends('gazole.layouts.master')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-4">
                <div class="card">
                    <h2 class="card-title">Trajet Composet : {{ $trajet->QtyLittre }}</h2>
                    <h2 class="card-title">Km Total : {{ $trajet->KmTotal }}</h2>
                    <h2 class="card-title">Taux : {{ $trajet->Taux }}</h2>
                    <h2 class="card-title">Statue : <span
                            class="badge
                    @if ($trajet->statue > 0) bg-danger
                    @else
                    bg-success @endif
                    ">{{ $trajet->Statue }}</span>
                    </h2>
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <h1>Bons List {{ $trajet->bons->count() }}</h1>
            @foreach ($trajet->bons as $item)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

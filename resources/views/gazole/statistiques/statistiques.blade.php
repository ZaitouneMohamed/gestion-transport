@extends('gazole.layouts.master')

@section('content')
    <div x-data="{ page: 'chauffeur' }">
        <br>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-primary" x-on:click="page = 'chauffeur'">chauffeur</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" x-on:click="page = 'camion'">camion</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" x-on:click="page = 'station'">station</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" x-on:click="page = 'trajet'">trajet</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" x-on:click="page = 'bons'">bons</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" x-on:click="page = 'mission'">mission</button>
            </div>
        </div>
        <div x-show="page === 'chauffeur'" x-transition>
            <livewire:statistiques.chaufeur />
        </div>
        <div x-show="page === 'camion'" x-transition>
            <livewire:statistiques.camion />
        </div>
        <div x-show="page === 'station'" x-transition>
            <livewire:statistiques.station />
        </div>
        <div x-show="page === 'trajet'" x-transition>
            <livewire:statistiques.trajet />
        </div>
        <div x-show="page === 'bons'" x-transition>
            <livewire:statistiques.bons />
        </div>
        <div x-show="page === 'mission'" x-transition>
            <livewire:statistiques.mission />
        </div>
    </div>
@endsection

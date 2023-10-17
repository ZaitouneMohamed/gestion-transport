@extends('gazole.layouts.master')

@section('content')
    <!-- /.content -->
    <div x-data="{ page: 'search' }">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <button class="btn btn-primary" x-on:click="page = 'search'">factures statistiques</button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" x-on:click="page = 'total'">Total Generale</button>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div x-show="page === 'search'" x-transition>
            <livewire:factures.search />
        </div>
        <div x-show="page === 'total'" x-transition>
            <livewire:factures.total-generale />
        </div>
    </div>
@endsection

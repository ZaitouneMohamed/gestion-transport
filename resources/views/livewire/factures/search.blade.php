<div x-show="page === 'search'" x-transition>
    <h3 class="text text-center">factures statistique</h3>
    <div class="row">
        <div class="col-md-12">
            <label for="inputState" class="form-label">Camion</label>
            <select id="inputState" wire:model="station" class="form-select">
                <option value=""></option>
                @foreach (\App\Models\Station::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="inputState" class="form-label">Date Debut</label>
            <input type="date" wire:model="datedebut" class="form-control" id="">
        </div>
        <div class="col-6">
            <label for="inputState" class="form-label">Date Fin</label>
            <input type="date" wire:model="datefin" class="form-control" id="">
        </div>
    </div><br>
    <div wire:loading>
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @if ($station)
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title">bons : {{ $factures->count() }} </h1>
                    <h1 class="card-title">prix : {{ $factures->sum('prix') }} </h1>
                    {{-- @php
                        $full_price = 0;
                    @endphp
                    @foreach ($trajets as $item)
                        @php
                            $full_price += $item->Prix;
                        @endphp
                    @endforeach
                    <h2 class="card-title">consomation : {{ $full_price }} </h2> --}}
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">station</th>
                    <th scope="col">n bon</th>
                    <th scope="col">Date</th>
                    <th scope="col">total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->station->name }}</td>
                        <td>{{ $item->n_bon }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->prix }}</td>
                        <td class="d-flex">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text text-center">Please Shoose a station</h3>
    @endif
</div>

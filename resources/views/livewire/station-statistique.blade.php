<div>
    <h1 class="text text-center">statistiques of Station</h1>
    <div class="row">
        <div class="col">
            {{-- <input type="number" name="" wire:model="camion" id=""> --}}
            <select wire:model="station" class="form-select" aria-label="Default select example">
                    <option></option>
                @foreach (\App\Models\Station::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <input type="date" class="form-control" wire:model="date_debut">
        </div>
        <div class="col">
            <input type="date" class="form-control" wire:model="date_fin" >
        </div>
    </div>

    @if ($station)
        <h1 class="text text-center">{{ \App\Models\Station::find($station)->name }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">consomation reelle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->Consomations as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ ($item->qte_litre / ($item->km_return - $item->km_depart)) * 100 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text text-center">no station selected</h1>
    @endif

</div>

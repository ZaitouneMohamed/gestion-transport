<div>
    <h1 class="text text-center">statistiques of camion</h1>
    <div class="row">
        <div class="col">
            {{-- <input type="number" name="" wire:model="camion" id=""> --}}
            <select wire:model="camion" class="form-select" aria-label="Default select example">
                <option></option>
                @foreach (\App\Models\Camion::select('matricule', 'id')->get()->unique('matricule') as $item)
                    <option value="{{ $item->id }}">{{ $item->matricule }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <input type="date" class="form-control" wire:model="date_debut">
        </div>
        <div class="col">
            <input type="date" class="form-control" wire:model="date_fin">
        </div>
    </div>

    @if ($camion)
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">camion</th>
                    <th scope="col">chaufeur</th>
                    <th scope="col">km total</th>
                    <th scope="col">consomation</th>
                    <th scope="col">consomation reelle</th>
                    <th scope="col">consomation theorique</th>
                    <th scope="col">ecart</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->Consomations as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->camion->matricule }}</td>
                        <td>{{ $item->chaufeur->full_name }}</td>
                        <td>{{ $item->km_return - $item->km_depart }}</td>
                        <td>{{ $item->qte_litre }}</td>
                        <td>{{ ($item->qte_litre / ($item->km_return - $item->km_depart)) * 100 }}</td>
                        <td>{{ (($item->km_return - $item->km_depart) / 100) * 15 }}</td>
                        <td>{{ $item->qte_litre - (($item->km_return - $item->km_depart) / 100) * 15 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text text-center">no camion selected</h1>
    @endif

</div>

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
                    <th scope="col">Trajet Compose</th>
                    <th scope="col">KM Total</th>
                    <th scope="col">Taux</th>
                    <th scope="col">ecart</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->Consomations as $item)
                    <tr>
                        <th scope="row">{{ $item->Camion->id }}</th>
                        <td>{{ $item->camion->matricule }}</td>
                        <td>{{ $item->chaufeur->full_name }}</td>
                        <td>
                            @if ($item->Bons->where('nature',"gazole")->count() > 2)
                                {{ $item->QtyLittre }}
                            @endif
                        </td>
                        <td>
                            @if ($item->Bons->where('nature',"gazole")->count() > 2)
                                {{ $item->KmTotal }}
                            @endif
                        </td>
                        <td>
                            @if ($item->Bons->where('nature',"gazole")->count() > 2)
                                {{ ($item->QtyLittre  / $item->KmTotal) * 100 }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text text-center">no camion selected</h1>
    @endif

</div>

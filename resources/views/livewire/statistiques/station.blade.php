<div>
    <h3 class="text text-center">station statistique</h3>
    <div class="row">
        <div class="col-md-6">
            <label for="inputState" class="form-label">Stations</label>
            <select id="inputState" wire:model="station" class="form-select">
                <option value=""></option>
                @foreach (\App\Models\Station::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Nature</label>
            <select id="inputState" wire:model="nature" class="form-select">
                <option value="gazole">gazole</option>
                <option value="Autoroute">Autoroute</option>
                <option value="autre">Autre</option>
                <option value="achat piece">Achat Piece</option>
                <option value="Huile">Huile</option>
                <option value="sayah">Sayah</option>
                <option value="Espece">Espece</option>
                <option value="credit">Credit</option>
                <option value="amandes">Amandes</option>
                <option value="hakim">Hakim</option>
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
    @if ($nature & $station)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">numero bon</th>
                    <th scope="col">camion</th>
                    <th scope="col">prix</th>
                    <th scope="col">date</th>
                    <th scope="col">qte littre</th>
                    <th scope="col">station</th>
                    <th scope="col">km</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stations as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->numero_bon }}</td>
                        <td>{{ $item->Consomation->camion->matricule }}</td>
                        <td>{{ $item->prix }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->qte_litre }}</td>
                        <td>{{ $item->Station->id }}</td>
                        <td>{{ $item->km }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @else

    @endif
</div>

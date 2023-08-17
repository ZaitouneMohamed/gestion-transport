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
                <option value=""></option>
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
                <option value="Lavage">Lavage</option>
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
    <div class="row">
        <div class="col-4">
            <div class="card text-center">
                <h1 class="card-title">Bons List : {{ $bons->count() }} </h1>
                @php
                    $full_price = 0;
                @endphp
                @foreach ($bons->unique('consomation_id') as $item)
                    @php
                        $full_price += $item->Consomation->FullPrix;
                    @endphp
                @endforeach
                <h2 class="card-title">consomation : {{ $full_price; }} </h2>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">T.ville</th>
                <th scope="col">T.date</th>
                <th scope="col">numero bon</th>
                <th scope="col">camion</th>
                <th scope="col">chaufeur</th>
                <th scope="col">km</th>
                <th scope="col">nature</th>
                <th scope="col">qte littre</th>
                <th scope="col">prix</th>
                <th scope="col">date</th>
                <th scope="col">station</th>
                <th scope="col">Autre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bons as $item)
                <tr>
                    <th scope="row">{{ $item->consomation->id }}</th>
                    <td>{{ $item->consomation->ville }}</td>
                    <td>{{ $item->consomation->date }}</td>
                    <td>{{ $item->numero_bon }}</td>
                    <td>{{ $item->Consomation->camion->matricule }}</td>
                    <td>{{ $item->Consomation->chaufeur->full_name }}</td>
                    <td>{{ $item->km }}</td>
                    <td>{{ $item->nature }}</td>
                    <td>{{ $item->qte_litre }}</td>
                    <td>{{ $item->prix }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->Station->name }}</td>
                    <td>
                        @if ($item->description)
                            <details>
                                <summary>{{ Str::limit($item->description, 10, '...') }}</summary>
                                <p>{{ $item->description }}</p>
                            </details>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

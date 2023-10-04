<div>
    <h3 class="text text-center">Trajet statistique</h3>
    <div class="row">
        <div class="col-md-12">
            <label for="inputState" class="form-label">ville</label>
            <select name="ville" wire:model="ville" class="form-select">
                <option value=""></option>
                <option value="Agadir">Agadir</option>
                <option value="Al Hoceima">Al Hoceima</option>
                <option value="Azilal">Azilal</option>
                <option value="Beni Mellal">Beni Mellal</option>
                <option value="Ben Slimane">Ben Slimane</option>
                <option value="Boulemane">Boulemane</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Chaouen">Chaouen</option>
                <option value="El Jadida">El Jadida</option>
                <option value="El Kelaa des Sraghna">El Kelaa des Sraghna</option>
                <option value="Er Rachidia">Er Rachidia</option>
                <option value="Essaouira">Essaouira</option>
                <option value="Fes">Fes</option>
                <option value="Figuig">Figuig</option>
                <option value="Guelmim">Guelmim</option>
                <option value="Ifrane">Ifrane</option>
                <option value="Kenitra">Kenitra</option>
                <option value="Khemisset">Khemisset</option>
                <option value="Khenifra">Khenifra</option>
                <option value="Khouribga">Khouribga</option>
                <option value="Laayoune">Laayoune</option>
                <option value="Larache">Larache</option>
                <option value="Marrakech">Marrakech</option>
                <option value="Meknes">Meknes</option>
                <option value="Nador">Nador</option>
                <option value="Ouarzazate">Ouarzazate</option>
                <option value="Oujda">Oujda</option>
                <option value="Rabat-Sale">Rabat-Sale</option>
                <option value="Safi">Safi</option>
                <option value="Settat">Settat</option>
                <option value="Sidi Kacem">Sidi Kacem</option>
                <option value="Tangier">Tangier</option>
                <option value="Tan-Tan">Tan-Tan</option>
                <option value="Taounate">Taounate</option>
                <option value="Taroudannt">Taroudannt</option>
                <option value="Tata">Tata</option>
                <option value="Taza">Taza</option>
                <option value="Tetouan">Tetouan</option>
                <option value="Tiznit">Tiznit</option>
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
    @if ($ville)
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title">Trajet : {{ $trajets->count() }} </h1>
                    @php
                        $full_price = 0;
                        $full_pricee = 0;
                    @endphp
                    @foreach ($trajets as $item)
                        @php
                            // $full_price += $item->Bons->sum('prix');
                            $full_price += $item->Prix;
                            $full_pricee += $item->FullPrix;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Chaufeur</th>
                    <th scope="col">camion</th>
                    <th scope="col">ville</th>
                    <th scope="col">Trajet Compose</th>
                    <th scope="col">KM Total</th>
                    <th scope="col">Taux</th>
                    <th scope="col">camion comsommation</th>
                    <th scope="col">Statue</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trajets as $item)
                    @php
                        if ($item->Bons->count() > 1) {
                            $km_total = $item->Bons->last()->km - $item->Bons->first()->km;
                        }
                    @endphp
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->chaufeur->full_name }}</td>
                        <td>{{ $item->camion->matricule }}</td>
                        <td>{{ $item->ville }}</td>
                        <td>
                            @if ($item->Bons->where('nature', 'gazole')->count() >= 2)
                                {{ $item->QtyLittre }}
                            @endif
                        </td>
                        <td>
                            @if ($item->Bons->where('nature', 'gazole')->count() > 1)
                                {{ $item->KmTotal }}
                            @endif
                        </td>
                        <td>
                            @if ($item->Bons->where('nature', 'gazole')->count() > 1)
                                {{ number_format($item->Taux, 2) }}
                            @endif
                        </td>
                        <td>
                            {{ $item->Camion->consommation }}
                        </td>
                        <td>
                            <span
                                class="badge
                            @if ($item->statue > 0) bg-danger
                            @else
                            bg-success @endif
                            ">{{ number_format($item->Statue, 2) }}</span>
                        </td>
                        <td>
                            {{ $item->Prix }}
                        </td>
                        <td>
                            {{ $item->date }}
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('createBon', $item->id) }}" title="Add Bons Here"
                                class="btn btn-success mr-1"><b><i class="fa fa-plus"></i></b></a>
                            <a href="{{ route('consomations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                    class="fa fa-pen"></i></a>
                            <a href="{{ route('getBons', $item->id) }}" class="btn btn-info mr-1"><i class="fa fa-eye"></i></a>
                            <form action="{{ route('consomations.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @else
        <h3 class="text text-center">Please Shoose a chaufeur</h3>
    @endif
</div>

<div>
    <h3 class="text text-center">Mission Statistique</h3>
    <div class="row">
        <div class="col-md-12">
            <label for="inputState" class="form-label">chaufeur</label>
            <select id="inputState" wire:model="chaufeur" class="form-select">
                <option value=""></option>
                @foreach (\App\Models\Chaufeur::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->full_name }}</option>
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
    @if ($chaufeur)
        <div class="row">
            <div class="col-4">
                {{-- <div class="card text-center">
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
                    @if ($chaufeur == 24 || $chaufeur == 23)
                        <h2 class="card-title">consomation : {{ $full_pricee }} </h2>
                    @else
                        <h2 class="card-title">consomation : {{ $full_price }} </h2>
                    @endif
                </div> --}}
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
                @forelse ($missions as $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->chaufeur->full_name }}</td>
                        <td>{{ $item->chaufeur->code }}</td>
                        <td>{{ $item->Ville->name }}</td>
                        <td>{{ $item->nombre_magasin }}</td>
                        <td>{{ $item->camion->matricule }}</td>
                        <td>{{ $item->numero_bon }}</td>
                        <td>{{ $item->Ville->km_proposer }}</td>
                        <td>{{ $item->km_total }}</td>
                        <td>
                            @if ($item->Ville->km_proposer - $item->km_total < 0)
                                <span class="badge bg-danger">{{ $item->km_total - $item->Ville->km_proposer }}</span>
                            @else
                                <span class="badge bg-success">{{ $item->km_total - $item->Ville->km_proposer }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->description)
                                <details>
                                    <summary>{{ Str::limit($item->description, 10, '...') }}</summary>
                                    <p>{{ $item->description }}</p>
                                </details>
                            @endif
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('missions.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                    class="fa fa-pen"></i></a>
                            <form action="{{ route('missions.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>
    @else
        <h3 class="text text-center">Please Shoose a chaufeur</h3>
    @endif
</div>

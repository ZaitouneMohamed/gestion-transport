<div>
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
</div>

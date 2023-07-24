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
                    <th scope="col">Chaufeur</th>
                    <th scope="col">camion</th>
                    <th scope="col">ville</th>
                    <th scope="col">Trajet Compose</th>
                    <th scope="col">KM Total</th>
                    <th scope="col">Taux</th>
                    <th scope="col">camion comsommation</th>
                    <th scope="col">Statue</th>
                    <th scope="col">Prix</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->Consomations as $item)
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
                                {{ $item->Taux }}
                            @endif
                        </td>
                        <td>
                            {{ $item->Camion->consommation }}
                        </td>
                        <td>
                            <span
                                class="badge
                        @if ($item->statue > 0) bg-success
                        @else
                        bg-danger @endif
                        ">{{ $item->Statue }}</span>
                        </td>
                        <td>
                            {{ $item->Prix }}
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('createBon', $item->id) }}" title="Add Bons Here"
                                class="btn btn-success mr-1"><b><i class="fa fa-plus"></i></b></a>
                            <a href="{{ route('consomations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                    class="fa fa-pen"></i></a>
                            <form action="{{ route('consomations.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text text-center">no camion selected</h1>
    @endif

</div>

<div>
    <h3 class="text text-center">camion statistique</h3>
    <div class="row">
        <div class="col-md-12">
            <label for="inputState" class="form-label">Camion</label>
            <select id="inputState" wire:model="camion" class="form-select">
                <option value=""></option>
                @foreach (\App\Models\Camion::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->matricule }}</option>
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
    @if ($camion && $datedebut && $datefin)
        <form action="{{ route('excel.ExportCamionSearch') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="date_debut" wire:model="datedebut">
            <input type="hidden" name="date_fin" wire:model="datefin">
            <input type="hidden" name="camion_id" wire:model="camion">
            <button class="btn btn-success">excel</button>
        </form>
    @endif
    <div wire:loading>
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @if ($camion)
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title">Trajet : {{ $trajets->count() }} </h1>
                    @php
                        $full_price = 0;
                    @endphp
                    @foreach ($trajets as $item)
                        @php
                            // $full_price += $item->Bons->sum('prix');
                            $full_price += $item->Prix;
                        @endphp
                    @endforeach
                    <h2 class="card-title">consomation : {{ $full_price }} </h2>
                </div>
            </div>
            <div class="col-4">
                @if ($trajets->count() > 0)
                    <div class="card text-center">
                        <h2 class="card-title">Trajet Composeé : {{ $trajets->sum('QtyLittre') }}</h2>
                        <h2 class="card-title">KM Total : {{ $trajets->sum('KmTotal') }}</h2>
                        <h1 class="card-title">New Taux :
                            {{ ($trajets->sum('QtyLittre') / $trajets->sum('KmTotal')) * 100 }}</h1>
                    </div>
                @endif
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Chaufeur</th>
                    <th scope="col">camion</th>
                    <th scope="col">ville</th>
                    <th scope="col">Trajet Compose</th>
                    <th scope="col">KM Total</th>
                    <th scope="col">KM proposer</th>
                    <th scope="col">Taux</th>
                    <th scope="col">camion consommation</th>
                    <th scope="col">Statue Gazole</th>
                    <th scope="col">Statue mission</th>
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
                        <td>{{ $item->chaufeur->full_name }} </td>
                        <td>{{ $item->camion->matricule }}</td>
                        <td>{{ $item->ville }}</td>
                        <td>
                            @if ($item->status === 1)
                                {{ $item->QtyLittre }}
                            @endif
                        </td>
                        <td>
                            @if ($item->status === 1)
                                {{ $item->KmTotal }}
                            @endif
                        </td>
                        <td>
                            @if ($item->status === 1)
                                {{ $item->km_proposer }}
                            @endif
                        </td>
                        <td>
                            @if ($item->status === 1)
                                {{ number_format($item->Taux, 2) }}
                            @endif
                        </td>
                        <td>
                            {{ $item->Camion->consommation }}
                        </td>
                        <td>
                            @if ($item->status === 1)
                                <span
                                    class="badge
                        @if ($item->statue > 0) bg-danger
                        @else
                        bg-success @endif
                        ">{{ number_format($item->Statue, 2) }}</span>
                            @endif
                        </td>
                        <td style="width: 35%">
                            @if ($item->status === 1)
                                @if ($item->km_proposer - $item->KmTotal < 0)
                                    <span class="badge bg-danger">{{ $item->km_proposer - $item->KmTotal }}</span>
                                @else
                                    <span class="badge bg-success">{{ $item->km_proposer - $item->KmTotal }}</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($item->status === 1)
                                {{ $item->Prix }}
                            @endif
                        </td>
                        <td>
                            {{ $item->date }}
                        </td>
                        <td class="d-flex">
                            @if ($item->status === 0)
                                <a href="{{ route('createBon', $item->id) }}" title="Add Bons Here"
                                    class="btn btn-success mr-1"><b><i class="fa fa-plus"></i></b></a>
                                @if ($item->Bons->where('nature', 'gazole')->count() >= 2)
                                    <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                        title="check that trajet is complete" class="btn btn-danger mr-1"><b><i
                                                class="fa-solid fa-xmark"></i></b></a>
                                @endif
                            @else
                                <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                    title="check that trajet is not complete" class="btn btn-success mr-1"><b><i
                                            class="fa-solid fa-check"></i></b></a>
                            @endif
                            <a href="{{ route('consomations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                    class="fa fa-pen"></i></a>
                            <a href="{{ route('getBons', $item->id) }}" class="btn btn-info mr-1"><i
                                    class="fa fa-eye"></i></a>
                            <form action="{{ route('consomations.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @else
        <h3 class="text text-center">Please Shoose a Camion</h3>
    @endif
</div>

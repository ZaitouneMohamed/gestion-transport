<div>
    <h3 class="text text-center">Reparation Statistiques</h3>
    <div class="row">
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
    @if ($datedebut && $datefin)
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    @php
                        $full_price = 0;
                    @endphp
                    @foreach ($reparations as $item)
                        @php
                            // $full_price += $item->Bons->sum('prix');
                            $full_price += floatval($item->prix);
                        @endphp
                    @endforeach
                    <h2 class="card-title">total : {{ $full_price }} </h2>
                </div>
            </div>
        </div>
    @endif
    @if ($datedebut && $datefin)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">chaufeur</th>
                    <th scope="col">camion</th>
                    <th scope="col">date</th>
                    <th scope="col">reparation</th>
                    <th scope="col">prix</th>
                    <th scope="col">nature</th>
                    <th scope="col">type</th>
                    <th scope="col">fournisseur</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reparations as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->Chaufeur->full_name }}</td>
                        <td>{{ $item->Camion->matricule }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->reparation }}</td>
                        <td>{{ $item->prix }}</td>
                        <td>{{ $item->nature }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->fournisseur }}</td>
                        <td class="d-flex">
                            <a href="{{ route('reparations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                    class="fa fa-pen"></i></a>
                            <form action="{{ route('reparations.destroy', $item->id) }}" method="post">
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
        <h3 class="text text-center">Please date debut and date fin</h3>
    @endif
</div>

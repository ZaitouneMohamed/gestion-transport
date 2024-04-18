<div x-show="page === 'total'" x-transition>
    <h3 class="text text-center">Total Generale</h3>
    <div class="row">
        <div class="col-12">
            <label for="inputState" class="form-label">Type</label>
            <select wire:model="type" id="" class="form-control">
                <option value="0">facture</option>
                <option value="1">Espéce</option>
                <option value="2">Caisse</option>
                <option value="">total</option>
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
    @if ($datedebut && $datefin)
        <div class="col-4">
            excel
            <form action="{{ route('excel.exportFactureTotalGenerale') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="datedebut" wire:model="datedebut">
                <input type="hidden" name="datefin" wire:model="datefin">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
        </div>
    @endif
    @if ($datedebut && $datefin)
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    <h1 class="card-title">bons : {{ $factures->count() }} </h1>
                    <h1 class="card-title">prix : {{ $factures->sum('prix') }} </h1>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">station</th>
                    <th scope="col">n bon</th>
                    <th scope="col">Date</th>
                    <th scope="col">total</th>
                    <th scope="col">type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->station->name }}</td>
                        <td>{{ $item->n_bon }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->prix }}</td>
                        <td>
                            @if ($item->type == 0)
                                facture
                            @elseif ($item->type == 1)
                                espéce
                            @else
                                caisse
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text text-center">Please Shoose a station</h3>
    @endif
</div>

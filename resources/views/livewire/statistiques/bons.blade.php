<div>
    <h3 class="text text-center">Bons statistique</h3>
    <div class="row">
        <div class="col-6">
            <label for="inputState" class="form-label">Date Debut</label>
            <input type="date" wire:model="date" class="form-control" id="">
        </div>
        <div class="col-6">
            <label for="inputState" class="form-label">numero</label>
            <input type="text" wire:model="numero" class="form-control" id="">
        </div>
    </div><br>
    <div wire:loading>
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @if ($date || $numero)
        {{-- <div class="row">
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
        </div> --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">numero bon</th>
                    <th scope="col">date</th>
                    <th scope="col">qte littre</th>
                    <th scope="col">prix</th>
                    <th scope="col">station</th>
                    <th scope="col">km</th>
                    <th scope="col">nature</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bons as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->numero_bon }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->qte_litre }}</td>
                        <td>{{ $item->prix }}</td>
                        <td>{{ $item->Station->name }}</td>
                        <td>{{ $item->km }}</td>
                        <td>{{ $item->nature }}</td>
                        <td>
                            <a href="{{ route('getBons', $item->Consomation->id) }}" class="btn btn-info mr-1"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text text-center">Please Shoose a date or numero</h3>
    @endif
</div>

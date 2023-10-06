<div x-show="page === 'crud'" x-transition>
    <h3 class="text text-center">factures crud</h3>
    <form wire:submit.prevent="AddBon">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">N bon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" wire:model="n_bon"
                    aria-describedby="emailHelp">
                @error('n_bon')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">date</label>
                <input type="date" class="form-control" id="exampleInputEmail1" wire:model="date"
                    aria-describedby="emailHelp">
                @error('date')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">station</label>
                <select wire:model="station_id" id="citySelect"class="form-select">
                    <option>shoose</option>
                    @foreach (\App\Models\Station::all() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('station_id')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <label for="exampleInputEmail1" class="form-label">total</label>
                <input type="text" class="form-control" id="exampleInputEmail1" wire:model="prix"
                    aria-describedby="emailHelp">
                @error('prix')
                    <span class="text text-danger">{{ $message }}</span>
                @enderror
            </div><br><br><br><br>
        </div>
        @if ($editing)
            <button wire:click="update()" class="btn btn-warning">update</button>
            <button wire:click="cancel()" class="btn btn-success">cancel</button>
        @else
            <button type="submit" class="btn btn-primary">Submit</button>
        @endif
    </form>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">date</th>
                <th scope="col">numero bon</th>
                <th scope="col">station</th>
                <th scope="col">prix</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factures as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->n_bon }}</td>
                    <td>{{ $item->station->name }}</td>
                    <td>{{ $item->prix }}</td>
                    <td>
                        <button class="btn btn-danger" wire:click="DeleteFacture({{ $item->id }})"><i
                                class="fa fa-trash" aria-hidden="true"></i></button>
                        <button class="btn btn-warning" wire:click="edit({{ $item->id }})"><i
                                class="fa fa-pencil" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@extends('gazole.layouts.master')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('AddBonToConsomation', $id) }}">
        @csrf
        @method("POST")
        <div class="col-6">
            <label for="inputState" class="form-label">ville *</label>
            <select name="ville" class="form-select">
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
            <label for="inputAddress" class="form-label">date *</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">qte littre *</label>
            <input type="number" name="qte_litre" class="form-control" id="inputAddress" placeholder="">
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Station *</label>
            <select id="inputState" name="station_id" class="form-select">
                @foreach (\App\Models\Station::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">KM return</label>
            <input type="number" name="km_return" class="form-control" id="inputCity">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">numeroBon</label>
            <input type="number" name="numero_bon" class="form-control" id="inputCity">
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Nature *</label>
            <select id="inputState" name="nature" class="form-select">
                <option selected>Choose...</option>
                <option value="gazole">gazole</option>
                <option value="Autoroute">Autoroute</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Autre</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

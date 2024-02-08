@extends("gazole.layouts.master")

@section('content')
    <form method="POST" action="{{route('stations.store')}}" >
        @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">station name *</label>
            <input type="test" name="name" placeholder="station name" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">ville *</label>
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
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">solde</label>
            <input type="text" name="solde" placeholder="station solde" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant name</label>
            <input type="text" name="gerant_name" placeholder="gerant name" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant phone</label>
            <input type="text" name="gerant_phone" placeholder="gerant phone" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant replacement name</label>
            <input type="text" name="gerant_rep_name" placeholder="gerant email" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">gerant replacement phone</label>
            <input type="text" name="gerant_rep_phone" placeholder="gerant replacement phone" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

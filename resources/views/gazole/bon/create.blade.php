@extends('gazole.layouts.master')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('AddBonToConsomation', $id) }}">
        @csrf
        @method('POST')
        <div class="col-6">
            <label for="inputAddress" class="form-label">date *</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control" id="inputAddress"
                placeholder="">
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Station *</label>
            <div class="d-flex">
                <select id="citySelect"class="form-select">
                    <option>shoose</option>
                    @foreach (\App\Models\Station::select('ville')->get()->unique('ville') as $item)
                        <option value="{{ $item->ville }}">{{ $item->ville }}</option>
                    @endforeach
                </select>
                <select id="stations" name="station_id" class="form-select">

                </select>

            </div>
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">qte littre *</label>
            {{-- <label for="inputAddress" class="form-label" style="margin-left: 180px">qte littre *</label> --}}
            <div class="d-flex">
                <input type="text" name="qte_litre" class="form-control" placeholder="qte littre" id="inputAddress"
                    placeholder="">
                <input type="text" name="prix" class="form-control" placeholder="prix">
            </div>
        </div>

        <div class="col-md-6">
            <label for="inputCity" class="form-label">KM return</label>
            <input type="number" name="km_return" class="form-control" id="inputCity">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">numeroBon</label>
            <input type="text" name="numero_bon" class="form-control" id="inputCity">
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label">Nature *</label>
            <select id="inputState" name="nature" class="form-select">
                <option value="gazole">gazole</option>
                <option value="Autoroute">Autoroute</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Autre</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('citySelect').addEventListener('change', function() {
            var selectedCity = this.value;
            $.ajax({
                url: '{{ route('getStations') }}',
                type: 'GET',
                data: {
                    city: selectedCity
                },
                dataType: 'json',
                success: function(response) {
                    // Update the stationsContainer with the received data
                    var stationsHtml = '';
                    response.forEach(function(station) {
                        stationsHtml += '<option value="' + station.id + '">' + station.name +
                            '</option>';
                    });
                    document.getElementById('stations').innerHTML = stationsHtml;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection

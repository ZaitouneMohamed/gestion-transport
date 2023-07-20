@extends('admin.layouts.master')

@section('content')
    <div class="container">

        <h1>admin dashboard</h1>
        @if (\App\Models\Order::count() == 0)
            <form action="{{ route('orders.import') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="col-lg-12 py-3">
                    <label for="users">Upload new commandes</label>
                    <input type="file" class="form-control" style="padding: 3px;" name="orders" required />
                </div>
                <button type="submit" class="btn btn-success" name="upload">Upload</button>
            </form>
        @endif
        @if (\App\Models\Order::count() != 0)
            <div class="container">
                <a href="{{ route('clear') }}" class="btn btn-danger">clear table</a><br>
                <a href="{{ route('getsubcategories') }}" class="btn btn-primary">get bon de commande</a>
                <a href="{{ route('recap') }}" class="btn btn-primary">get Recap</a>
                <a href="{{ route('bon_reception') }}" class="btn btn-primary">get Bon De Reception</a>
                <a href="{{ route('tickets') }}" class="btn btn-primary">Tickets</a>
            </div>
        @endif
    </div>
@endsection

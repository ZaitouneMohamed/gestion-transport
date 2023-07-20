@foreach ($category as $item)
    <br><br>
    @if ($item->category === 'Fruits et Légumes')
        @foreach (\App\Models\Order::where('category', 'Fruits et Légumes')->get()->unique('subCategory') as $item)
            <table style="width:100%; margin:20px 0">
                <tr>
                    <td style="width:100%; text-align:center;">
                        <img src="https://veryfrais.com/public/storage/restaurant/2022-09-23-632d303dc15f3.png"
                            width="180px" height="75px" />
                        <div style="font-size:10pt;">
                            <h1>bon de commande </h1> <br>
                            Phone : 0600000000 <br>
                            email : email@email.com <br>
                            adresse : adresse here <br>
                            adresse : adresse here <br>
                            casablanca gjw9 <br>
                            <div style="margin-left: 40px">
                                Nom : Hamza <br>
                                categorie : {{ $item->category }} <br>
                                Nom : Hamza <br>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <h1 style="text-align: center">{{ $item->subCategory }}</h1>
            <table style="width:100%; border-collapse:collapse">
                <thead>
                    <tr>
                        <th style="text-align: center">Referance</th>
                        <th style="text-align: center">Produit</th>
                        <th style="text-align: center">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\Order::where('subCategory', '=', $item->subCategory)->get() as $item)
                        <tr>
                            <td style="text-align: center">{{ $item->order_number }}</td>
                            <td style="text-align: center">{{ $item->product }}</td>
                            <td style="text-align: center">{{ $item->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        <br><br>
    @else
        <table style="width:100%; margin:20px 0">
            <tr>
                <td style="width:100%; text-align:center;">
                    <img src="https://veryfrais.com/public/storage/restaurant/2022-09-23-632d303dc15f3.png"
                        width="180px" height="75px" />
                    <div style="font-size:10pt;">
                        <h1>bon de commande </h1> <br>
                        Phone : 0600000000 <br>
                        email : email@email.com <br>
                        adresse : adresse here <br>
                        adresse : adresse here <br>
                        casablanca gjw9 <br>
                        <div style="margin-left: 40px">
                            Nom : Hamza <br>
                            categorie : {{ $item->category }} <br>
                            Nom : Hamza <br>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table style="width:100%; border-collapse:collapse">
            <thead>
                <tr>
                    <th style="text-align: center">Referance</th>
                    <th style="text-align: center">Produit</th>
                    <th style="text-align: center">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <h1 style="text-align: center">{{ $item->category }}</h1>
                @foreach (\App\Models\Order::where('category', '=', $item->category)->get() as $item)
                    <tr>
                        <td style="text-align: center">{{ $item->order_number }}</td>
                        <td style="text-align: center">{{ $item->product }}</td>
                        <td style="text-align: center">{{ $item->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endforeach

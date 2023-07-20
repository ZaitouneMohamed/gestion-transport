<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        .color {
            background-color: red
        }

        .center {
            text-align: center;
            margin-top: 100px
        }
        .my_td{
            border: 1px solid black;
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 2cm;
            background-color: #74c7e7;
            color: rgb(0, 0, 0);
            text-align: center;
        }
    </style>
</head>

<body>
    <table style="width:100%">
        <tr>
            <td>
                <img style="margin-top: 50px"
                    src="https://veryfrais.com/public/storage/restaurant/2022-09-23-632d303dc15f3.png" width="160px"
                    height="75px" /><br>
            </td>
            <td>
                <br><br><br>
                <br><br><br>
                <h1>Recap de livraison</h1>
            </td>
        </tr>
    </table>
    <h3 style="margin-left: 600px">{{ $date->delivery_date }}</h3>
    <table style="width:100%">
        <thead>
            <tr>
                <th class="my_td">N° Order</th>
                <th class="my_td">Nom Client</th>
                <th class="my_td">Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td class="my_td">{{ $item->order_number }}</td>
                    <td class="my_td">{{ $item->customer_name }} </td>
                    <td class="my_td" style="width: 350px"></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="my_td">signature</td>
                    <td class="my_td"></td>
                </tr>
                <br>
                <div class="page-break"></div>
            @endforeach
        </tbody>
    </table>
</body>

</html>

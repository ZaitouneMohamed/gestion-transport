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

        .my_td {
            border: 1px solid black;
            height: 120px;
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
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td class="my_td">{{ $item->order_number }}</td>
                    <td class="my_td">{{ $item->customer_name }} </td>
                    <td class="my_td">{{ $item->customer_email }} </td>
                    <td class="my_td">{{ $item->adresse }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

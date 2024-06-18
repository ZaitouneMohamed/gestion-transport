<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pdf</title>
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
        <thead>
            <tr>
                <th class="my_td">N_bon</th>
                <th class="my_td">Date</th>
                <th class="my_td">Nature</th>
                <th class="my_td">Prix</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                    <td class="my_td">{{ $item->reparation->n_bon }}</td>
                    <td class="my_td">{{ $item->date }}</td>
                    <td class="my_td">{{ $item->nature }} </td>
                    <td class="my_td">{{ $item->prix }} </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</body>

</html>

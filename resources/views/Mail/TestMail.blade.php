<!-- Mail/TestMail.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Uncompleted Trajet Mail</title>
</head>

<body>
    <h1>Trajets</h1>
    <ul>
        @foreach ($trajets as $trajet)
            <li>{{ $trajet->chaufeur->full_name }}</li>
            <li>{{ $trajet->camion->matricule }}</li>
            <li>{{ $trajet->ville }}</li>
            <li>{{ $trajet->date }}</li>
        @endforeach
    </ul>
</body>

</html>

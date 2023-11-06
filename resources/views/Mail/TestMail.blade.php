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
            <li>{{ $trajet->chaufeur->full_name }} - {{ $trajet->camion->matricule }} - {{ $trajet->ville }} - {{ $trajet->date }}</li>
        @endforeach
    </ul>
</body>

</html>

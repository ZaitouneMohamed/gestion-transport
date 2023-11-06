<!-- Mail/TestMail.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Uncompleted Trajet Mail</title>
</head>

<body>
    <h1>Trajets</h1>
    <ul>
        @forelse ($trajets as $trajet)
            <li>{{ $trajet->chaufeur->full_name }} - {{ $trajet->camion->matricule }} - {{ $trajet->ville }} -
                {{ $trajet->date }}</li>
        @empty
            <h1>all good</h1>
        @endforelse
    </ul>
</body>

</html>

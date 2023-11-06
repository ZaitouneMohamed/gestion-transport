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
            <li>{{ $trajet->id }}</li>
            <!-- Display other attributes as needed -->
        @endforeach
    </ul>
</body>

</html>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date d'échéance à venir pour votre Papier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Date d'échéance à venir pour votre Papier</h2>
        <p>Bonjour {{ $username ?? 'Utilisateur' }},</p>
        <p>Le papier suivant est bientôt dû :</p>
        <h3>{{ $papier->title }}</h3>
        <p><strong>Date d'échéance :</strong> {{ $papier->date_fin->format('j F, Y') }}</p>
        <p>Veuillez vous assurer de le compléter avant la date d'échéance.</p>
        <div class="footer">
            <p>Merci !</p>
            <p>{{ env('APP_NAME') }}</p>
        </div>
    </div>
</body>

</html>

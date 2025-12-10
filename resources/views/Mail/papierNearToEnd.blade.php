<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Alertes de papiers en cours d'expiration</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007BFF;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .header img {
            max-height: 40px;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            margin-top: 0;
            color: #333;
        }

        .papier {
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #007BFF;
            margin-bottom: 20px;
        }

        .papier h3 {
            margin: 0 0 5px;
            color: #007BFF;
        }

        .papier p {
            margin: 5px 0;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #999;
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .content, .footer {
                padding: 20px;
            }

            .papier p {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>🔔 Rappel de papiers</h1>
        </div>

        <div class="content">
            <p>Bonjour {{ $user ?? 'Utilisateur' }},</p>
            <p>Voici la liste des papiers dont la date d'échéance est proche :</p>

            @foreach ($papiers as $papier)
                <div class="papier">
                    <h3>📄 {{ $papier->title }}</h3>
                    <p><strong>📅 Date d'échéance :</strong> <span style="color: #c0392b;">{{ $papier->date_fin->format('d F Y') }}</span></p>
                    <p><strong>🚚 Camion :</strong> {{ optional($papier->camion)->matricule ?? 'Non spécifié' }}</p>

                    @php
                        $daysRemaining = $papier->days_until_next_notification;
                    @endphp

                    @if($daysRemaining === null)
                        <span class="days-remaining">ℹ️ Date non disponible</span>
                    @elseif($daysRemaining < 0)
                        <span class="days-remaining overdue">⚠️ En retard de {{ abs($daysRemaining) }} jour(s)</span>
                    @elseif($daysRemaining == 0)
                        <span class="days-remaining overdue">⚠️ Expire aujourd'hui !</span>
                    @elseif($daysRemaining == 1)
                        <span class="days-remaining">⏰ Expire demain</span>
                    @else
                        <span class="days-remaining">⏰ {{ $daysRemaining }} jour(s) restant(s)</span>
                    @endif
                </div>
            @endforeach

            <a href="{{ url('/') }}" class="cta-button">Accéder à la plateforme</a>

            <p style="margin-top: 30px;">Merci de prendre les mesures nécessaires avant la date limite.</p>
        </div>

        <div class="footer">
            Merci !<br>
            {{ config('app.name') }}<br>
            <small>Ce message a été envoyé automatiquement. Ne pas répondre à cet email.</small>
        </div>
    </div>

</body>

</html>

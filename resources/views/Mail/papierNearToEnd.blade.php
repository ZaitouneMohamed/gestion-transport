<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date d'échéance à venir</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color:#333333; margin-bottom: 10px;">📅 Date d'échéance à venir</h2>
                            <p style="margin: 0 0 20px; font-size: 16px; color: #555;">Bonjour {{ $username ?? 'Utilisateur' }},</p>

                            <p style="font-size: 16px; color: #555;">Le papier suivant est bientôt dû :</p>

                            <div style="padding: 15px; background-color: #f9f9f9; border-left: 4px solid #007BFF; margin-bottom: 20px;">
                                <h3 style="margin: 0 0 5px; color: #007BFF;">{{ $papier->title }}</h3>
                                <p style="margin: 0; font-size: 14px;"><strong>📌 Date d'échéance :</strong> {{ $papier->target_date->format('j F, Y') }}</p>
                            </div>

                            <p style="font-size: 15px; color: #555;">Veuillez vous assurer de le compléter avant la date limite.</p>

                            <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">

                            <p style="font-size: 13px; color: #999; text-align: center;">
                                Merci !<br>
                                {{ env('APP_NAME') }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>

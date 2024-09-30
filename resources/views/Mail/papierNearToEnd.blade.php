<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Papier Due Date</title>
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
        <h2>Upcoming Due Date for Your Papier</h2>
        <p>Hello {{ $papier->user->name ?? 'User' }},</p>
        <p>The following Papier entry is due soon:</p>
        <h3>{{ $papier->title }}</h3>
        <p><strong>Due Date:</strong> {{ $papier->date_fin->format('F j, Y') }}</p>
        <p>Please make sure to complete it before the due date.</p>
        <div class="footer">
            <p>Thank you!</p>
            <p>{{ env('APP_NAME') }}</p>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement expiré</title>
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .header {
            background-color: #e53935;
            color: white;
            text-align: center;
            padding: 25px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .content {
            padding: 30px 25px;
            line-height: 1.7;
        }

        .content p {
            margin: 10px 0;
        }

        .highlight {
            font-weight: bold;
            color: #e53935;
        }

        .cta {
            text-align: center;
            margin-top: 30px;
        }

        .cta a {
            background-color: #1976d2;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 500;
            display: inline-block;
        }

        .footer {
            background-color: #fafafa;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>⚠️ Abonnement expiré</h1>
    </div>

    <div class="content">
        <p>Bonjour,</p>

        <p>
            L’abonnement <span class="highlight">{{ $subscription->name }}</span>
            lié au site <span class="highlight">{{ $subscription->site->nom ?? $subscription->site_id }}</span>
            a expiré le <span class="highlight">{{ \Carbon\Carbon::parse($subscription->expiration_date)->format('d/m/Y') }}</span>.
        </p>

        <p>
            Pour éviter toute interruption de service, nous vous invitons à renouveler votre abonnement dès que possible.
        </p>

        <div class="cta">
            <a href="{{ url('/abonnements/'.$subscription->id.'/renouveler') }}">Renouveler maintenant</a>
        </div>

        <p style="margin-top: 20px;">
            Si vous avez déjà renouvelé votre abonnement, veuillez ignorer ce message.
        </p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
    </div>
</div>
</body>
</html>

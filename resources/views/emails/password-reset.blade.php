<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #f97316;
        }
        h1 {
            color: #1f2937;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #4b5563;
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
        }
        .button:hover {
            background: linear-gradient(135deg, #ea580c, #dc2626);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #9ca3af;
            font-size: 14px;
        }
        .link-text {
            word-break: break-all;
            color: #6b7280;
            font-size: 12px;
            background-color: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Travel Express</div>
        </div>

        <h1>Réinitialisation de votre mot de passe</h1>

        <p>Bonjour {{ $user->name }},</p>

        <p>Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour créer un nouveau mot de passe :</p>

        <div class="button-container">
            <a href="{{ $resetUrl }}" class="button">Réinitialiser mon mot de passe</a>
        </div>

        <div class="warning">
            <strong>Attention :</strong> Ce lien expire dans {{ $expirationMinutes }} minutes. Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet e-mail.
        </div>

        <p>Si le bouton ne fonctionne pas, copiez et collez le lien suivant dans votre navigateur :</p>
        <div class="link-text">{{ $resetUrl }}</div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Travel Express. Tous droits réservés.</p>
            <p>Cet e-mail a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>

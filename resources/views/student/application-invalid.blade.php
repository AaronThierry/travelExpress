<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lien invalide - Travel Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
        }
        .gold-text { color: #D4AF37; }
        .card {
            background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="card rounded-2xl p-8 max-w-md w-full text-center">
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-red-900/30 border border-red-700 flex items-center justify-center">
            <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-white mb-4">Lien invalide ou expiré</h1>

        <p class="text-gray-400 mb-6">
            Le lien que vous avez utilisé n'est plus valide. Il a peut-être expiré ou a été remplacé par un nouveau lien.
        </p>

        <div class="space-y-4">
            <p class="text-sm text-gray-500">
                Si vous pensez qu'il s'agit d'une erreur, veuillez contacter Travel Express pour obtenir un nouveau lien d'accès à votre dossier.
            </p>

            <a href="/" class="inline-block px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-semibold rounded-lg hover:from-amber-700 hover:to-amber-800 transition">
                Retour à l'accueil
            </a>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-800">
            <p class="text-gray-500 text-sm">Travel Express - Votre partenaire pour les études à l'étranger</p>
        </div>
    </div>
</body>
</html>

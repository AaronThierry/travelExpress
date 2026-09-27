<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Ancien(ne) étudiant(e) ou client(e) Travel Express : partagez votre expérience et évaluez notre accompagnement pour vos études, votre travail ou votre business à l'international.">
    <title>Évaluation étudiant — Partagez votre expérience | Travel Express</title>
    <link rel="icon" type="image/png" href="/images/logo/logo_travel.png">
    <link rel="shortcut icon" type="image/png" href="/images/logo/logo_travel.png">

    <!-- Google Fonts - Royal Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body { background: #080808; }
        /* Centre verticalement le formulaire (au lieu de l'alignement "haut"
           pensé pour une modale flottante sur la page d'accueil) */
        body.page-student-evaluation > div.fixed.inset-0 {
            align-items: center !important;
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
    </style>
</head>
<body class="page-student-evaluation font-sans antialiased"
      style="background:#080808;color:#f5f0e8;"
      x-data="{ evaluationModalOpen: true }"
      x-init="window.addEventListener('close-evaluation-modal', () => { evaluationModalOpen = false; })"
      x-effect="if (!evaluationModalOpen) window.location.href = '/'">

    {{-- Réutilise le même formulaire d'évaluation que la modale de la page d'accueil --}}
    @include('partials.evaluation-form-modal')

</body>
</html>

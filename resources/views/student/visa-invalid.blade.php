<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lien invalide - Travel Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold-primary: #C9A84C;
            --gold-bright:  #F0D07A;
            --gold-deep:    #8B6914;
            --gold-gradient: linear-gradient(135deg, #8B6914 0%, #C9A84C 30%, #F0D07A 50%, #C9A84C 70%, #8B6914 100%);
            --dark-0: #080808; --dark-100: #141414; --dark-200: #1C1C1C;
            --dark-300: #262626; --dark-400: #333333; --dark-500: #4A4A4A;
            --dark-600: #6B6B6B; --dark-700: #8A8A8A; --dark-800: #B0B0B0; --dark-900: #D4D4D4;
            --glow-gold: 0 0 20px rgba(201,168,76,.25), 0 0 60px rgba(201,168,76,.08);
            --glow-gold-strong: 0 0 30px rgba(201,168,76,.4), 0 0 80px rgba(201,168,76,.15);
            --r-sm:3px; --r-md:6px; --r-lg:10px; --r-xl:14px; --r-full:9999px;
            --font-display: 'Bebas Neue', sans-serif;
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'Lato', sans-serif;
            --color-success: #2ECABB;
            --color-warning: #F0B428;
            --color-danger:  #E74C3C;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--dark-800);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(201,168,76,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 70vw 50vh at 50% 50%, rgba(201,168,76,.04) 0%, transparent 70%);
            pointer-events: none;
        }

        .page-center {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        .card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            padding: 3rem 2.5rem;
            box-shadow: var(--glow-gold);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute; top: 0; left: 15%; right: 15%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.5), transparent);
        }

        .error-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(231,76,60,.1);
            border: 1px solid rgba(231,76,60,.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.75rem;
        }

        h1 {
            font-family: var(--font-display);
            font-size: 2.2rem;
            letter-spacing: .08em;
            color: var(--color-danger);
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .desc {
            font-size: 0.95rem;
            color: var(--dark-700);
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .btn-contact {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .75rem 2rem;
            background: var(--gold-gradient);
            color: #080808;
            font-family: var(--font-body);
            font-size: .85rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            border: none;
            border-radius: var(--r-lg);
            text-decoration: none;
            cursor: pointer;
            transition: box-shadow .3s, transform .2s;
        }

        .btn-contact:hover {
            box-shadow: var(--glow-gold-strong);
            transform: translateY(-2px);
        }

        .ornament {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-top: 2.5rem;
            color: var(--gold-primary);
            font-family: var(--font-display);
            font-size: .75rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            opacity: .5;
        }
        .ornament::before, .ornament::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.4), transparent);
        }
    </style>
</head>
<body>
    <div class="page-center">
        <div class="card">
            <div class="error-icon">
                <svg width="36" height="36" fill="none" stroke="#E74C3C" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>

            <h1>Lien invalide ou expiré</h1>

            <p class="desc">
                Ce lien de dossier visa n'est plus valide. Veuillez contacter Travel Express pour obtenir un nouveau lien.
            </p>

            <a href="/" class="btn-contact">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Retour à l'accueil
            </a>

            <div class="ornament">
                <span>✦</span> Travel Express <span>✦</span>
            </div>
        </div>
    </div>
</body>
</html>

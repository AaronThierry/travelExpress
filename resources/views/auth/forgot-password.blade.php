<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Travel Express</title>

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
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            background-color: var(--dark-0);
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
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201,168,76,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        .page-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
        }

        /* --- Logo --- */
        .logo-area { text-align: center; margin-bottom: 2rem; }
        .logo-link {
            display: inline-flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .logo-icon {
            width: 52px; height: 52px;
            border-radius: var(--r-lg);
            background: var(--gold-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--glow-gold);
            flex-shrink: 0;
        }
        .logo-icon svg { width: 26px; height: 26px; stroke: #080808; }
        .logo-text-block { display: flex; flex-direction: column; align-items: flex-start; }
        .logo-title {
            font-family: var(--font-display);
            font-size: 2rem;
            letter-spacing: .05em;
            line-height: 1;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .logo-subtitle {
            font-family: var(--font-body);
            font-size: 9px;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--gold-deep);
            margin-top: 3px;
        }

        /* --- Card --- */
        .auth-card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            padding: 2.25rem 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--glow-gold);
        }
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gold-gradient);
        }
        .corner {
            position: absolute;
            width: 40px; height: 40px;
            border: 2px solid rgba(201,168,76,.25);
            pointer-events: none;
        }
        .corner-tl { top:10px; left:10px; border-right:none; border-bottom:none; border-radius:var(--r-sm) 0 0 0; }
        .corner-tr { top:10px; right:10px; border-left:none; border-bottom:none; border-radius:0 var(--r-sm) 0 0; }
        .corner-bl { bottom:10px; left:10px; border-right:none; border-top:none; border-radius:0 0 0 var(--r-sm); }
        .corner-br { bottom:10px; right:10px; border-left:none; border-top:none; border-radius:0 0 var(--r-sm) 0; }

        /* --- Card icon header --- */
        .card-icon-wrap {
            width: 56px; height: 56px;
            border-radius: var(--r-full);
            background: rgba(201,168,76,.08);
            border: 1px solid rgba(201,168,76,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.1rem;
        }
        .card-icon-wrap svg { width: 26px; height: 26px; stroke: var(--gold-primary); }
        .card-header { text-align: center; margin-bottom: 1.75rem; }
        .card-title {
            font-family: var(--font-display);
            font-size: 1.9rem;
            letter-spacing: .08em;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: .5rem;
        }
        .card-subtitle {
            font-family: var(--font-body);
            font-size: 13px;
            color: var(--dark-700);
            line-height: 1.55;
        }

        /* --- Alerts --- */
        .alert { border-radius: var(--r-md); padding: .75rem 1rem; display: flex; align-items: center; gap: .6rem; margin-bottom: 1.25rem; }
        .alert.hidden { display: none; }
        .alert-success { background: rgba(46,202,187,.08); border: 1px solid rgba(46,202,187,.3); }
        .alert-success svg { stroke: #2ECABB; flex-shrink: 0; }
        .alert-success p, #success-text { color: #2ECABB; font-size: 13px; }
        .alert-error { background: rgba(231,76,60,.08); border: 1px solid rgba(231,76,60,.3); }
        .alert-error svg { stroke: #E74C3C; flex-shrink: 0; }
        .alert-error p, #error-text { color: #E74C3C; font-size: 13px; }

        /* --- Form --- */
        .form-group { margin-bottom: 1.4rem; }
        .form-label {
            display: block;
            font-family: var(--font-body);
            font-size: 10px;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--gold-deep);
            margin-bottom: .5rem;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--dark-600);
            display: flex; align-items: center;
            pointer-events: none;
        }
        .input-icon svg { width: 18px; height: 18px; }
        .form-input {
            width: 100%;
            padding: .8rem 1rem .8rem 2.75rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-md);
            color: var(--dark-900);
            font-family: var(--font-body);
            font-size: 14px;
            outline: none;
            transition: border-color .25s, box-shadow .25s;
        }
        .form-input::placeholder { color: var(--dark-600); }
        .form-input:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.08);
        }

        /* --- Buttons --- */
        .btn-primary {
            width: 100%;
            padding: .9rem 1.5rem;
            background: var(--gold-gradient);
            color: #080808;
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            border: none;
            border-radius: var(--r-md);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            transition: box-shadow .3s, transform .2s;
        }
        .btn-primary:hover { box-shadow: var(--glow-gold-strong); transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        /* Spinner */
        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner {
            width: 18px; height: 18px;
            border: 2px solid rgba(8,8,8,.3);
            border-top-color: #080808;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            display: none;
        }
        .spinner.visible { display: block; }

        /* --- Back link --- */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            margin-top: 1.25rem;
            font-family: var(--font-body);
            font-size: 13px;
            color: var(--dark-700);
            text-decoration: none;
            transition: color .2s;
        }
        .back-link:hover { color: var(--gold-primary); }
        .back-link svg { width: 15px; height: 15px; transition: transform .2s; }
        .back-link:hover svg { transform: translateX(-3px); }

        /* --- Footer --- */
        .page-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-family: var(--font-body);
            font-size: 12px;
            color: var(--dark-600);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-wrapper { animation: slideUp .55s cubic-bezier(.16,1,.3,1) both; }
    </style>
</head>
<body>
    <div class="page-wrapper">

        <!-- Logo -->
        <div class="logo-area">
            <a href="/" class="logo-link">
                <div class="logo-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="logo-text-block">
                    <span class="logo-title">Travel Express</span>
                    <span class="logo-subtitle">Study Abroad Experts</span>
                </div>
            </a>
        </div>

        <!-- Card -->
        <div class="auth-card">
            <div class="corner corner-tl"></div>
            <div class="corner corner-tr"></div>
            <div class="corner corner-bl"></div>
            <div class="corner corner-br"></div>

            <div class="card-header">
                <div class="card-icon-wrap">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h1 class="card-title">Mot de passe oublié ?</h1>
                <p class="card-subtitle">Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
            </div>

            <!-- Success Message -->
            <div id="success-message" class="alert alert-success hidden">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
                <p id="success-text"></p>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="alert alert-error hidden">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p id="error-text"></p>
            </div>

            <!-- Form -->
            <form id="forgot-password-form">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" required
                            class="form-input"
                            placeholder="votre@email.com">
                    </div>
                </div>

                <button type="submit" id="submit-btn" class="btn-primary">
                    <span id="btn-text">Envoyer le lien de réinitialisation</span>
                    <div id="btn-spinner" class="spinner"></div>
                </button>
            </form>

            <a href="/login" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à la connexion
            </a>
        </div>

        <p class="page-footer">&copy; {{ date('Y') }} Travel Express. Tous droits réservés.</p>
    </div>

    <script>
        document.getElementById('forgot-password-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const successMessage = document.getElementById('success-message');
            const successText = document.getElementById('success-text');
            const errorMessage = document.getElementById('error-message');
            const errorText = document.getElementById('error-text');

            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            submitBtn.disabled = true;
            btnText.textContent = 'Envoi en cours...';
            btnSpinner.classList.add('visible');

            try {
                const response = await fetch('/api/password/forgot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();

                if (data.success) {
                    successText.textContent = data.message;
                    successMessage.classList.remove('hidden');
                    document.getElementById('email').value = '';
                } else {
                    errorText.textContent = data.message || 'Une erreur est survenue.';
                    errorMessage.classList.remove('hidden');
                }
            } catch (error) {
                errorText.textContent = 'Erreur de connexion. Veuillez réessayer.';
                errorMessage.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Envoyer le lien de réinitialisation';
                btnSpinner.classList.remove('visible');
            }
        });
    </script>
</body>
</html>

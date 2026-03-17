<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Travel Express</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        /* Animated grid background */
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
        .logo-area {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-link {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .logo-icon {
            width: 52px;
            height: 52px;
            border-radius: var(--r-lg);
            background: var(--gold-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--glow-gold);
            flex-shrink: 0;
        }
        .logo-icon svg {
            width: 26px;
            height: 26px;
            color: #080808;
            stroke: #080808;
        }
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

        /* Gold top accent line */
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gold-gradient);
        }

        /* Corner decorations */
        .corner {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 2px solid rgba(201,168,76,.25);
            pointer-events: none;
        }
        .corner-tl { top: 10px; left: 10px; border-right: none; border-bottom: none; border-radius: var(--r-sm) 0 0 0; }
        .corner-tr { top: 10px; right: 10px; border-left: none; border-bottom: none; border-radius: 0 var(--r-sm) 0 0; }
        .corner-bl { bottom: 10px; left: 10px; border-right: none; border-top: none; border-radius: 0 0 0 var(--r-sm); }
        .corner-br { bottom: 10px; right: 10px; border-left: none; border-top: none; border-radius: 0 0 var(--r-sm) 0; }

        /* --- Card header --- */
        .card-header { margin-bottom: 1.75rem; }
        .card-title {
            font-family: var(--font-display);
            font-size: 2rem;
            letter-spacing: .08em;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 0.4rem;
        }
        .card-subtitle {
            font-family: var(--font-body);
            font-size: 12px;
            letter-spacing: .08em;
            color: var(--dark-700);
        }

        /* --- Alert container --- */
        #alert-container { margin-bottom: 1.25rem; }
        .alert-success {
            background: rgba(46,202,187,.08);
            border: 1px solid rgba(46,202,187,.3);
            border-radius: var(--r-md);
            padding: .75rem 1rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .alert-success p { color: #2ECABB; font-size: 13px; }
        .alert-error {
            background: rgba(231,76,60,.08);
            border: 1px solid rgba(231,76,60,.3);
            border-radius: var(--r-md);
            padding: .75rem 1rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .alert-error p { color: #E74C3C; font-size: 13px; }

        /* --- Form --- */
        .form-group { margin-bottom: 1.25rem; }
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
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-600);
            display: flex;
            align-items: center;
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
        .form-input-pr { padding-right: 3rem; }
        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--dark-600);
            padding: 0;
            display: flex;
            align-items: center;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--gold-primary); }
        .toggle-pw svg { width: 18px; height: 18px; }

        .field-error {
            color: #E74C3C;
            font-size: 11px;
            margin-top: .35rem;
            display: none;
        }

        /* --- Remember / Forgot row --- */
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: .5rem;
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: var(--gold-primary);
            cursor: pointer;
        }
        .remember-text {
            font-family: var(--font-body);
            font-size: 12px;
            color: var(--dark-800);
        }
        .forgot-link {
            font-family: var(--font-body);
            font-size: 12px;
            color: var(--gold-primary);
            text-decoration: none;
            letter-spacing: .05em;
            transition: color .2s;
        }
        .forgot-link:hover { color: var(--gold-bright); }

        /* --- Primary button --- */
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
            transition: box-shadow .3s, opacity .2s, transform .2s;
        }
        .btn-primary:hover {
            box-shadow: var(--glow-gold-strong);
            transform: translateY(-1px);
        }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled { opacity: .65; cursor: not-allowed; transform: none; }
        .btn-primary svg { width: 17px; height: 17px; }

        /* --- Footer links --- */
        .card-footer {
            margin-top: 1.5rem;
            text-align: center;
        }
        .card-footer p {
            font-family: var(--font-body);
            font-size: 13px;
            color: var(--dark-700);
        }
        .card-footer a {
            color: var(--gold-primary);
            text-decoration: none;
            font-weight: 700;
            transition: color .2s;
        }
        .card-footer a:hover { color: var(--gold-bright); }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            margin-top: 1.5rem;
            font-family: var(--font-body);
            font-size: 13px;
            color: var(--dark-700);
            text-decoration: none;
            transition: color .2s;
        }
        .back-link:hover { color: var(--gold-primary); }
        .back-link svg { width: 15px; height: 15px; transition: transform .2s; }
        .back-link:hover svg { transform: translateX(-3px); }

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
                <h2 class="card-title">Connexion</h2>
                <p class="card-subtitle">Accédez à votre espace personnel</p>
            </div>

            <div id="alert-container"></div>

            <form id="loginForm">
                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">Adresse e-mail</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <input type="email" id="email" class="form-input" placeholder="votre@email.com" required>
                    </div>
                    <p class="field-error" id="email-error"></p>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input type="password" id="password" class="form-input form-input-pr" placeholder="••••••••••" required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()">
                            <svg id="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="field-error" id="password-error"></p>
                </div>

                <!-- Remember / Forgot -->
                <div class="form-row">
                    <label class="remember-label">
                        <input type="checkbox" id="remember">
                        <span class="remember-text">Se souvenir de moi</span>
                    </label>
                    <a href="/forgot-password" class="forgot-link">Mot de passe oublié ?</a>
                </div>

                <!-- Submit -->
                <button type="submit" id="loginButton" class="btn-primary">
                    <span id="loginButtonText">Se connecter</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </form>

            <div class="card-footer">
                <p>Pas encore de compte ? <a href="/register">Créer un compte</a></p>
            </div>
        </div>

        <div style="text-align:center;">
            <a href="/" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('loginButtonText');
            const alertContainer = document.getElementById('alert-container');

            document.querySelectorAll('[id$="-error"]').forEach(el => {
                el.style.display = 'none';
                el.textContent = '';
            });
            alertContainer.innerHTML = '';

            button.disabled = true;
            buttonText.textContent = 'Connexion en cours...';

            try {
                const response = await fetch('/web/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                        remember: document.getElementById('remember').checked,
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    localStorage.setItem('token_expires_at', data.data.expires_at);
                    localStorage.setItem('is_admin', data.data.user.is_admin ? 'true' : 'false');

                    alertContainer.innerHTML = `
                        <div class="alert-success">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:#2ECABB;flex-shrink:0;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>${data.message}</p>
                        </div>`;

                    const urlParams = new URLSearchParams(window.location.search);
                    const redirectParam = urlParams.get('redirect');
                    let redirectUrl = '/';
                    if (redirectParam === 'testimonial') redirectUrl = '/?openTestimonial=true';

                    setTimeout(() => window.location.href = redirectUrl, 1200);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const el = document.getElementById(`${key}-error`);
                            if (el) {
                                el.textContent = data.errors[key][0];
                                el.style.display = 'block';
                            }
                        });
                    } else if (data.message) {
                        alertContainer.innerHTML = `
                            <div class="alert-error">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:#E74C3C;flex-shrink:0;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p>${data.message}</p>
                            </div>`;
                    }
                }
            } catch (error) {
                alertContainer.innerHTML = `
                    <div class="alert-error">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:#E74C3C;flex-shrink:0;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Erreur de connexion au serveur</p>
                    </div>`;
            } finally {
                button.disabled = false;
                buttonText.textContent = 'Se connecter';
            }
        });
    </script>
</body>
</html>

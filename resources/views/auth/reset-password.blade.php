<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe - Travel Express</title>

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
        .logo-link { display: inline-flex; align-items: center; gap: .75rem; text-decoration: none; }
        .logo-icon {
            width: 52px; height: 52px;
            border-radius: var(--r-lg);
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
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
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.1rem;
        }
        .card-icon-wrap svg { width: 26px; height: 26px; stroke: var(--gold-primary); }
        .card-icon-wrap.danger { background: rgba(231,76,60,.08); border-color: rgba(231,76,60,.2); }
        .card-icon-wrap.danger svg { stroke: #E74C3C; }

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
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--dark-600);
            display: flex; align-items: center;
            pointer-events: none;
        }
        .input-icon svg { width: 18px; height: 18px; }
        .form-input {
            width: 100%;
            padding: .8rem 2.75rem .8rem 2.75rem;
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
        .toggle-pw {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--dark-600);
            padding: 0;
            display: flex; align-items: center;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--gold-primary); }
        .toggle-pw svg { width: 18px; height: 18px; }

        /* --- Strength bar --- */
        .strength-row {
            display: flex;
            justify-content: space-between;
            font-family: var(--font-body);
            font-size: 11px;
            color: var(--dark-700);
            margin-bottom: .4rem;
        }
        #strength-text { font-weight: 700; }
        .strength-track {
            height: 4px;
            background: var(--dark-300);
            border-radius: var(--r-full);
            overflow: hidden;
            margin-bottom: 1.25rem;
        }
        #strength-bar {
            height: 100%;
            width: 0;
            border-radius: var(--r-full);
            transition: width .3s, background-color .3s;
        }

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
            transition: box-shadow .3s, transform .2s;
        }
        .btn-primary:hover { box-shadow: var(--glow-gold-strong); transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        /* --- Gold link button (invalid token) --- */
        .btn-gold-link {
            display: inline-block;
            padding: .75rem 1.75rem;
            background: var(--gold-gradient);
            color: #080808;
            font-family: var(--font-body);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: var(--r-md);
            transition: box-shadow .3s, transform .2s;
            margin-top: .5rem;
        }
        .btn-gold-link:hover { box-shadow: var(--glow-gold-strong); transform: translateY(-1px); }

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

        /* --- Loading state --- */
        .loading-inner { text-align: center; padding: 1rem 0; }
        @keyframes spinGold { to { transform: rotate(360deg); } }
        .loading-spinner {
            width: 44px; height: 44px;
            border: 3px solid rgba(201,168,76,.15);
            border-top-color: var(--gold-primary);
            border-radius: 50%;
            animation: spinGold .8s linear infinite;
            margin: 0 auto 1rem;
        }
        .loading-text {
            font-family: var(--font-body);
            font-size: 13px;
            color: var(--dark-700);
            letter-spacing: .08em;
        }

        /* --- Footer --- */
        .page-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-family: var(--font-body);
            font-size: 12px;
            color: var(--dark-600);
        }

        /* --- Utility --- */
        .hidden { display: none !important; }

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

        <!-- Invalid Token Card -->
        <div id="invalid-token-card" class="auth-card hidden">
            <div class="corner corner-tl"></div>
            <div class="corner corner-tr"></div>
            <div class="corner corner-bl"></div>
            <div class="corner corner-br"></div>
            <div style="text-align:center;">
                <div class="card-icon-wrap danger" style="margin-bottom:1.1rem;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h1 class="card-title">Lien invalide ou expiré</h1>
                <p class="card-subtitle" id="invalid-message" style="margin-bottom:1.5rem;">Ce lien de réinitialisation n'est plus valide. Veuillez en demander un nouveau.</p>
                <a href="/forgot-password" class="btn-gold-link">Demander un nouveau lien</a>
            </div>
        </div>

        <!-- Reset Form Card -->
        <div id="reset-card" class="auth-card hidden">
            <div class="corner corner-tl"></div>
            <div class="corner corner-tr"></div>
            <div class="corner corner-bl"></div>
            <div class="corner corner-br"></div>

            <div class="card-header">
                <div class="card-icon-wrap">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="card-title">Nouveau mot de passe</h1>
                <p class="card-subtitle">Créez un nouveau mot de passe sécurisé pour votre compte.</p>
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
            <form id="reset-password-form">
                @csrf
                <input type="hidden" id="token" name="token">
                <input type="hidden" id="email" name="email">

                <!-- New password -->
                <div class="form-group">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password" required minlength="8"
                            class="form-input"
                            placeholder="Minimum 8 caractères">
                        <button type="button" class="toggle-pw" onclick="togglePassword('password')">
                            <svg id="password-eye" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </span>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                            class="form-input"
                            placeholder="Confirmez votre mot de passe">
                        <button type="button" class="toggle-pw" onclick="togglePassword('password_confirmation')">
                            <svg id="password_confirmation-eye" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password strength indicator -->
                <div class="strength-row">
                    <span style="color:var(--dark-700);">Force du mot de passe</span>
                    <span id="strength-text" style="color:var(--dark-600);">-</span>
                </div>
                <div class="strength-track">
                    <div id="strength-bar"></div>
                </div>

                <button type="submit" id="submit-btn" class="btn-primary">
                    <span id="btn-text">Réinitialiser le mot de passe</span>
                    <div id="btn-spinner" class="spinner"></div>
                </button>
            </form>
        </div>

        <!-- Loading Card -->
        <div id="loading-card" class="auth-card">
            <div class="corner corner-tl"></div>
            <div class="corner corner-tr"></div>
            <div class="corner corner-bl"></div>
            <div class="corner corner-br"></div>
            <div class="loading-inner">
                <div class="loading-spinner"></div>
                <p class="loading-text">Vérification du lien...</p>
            </div>
        </div>

        <p class="page-footer">&copy; {{ date('Y') }} Travel Express. Tous droits réservés.</p>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');
        const email = urlParams.get('email');

        const loadingCard = document.getElementById('loading-card');
        const resetCard = document.getElementById('reset-card');
        const invalidTokenCard = document.getElementById('invalid-token-card');

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>`;
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8)  strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password))   strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            return strength;
        }

        document.getElementById('password').addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            const bar  = document.getElementById('strength-bar');
            const text = document.getElementById('strength-text');

            const levels = [
                { width: '0%',   color: '#4A4A4A', label: '-' },
                { width: '20%',  color: '#E74C3C', label: 'Très faible' },
                { width: '40%',  color: '#E67E22', label: 'Faible' },
                { width: '60%',  color: '#F0D07A', label: 'Moyen' },
                { width: '80%',  color: '#C9A84C', label: 'Fort' },
                { width: '100%', color: '#2ECABB', label: 'Très fort' },
            ];

            bar.style.width           = levels[strength].width;
            bar.style.backgroundColor = levels[strength].color;
            text.textContent          = levels[strength].label;
            text.style.color          = levels[strength].color;
        });

        async function verifyToken() {
            if (!token || !email) {
                loadingCard.classList.add('hidden');
                invalidTokenCard.classList.remove('hidden');
                document.getElementById('invalid-message').textContent = 'Lien de réinitialisation invalide. Les paramètres sont manquants.';
                return;
            }

            try {
                const response = await fetch('/api/password/verify-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ token, email })
                });

                const data = await response.json();
                loadingCard.classList.add('hidden');

                if (data.success && data.valid) {
                    resetCard.classList.remove('hidden');
                    document.getElementById('token').value = token;
                    document.getElementById('email').value = email;
                } else {
                    invalidTokenCard.classList.remove('hidden');
                    document.getElementById('invalid-message').textContent = data.message || 'Ce lien de réinitialisation n\'est plus valide.';
                }
            } catch (error) {
                loadingCard.classList.add('hidden');
                invalidTokenCard.classList.remove('hidden');
                document.getElementById('invalid-message').textContent = 'Erreur de connexion. Veuillez réessayer.';
            }
        }

        verifyToken();

        document.getElementById('reset-password-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const password             = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const submitBtn   = document.getElementById('submit-btn');
            const btnText     = document.getElementById('btn-text');
            const btnSpinner  = document.getElementById('btn-spinner');
            const successMessage = document.getElementById('success-message');
            const successText    = document.getElementById('success-text');
            const errorMessage   = document.getElementById('error-message');
            const errorText      = document.getElementById('error-text');

            if (password !== passwordConfirmation) {
                errorText.textContent = 'Les mots de passe ne correspondent pas.';
                errorMessage.classList.remove('hidden');
                return;
            }

            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            submitBtn.disabled = true;
            btnText.textContent = 'Réinitialisation...';
            btnSpinner.classList.add('visible');

            try {
                const response = await fetch('/api/password/reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        token: document.getElementById('token').value,
                        password,
                        password_confirmation: passwordConfirmation
                    })
                });

                const data = await response.json();

                if (data.success) {
                    successText.textContent = data.message;
                    successMessage.classList.remove('hidden');
                    document.getElementById('reset-password-form').classList.add('hidden');
                    setTimeout(() => { window.location.href = '/login'; }, 3000);
                } else {
                    errorText.textContent = data.message || 'Une erreur est survenue.';
                    errorMessage.classList.remove('hidden');
                }
            } catch (error) {
                errorText.textContent = 'Erreur de connexion. Veuillez réessayer.';
                errorMessage.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Réinitialiser le mot de passe';
                btnSpinner.classList.remove('visible');
            }
        });
    </script>
</body>
</html>

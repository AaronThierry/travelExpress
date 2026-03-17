<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Travel Express</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Royal Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gold-primary: #C9A84C; --gold-bright: #F0D07A; --gold-deep: #8B6914;
            --gold-gradient: linear-gradient(135deg, #8B6914 0%, #C9A84C 30%, #F0D07A 50%, #C9A84C 70%, #8B6914 100%);
            --dark-0: #080808; --dark-100: #141414; --dark-200: #1C1C1C; --dark-300: #262626;
            --dark-400: #333333; --dark-500: #4A4A4A; --dark-600: #6B6B6B;
            --dark-700: #8A8A8A; --dark-800: #B0B0B0; --dark-900: #D4D4D4;
            --glow-gold: 0 0 20px rgba(201,168,76,.25), 0 0 60px rgba(201,168,76,.08);
            --glow-gold-strong: 0 0 30px rgba(201,168,76,.4), 0 0 80px rgba(201,168,76,.15);
            --color-success: #2ECABB; --color-warning: #F0B428; --color-danger: #E74C3C;
            --r-sm:3px; --r-md:6px; --r-lg:10px; --r-xl:14px; --r-full:9999px;
            --font-display: 'Bebas Neue', sans-serif;
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-body: 'Lato', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background-color: var(--dark-0);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Gold grid overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201,168,76,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }

        /* ---- ROYAL CARD ---- */
        .royal-card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            position: relative;
            overflow: hidden;
        }
        .royal-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gold-gradient);
        }
        .corner-tl, .corner-tr, .corner-bl, .corner-br {
            position: absolute;
            width: 18px; height: 18px;
            border-color: var(--gold-primary);
            border-style: solid;
            opacity: .4;
            pointer-events: none;
        }
        .corner-tl { top: 10px; left: 10px;  border-width: 1px 0 0 1px; border-radius: 2px 0 0 0; }
        .corner-tr { top: 10px; right: 10px; border-width: 1px 1px 0 0; border-radius: 0 2px 0 0; }
        .corner-bl { bottom: 10px; left: 10px;  border-width: 0 0 1px 1px; border-radius: 0 0 0 2px; }
        .corner-br { bottom: 10px; right: 10px; border-width: 0 1px 1px 0; border-radius: 0 0 2px 0; }

        /* ---- LOGO / TITLE ---- */
        .gold-text {
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        /* ---- PROGRESS BAR ---- */
        .progress-bar {
            height: 8px;
            background: var(--dark-300);
            border-radius: var(--r-full);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .progress-bar-fill {
            height: 100%;
            background: var(--gold-gradient);
            background-size: 200% auto;
            transition: width 0.5s ease;
            border-radius: var(--r-full);
        }

        /* ---- STEP INDICATOR ---- */
        .step-indicator {
            position: relative;
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
        }
        .step {
            position: relative;
            flex: 1;
            text-align: center;
        }
        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--dark-300);
            border: 1px solid rgba(201,168,76,.15);
            color: var(--dark-700);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-family: var(--font-body);
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }
        .step.active .step-circle {
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #080808;
            box-shadow: var(--glow-gold-strong);
            transform: scale(1.1);
            border-color: transparent;
        }
        .step.completed .step-circle {
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #080808;
            border-color: transparent;
        }
        .step-label {
            font-family: var(--font-body);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--dark-600);
        }
        .step.active .step-label  { color: var(--gold-primary); }
        .step.completed .step-label { color: var(--gold-deep); }

        .step-line {
            position: absolute;
            top: 25px;
            left: 50%;
            right: -50%;
            height: 2px;
            background: var(--dark-400);
            z-index: 1;
            transition: all 0.3s ease;
        }
        .step.completed .step-line { background: var(--gold-primary); }
        .step:last-child .step-line { display: none; }

        /* ---- FORM STEPS ---- */
        .form-step { display: none; animation: fadeInUp 0.5s ease; }
        .form-step.active { display: block; }

        /* ---- INPUT GROUP ---- */
        .input-group { position: relative; margin-bottom: 1.25rem; }
        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: .875rem 1rem .875rem 3rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            font-family: var(--font-body);
            font-size: .9rem;
            color: var(--dark-900);
            transition: border-color .25s, box-shadow .25s;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
        }
        .input-group textarea {
            resize: vertical;
            min-height: 100px;
            padding-left: 3rem;
        }
        .input-group input::placeholder,
        .input-group textarea::placeholder { color: var(--dark-600); }
        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.12);
        }
        .input-group select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238B6914' stroke-width='2.5'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 2.5rem;
            cursor: pointer;
        }
        .input-group select option {
            background: var(--dark-200);
            color: var(--dark-900);
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-deep);
            pointer-events: none;
            font-size: .95rem;
        }
        .input-group textarea ~ .input-icon { top: 1.2rem; transform: none; }

        /* ---- GENDER OPTION ---- */
        .gender-option {
            flex: 1;
            padding: 1rem;
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            background: var(--dark-200);
            color: var(--dark-800);
        }
        .gender-option:hover {
            border-color: var(--gold-primary);
            background: rgba(201,168,76,.05);
            color: var(--gold-primary);
            transform: translateY(-2px);
        }
        .gender-option.selected {
            border-color: var(--gold-primary);
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #080808;
            box-shadow: var(--glow-gold);
        }

        /* ---- INTEREST TAG ---- */
        .interest-tag {
            display: inline-block;
            padding: .5rem 1rem;
            margin: .25rem;
            background: var(--dark-300);
            border: 1px solid rgba(201,168,76,.12);
            border-radius: var(--r-full);
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: var(--font-body);
            font-size: .85rem;
            color: var(--dark-800);
        }
        .interest-tag:hover {
            border-color: var(--gold-primary);
            color: var(--gold-primary);
            transform: translateY(-2px);
        }
        .interest-tag.selected {
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #080808;
            border-color: transparent;
            box-shadow: var(--glow-gold);
        }

        /* ---- BUTTONS ---- */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .875rem 2rem;
            border: none;
            border-radius: var(--r-lg);
            cursor: pointer;
            transition: box-shadow .3s, transform .2s;
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #080808;
        }
        .btn-primary:hover {
            box-shadow: var(--glow-gold-strong);
            transform: translateY(-2px);
        }
        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .875rem 2rem;
            border: 1px solid rgba(201,168,76,.25);
            border-radius: var(--r-lg);
            cursor: pointer;
            transition: border-color .25s, background .25s, color .25s;
            background: transparent;
            color: var(--dark-800);
        }
        .btn-secondary:hover {
            border-color: var(--gold-primary);
            background: rgba(201,168,76,.05);
            color: var(--gold-primary);
        }

        /* ---- LABEL ---- */
        .royal-label {
            display: block;
            font-family: var(--font-body);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .15em;
            color: var(--gold-deep);
            margin-bottom: 6px;
        }

        /* ---- SECTION TITLE ---- */
        .step-title {
            font-family: var(--font-display);
            font-size: 1.75rem;
            letter-spacing: .04em;
            color: var(--dark-900);
            margin-bottom: 1.5rem;
        }

        /* ---- LINK ---- */
        a.royal-link {
            color: var(--gold-primary);
            text-decoration: none;
            transition: color .2s;
            font-weight: 700;
        }
        a.royal-link:hover { color: var(--gold-bright); }

        /* ---- INTERESTS CONTAINER ---- */
        .interests-container {
            padding: 1rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.1);
            border-radius: var(--r-lg);
        }

        /* ---- BIO COUNTER ---- */
        .char-counter { color: var(--dark-600); font-size: .8rem; margin-top: 4px; text-align: right; }

        /* ---- COMPLETION BANNER ---- */
        .completion-banner {
            background: rgba(201,168,76,.06);
            border: 1px solid rgba(201,168,76,.2);
            border-radius: var(--r-lg);
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }
        .completion-banner i { color: var(--gold-primary); font-size: 1.2rem; margin-top: 2px; }
        .completion-banner h3 {
            font-family: var(--font-body);
            font-weight: 700;
            font-size: .9rem;
            color: var(--gold-primary);
            margin-bottom: 2px;
        }
        .completion-banner p { font-size: .82rem; color: var(--dark-700); }
    </style>
</head>
<body style="display:flex;align-items:center;justify-content:center;padding:1rem;min-height:100vh;position:relative;z-index:1;">
    <div class="w-full" style="max-width:48rem;position:relative;z-index:1;">

        <!-- Header -->
        <div style="text-align:center;margin-bottom:2rem;">
            <h1 style="font-family:var(--font-display);font-size:2.5rem;letter-spacing:.05em;margin-bottom:.5rem;" class="gold-text">Créez votre compte</h1>
            <p style="color:var(--dark-700);font-family:var(--font-body);font-size:.95rem;">Rejoignez Travel Express en quelques étapes simples</p>
        </div>

        <!-- Main Card -->
        <div class="royal-card" style="padding:2rem;box-shadow:var(--glow-gold);">
            <div class="corner-tl"></div>
            <div class="corner-tr"></div>
            <div class="corner-bl"></div>
            <div class="corner-br"></div>

            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-bar-fill" id="progressBar" style="width: 25%"></div>
            </div>

            <!-- Step Indicators -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-circle">1</div>
                    <div class="step-line"></div>
                    <div class="step-label">Compte</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-circle">2</div>
                    <div class="step-line"></div>
                    <div class="step-label">Personnel</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-circle">3</div>
                    <div class="step-line"></div>
                    <div class="step-label">Social</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-circle">4</div>
                    <div class="step-label">Intérêts</div>
                </div>
            </div>

            <!-- Form -->
            <form id="registrationForm">

                <!-- Step 1: Account Info -->
                <div class="form-step active" data-step="1">
                    <h2 class="step-title">Informations du compte</h2>

                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <label class="royal-label" style="margin-bottom:0;position:absolute;top:-18px;">Nom complet</label>
                        <input type="text" name="name" placeholder="Nom complet" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" placeholder="Adresse email" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                    </div>

                    <div style="display:flex;justify-content:flex-end;margin-top:1.5rem;">
                        <button type="button" class="btn-primary" onclick="nextStep()">
                            Suivant <i class="fas fa-arrow-right" style="margin-left:.5rem;"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Personal Info -->
                <div class="form-step" data-step="2">
                    <h2 class="step-title">Informations personnelles</h2>

                    <div class="input-group">
                        <i class="fas fa-globe input-icon"></i>
                        <select name="country" required>
                            <option value="">Sélectionnez votre pays</option>
                            <option value="FR">🇫🇷 France</option>
                            <option value="BE">🇧🇪 Belgique</option>
                            <option value="CH">🇨🇭 Suisse</option>
                            <option value="CA">🇨🇦 Canada</option>
                            <option value="MA">🇲🇦 Maroc</option>
                            <option value="TN">🇹🇳 Tunisie</option>
                            <option value="DZ">🇩🇿 Algérie</option>
                            <option value="SN">🇸🇳 Sénégal</option>
                            <option value="CI">🇨🇮 Côte d'Ivoire</option>
                            <option value="US">🇺🇸 États-Unis</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-flag input-icon"></i>
                        <input type="text" name="nationality" placeholder="Nationalité">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-whatsapp input-icon"></i>
                        <input type="tel" name="whatsapp" placeholder="Numéro WhatsApp (ex: +33 6 12 34 56 78)">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="tel" name="phone" placeholder="Téléphone">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-calendar input-icon"></i>
                        <input type="date" name="date_of_birth" placeholder="Date de naissance">
                    </div>

                    <div style="margin-bottom:1.25rem;">
                        <label class="royal-label">Genre</label>
                        <div style="display:flex;gap:.75rem;">
                            <div class="gender-option" data-gender="male">
                                <i class="fas fa-mars" style="font-size:1.5rem;margin-bottom:.5rem;display:block;"></i>
                                <div style="font-weight:700;font-size:.85rem;">Homme</div>
                            </div>
                            <div class="gender-option" data-gender="female">
                                <i class="fas fa-venus" style="font-size:1.5rem;margin-bottom:.5rem;display:block;"></i>
                                <div style="font-weight:700;font-size:.85rem;">Femme</div>
                            </div>
                            <div class="gender-option" data-gender="other">
                                <i class="fas fa-genderless" style="font-size:1.5rem;margin-bottom:.5rem;display:block;"></i>
                                <div style="font-weight:700;font-size:.85rem;">Autre</div>
                            </div>
                        </div>
                        <input type="hidden" name="gender" id="genderInput">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-language input-icon"></i>
                        <select name="language">
                            <option value="fr">Français</option>
                            <option value="en">English</option>
                            <option value="es">Español</option>
                            <option value="de">Deutsch</option>
                            <option value="ar">العربية</option>
                        </select>
                    </div>

                    <div style="display:flex;justify-content:space-between;margin-top:1.5rem;gap:.75rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">
                            <i class="fas fa-arrow-left"></i> Retour
                        </button>
                        <button type="button" class="btn-primary" onclick="nextStep()">
                            Suivant <i class="fas fa-arrow-right" style="margin-left:.5rem;"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Social & Professional -->
                <div class="form-step" data-step="3">
                    <h2 class="step-title">Réseaux sociaux &amp; Professionnel</h2>

                    <div class="input-group">
                        <i class="fas fa-building input-icon"></i>
                        <input type="text" name="company" placeholder="Entreprise">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-briefcase input-icon"></i>
                        <input type="text" name="position" placeholder="Poste">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <input type="text" name="location" placeholder="Ville">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-linkedin input-icon"></i>
                        <input type="url" name="linkedin" placeholder="Profil LinkedIn (https://linkedin.com/in/...)">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-twitter input-icon"></i>
                        <input type="url" name="twitter" placeholder="Profil Twitter (https://twitter.com/...)">
                    </div>

                    <div class="input-group">
                        <i class="fab fa-instagram input-icon"></i>
                        <input type="url" name="instagram" placeholder="Profil Instagram (https://instagram.com/...)">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-globe input-icon"></i>
                        <input type="url" name="website" placeholder="Site web personnel">
                    </div>

                    <div style="display:flex;justify-content:space-between;margin-top:1.5rem;gap:.75rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">
                            <i class="fas fa-arrow-left"></i> Retour
                        </button>
                        <button type="button" class="btn-primary" onclick="nextStep()">
                            Suivant <i class="fas fa-arrow-right" style="margin-left:.5rem;"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Interests & Bio -->
                <div class="form-step" data-step="4">
                    <h2 class="step-title">Centres d'intérêt</h2>

                    <div style="margin-bottom:1.5rem;">
                        <label class="royal-label">Sélectionnez vos intérêts</label>
                        <div id="interestsContainer" class="interests-container">
                            <span class="interest-tag" data-interest="Voyages">✈️ Voyages</span>
                            <span class="interest-tag" data-interest="Photographie">📷 Photographie</span>
                            <span class="interest-tag" data-interest="Gastronomie">🍽️ Gastronomie</span>
                            <span class="interest-tag" data-interest="Sport">⚽ Sport</span>
                            <span class="interest-tag" data-interest="Culture">🎭 Culture</span>
                            <span class="interest-tag" data-interest="Nature">🌿 Nature</span>
                            <span class="interest-tag" data-interest="Aventure">🏔️ Aventure</span>
                            <span class="interest-tag" data-interest="Plage">🏖️ Plage</span>
                            <span class="interest-tag" data-interest="Histoire">📚 Histoire</span>
                            <span class="interest-tag" data-interest="Art">🎨 Art</span>
                            <span class="interest-tag" data-interest="Musique">🎵 Musique</span>
                            <span class="interest-tag" data-interest="Technologie">💻 Technologie</span>
                        </div>
                        <input type="hidden" name="interests" id="interestsInput">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-pen input-icon" style="top:1.2rem;transform:none;"></i>
                        <textarea name="bio" placeholder="Parlez-nous de vous... (optionnel)" maxlength="500"></textarea>
                        <div class="char-counter">
                            <span id="bioCount">0</span>/500 caractères
                        </div>
                    </div>

                    <div class="completion-banner">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Presque terminé !</h3>
                            <p>Vous êtes sur le point de rejoindre la communauté Travel Express.</p>
                        </div>
                    </div>

                    <div style="display:flex;justify-content:space-between;margin-top:1.5rem;gap:.75rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">
                            <i class="fas fa-arrow-left"></i> Retour
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-check" style="margin-right:.5rem;"></i> Créer mon compte
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <!-- Login Link -->
        <div style="text-align:center;margin-top:1.5rem;">
            <p style="font-family:var(--font-body);font-size:.9rem;color:var(--dark-700);">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="royal-link">Connectez-vous</a>
            </p>
        </div>

    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        // Gender selection
        document.querySelectorAll('.gender-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.gender-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('genderInput').value = this.dataset.gender;
            });
        });

        // Interest selection
        const selectedInterests = [];
        document.querySelectorAll('.interest-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                this.classList.toggle('selected');
                const interest = this.dataset.interest;

                if (selectedInterests.includes(interest)) {
                    selectedInterests.splice(selectedInterests.indexOf(interest), 1);
                } else {
                    selectedInterests.push(interest);
                }

                document.getElementById('interestsInput').value = selectedInterests.join(',');
            });
        });

        // Bio character counter
        const bioTextarea = document.querySelector('textarea[name="bio"]');
        const bioCount = document.getElementById('bioCount');
        bioTextarea.addEventListener('input', function() {
            bioCount.textContent = this.value.length;
        });

        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('completed');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');

                currentStep++;
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');

                updateProgress();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');

                currentStep--;
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('completed');

                updateProgress();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    localStorage.setItem('token', result.token);
                    localStorage.setItem('user', JSON.stringify(result.user));
                    alert('Compte créé avec succès !');
                    window.location.href = '/profile';
                } else {
                    alert('Erreur: ' + (result.message || 'Une erreur est survenue'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert("Une erreur est survenue lors de l'inscription");
            }
        });
    </script>
</body>
</html>

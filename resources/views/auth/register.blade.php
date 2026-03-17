<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Travel Express</title>

    <!-- Google Fonts - Royal Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Flag Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }
        @keyframes pulseGold {
            0%, 100% { opacity: .25; }
            50%       { opacity: .5; }
        }

        .slide-in { animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .fade-in  { animation: fadeIn 0.4s ease-out; }

        /* ---- CARD ---- */
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

        /* Corner decorations */
        .corner-tl, .corner-tr, .corner-bl, .corner-br {
            position: absolute;
            width: 18px; height: 18px;
            border-color: var(--gold-primary);
            border-style: solid;
            opacity: .5;
            pointer-events: none;
        }
        .corner-tl { top: 10px; left: 10px;  border-width: 1px 0 0 1px; border-radius: 2px 0 0 0; }
        .corner-tr { top: 10px; right: 10px; border-width: 1px 1px 0 0; border-radius: 0 2px 0 0; }
        .corner-bl { bottom: 10px; left: 10px;  border-width: 0 0 1px 1px; border-radius: 0 0 0 2px; }
        .corner-br { bottom: 10px; right: 10px; border-width: 0 1px 1px 0; border-radius: 0 0 2px 0; }

        /* ---- LOGO GOLD GRADIENT TEXT ---- */
        .logo-text {
            font-family: var(--font-display);
            font-size: 2rem;
            letter-spacing: .05em;
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }
        .logo-sub {
            font-family: var(--font-body);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--gold-deep);
            margin-top: 4px;
        }

        /* ---- TITLE ---- */
        .royal-title {
            font-family: var(--font-display);
            font-size: 2rem;
            letter-spacing: .04em;
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .royal-subtitle {
            font-family: var(--font-body);
            font-size: .8rem;
            color: var(--dark-700);
            letter-spacing: .05em;
        }

        /* ---- PROGRESS BAR ---- */
        .progress-bar {
            height: 4px;
            background: var(--dark-300);
            border-radius: var(--r-full);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: var(--gold-gradient);
            background-size: 200% auto;
            transition: width 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            border-radius: var(--r-full);
        }

        /* ---- LABELS ---- */
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

        /* ---- INPUTS ---- */
        .royal-input {
            width: 100%;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            color: var(--dark-900);
            font-family: var(--font-body);
            font-size: .875rem;
            padding: .875rem 1rem .875rem 2.75rem;
            outline: none;
            transition: border-color .25s, box-shadow .25s;
            appearance: none;
            -webkit-appearance: none;
        }
        .royal-input::placeholder { color: var(--dark-600); }
        .royal-input:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.12);
        }
        .royal-input.no-icon {
            padding-left: 1rem;
        }
        .input-icon-wrap {
            position: relative;
        }
        .input-icon-wrap .icon {
            position: absolute;
            left: .875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-deep);
            pointer-events: none;
            width: 16px; height: 16px;
        }

        /* Alpine dropdown override */
        .royal-dropdown-btn {
            width: 100%;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            color: var(--dark-900);
            font-family: var(--font-body);
            font-size: .875rem;
            padding: .875rem 2.5rem .875rem 1rem;
            outline: none;
            transition: border-color .25s, box-shadow .25s;
            cursor: pointer;
            text-align: left;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .royal-dropdown-btn:focus,
        .royal-dropdown-btn.open {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.12);
        }
        .royal-dropdown-btn .placeholder-text { color: var(--dark-600); }
        .royal-dropdown-panel {
            position: absolute;
            left: 0; right: 0; top: 100%;
            margin-top: 6px;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.2);
            border-radius: var(--r-lg);
            box-shadow: 0 20px 40px rgba(0,0,0,.6), var(--glow-gold);
            z-index: 50;
            max-height: 240px;
            overflow: hidden;
        }
        .royal-dropdown-search {
            padding: 10px;
            border-bottom: 1px solid rgba(201,168,76,.1);
            position: sticky;
            top: 0;
            background: var(--dark-200);
        }
        .royal-dropdown-search input {
            width: 100%;
            background: var(--dark-300);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-md);
            color: var(--dark-900);
            font-family: var(--font-body);
            font-size: .8rem;
            padding: .5rem .75rem;
            outline: none;
        }
        .royal-dropdown-search input:focus { border-color: var(--gold-primary); }
        .royal-dropdown-list { overflow-y: auto; max-height: 180px; }
        .royal-dropdown-option {
            width: 100%;
            padding: .625rem 1rem;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
            color: var(--dark-800);
            font-family: var(--font-body);
            font-size: .85rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            transition: background .15s;
        }
        .royal-dropdown-option:hover { background: rgba(201,168,76,.07); color: var(--gold-bright); }
        .royal-dropdown-option.selected { background: rgba(201,168,76,.12); color: var(--gold-primary); }

        /* ---- SELECT ---- */
        select.royal-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238B6914' stroke-width='2.5'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 2.5rem;
            cursor: pointer;
        }
        select.royal-input option {
            background: var(--dark-200);
            color: var(--dark-900);
        }

        /* ---- BUTTONS ---- */
        .btn-royal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .875rem 1.5rem;
            border: none;
            border-radius: var(--r-lg);
            cursor: pointer;
            transition: box-shadow .3s, transform .2s, opacity .2s;
            background: var(--gold-gradient);
            background-size: 200% auto;
            color: #080808;
        }
        .btn-royal:hover {
            box-shadow: var(--glow-gold-strong);
            transform: translateY(-2px);
        }
        .btn-royal:active { transform: translateY(0); }
        .btn-royal:disabled { opacity: .6; cursor: not-allowed; transform: none; }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .875rem 1.5rem;
            border: 1px solid rgba(201,168,76,.25);
            border-radius: var(--r-lg);
            cursor: pointer;
            transition: border-color .25s, background .25s;
            background: transparent;
            color: var(--dark-800);
        }
        .btn-ghost:hover {
            border-color: var(--gold-primary);
            background: rgba(201,168,76,.05);
            color: var(--gold-primary);
        }

        /* ---- CHECKBOX ---- */
        .royal-checkbox {
            width: 16px; height: 16px;
            accent-color: var(--gold-primary);
            cursor: pointer;
            flex-shrink: 0;
        }

        /* ---- ALERT MESSAGES ---- */
        .alert-success {
            background: rgba(46,202,187,.08);
            border: 1px solid rgba(46,202,187,.25);
            border-radius: var(--r-lg);
            padding: .875rem 1rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            color: #2ECABB;
            font-size: .875rem;
        }
        .alert-danger {
            background: rgba(231,76,60,.08);
            border: 1px solid rgba(231,76,60,.25);
            border-radius: var(--r-lg);
            padding: .875rem 1rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            color: var(--color-danger);
            font-size: .875rem;
        }

        /* ---- FIELD ERROR ---- */
        .field-error {
            color: var(--color-danger);
            font-size: .75rem;
            margin-top: 4px;
            font-family: var(--font-body);
        }
        .field-hint {
            color: var(--dark-600);
            font-size: .72rem;
            margin-top: 4px;
            font-family: var(--font-body);
        }

        /* ---- LINKS ---- */
        a.royal-link {
            color: var(--gold-primary);
            text-decoration: none;
            transition: color .2s;
        }
        a.royal-link:hover { color: var(--gold-bright); }

        /* ---- DIVIDER ---- */
        .royal-divider {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin: 1.25rem 0;
        }
        .royal-divider::before, .royal-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(201,168,76,.12);
        }
        .royal-divider span {
            color: var(--dark-600);
            font-size: .7rem;
            letter-spacing: .1em;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 relative" style="z-index:1;">
        <div class="w-full max-w-md slide-in">

            <!-- Logo -->
            <div class="text-center mb-8 fade-in">
                <a href="/" class="inline-flex flex-col items-center group" style="text-decoration:none;">
                    <div class="relative mb-3">
                        <div style="
                            width:60px; height:60px;
                            background: var(--dark-200);
                            border: 1px solid rgba(201,168,76,.25);
                            border-radius: var(--r-xl);
                            display:flex; align-items:center; justify-content:center;
                            box-shadow: var(--glow-gold);
                            transition: box-shadow .3s;
                        " class="logo-icon-wrap">
                            <svg width="30" height="30" fill="none" stroke="url(#goldStroke)" viewBox="0 0 24 24" stroke-width="1.5">
                                <defs>
                                    <linearGradient id="goldStroke" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#8B6914"/>
                                        <stop offset="50%" stop-color="#F0D07A"/>
                                        <stop offset="100%" stop-color="#8B6914"/>
                                    </linearGradient>
                                </defs>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="logo-text">Travel Express</span>
                    <span class="logo-sub">Study Abroad Experts</span>
                </a>
            </div>

            <!-- Register Card -->
            <div class="royal-card" style="padding: 2rem;">
                <div class="corner-tl"></div>
                <div class="corner-tr"></div>
                <div class="corner-bl"></div>
                <div class="corner-br"></div>

                <div class="mb-5">
                    <h2 class="royal-title">Créer un compte</h2>
                    <p class="royal-subtitle" style="margin-top:4px;">
                        Étape <span id="stepIndicator">1</span>/3
                    </p>
                </div>

                <!-- Progress Bar -->
                <div class="progress-bar" style="margin-bottom:1.5rem;">
                    <div id="progressFill" class="progress-fill" style="width: 33.33%;"></div>
                </div>

                <div id="alert-container" style="margin-bottom:1rem;"></div>

                <form id="registerForm">
                    <!-- Step 1: Personal Info -->
                    <div id="step1">
                        <!-- Name -->
                        <div style="margin-bottom:1rem;">
                            <label class="royal-label" for="name">Nom et Prénom</label>
                            <div class="input-icon-wrap">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <input type="text" id="name" class="royal-input" required placeholder="Jean Dupont">
                            </div>
                            <p class="field-error hidden" id="name-error"></p>
                        </div>

                        <!-- Email -->
                        <div style="margin-bottom:1rem;">
                            <label class="royal-label" for="email">Adresse e-mail</label>
                            <div class="input-icon-wrap">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <input type="email" id="email" class="royal-input" required placeholder="votre@email.com">
                            </div>
                            <p class="field-error hidden" id="email-error"></p>
                        </div>

                        <!-- Country -->
                        <div style="margin-bottom:1.25rem;">
                            <label class="royal-label">Pays</label>
                            <div class="relative" x-data="countrySelector()">
                                <input type="hidden" id="country" name="country" required x-model="selectedValue">

                                <button type="button"
                                    class="royal-dropdown-btn"
                                    :class="{'open': open}"
                                    @click="open = !open">
                                    <span x-show="!selectedFlag" class="placeholder-text">Sélectionnez votre pays</span>
                                    <template x-if="selectedFlag">
                                        <div style="display:flex;align-items:center;gap:.75rem;">
                                            <img :src="`https://flagcdn.com/w20/${selectedFlag}.png`"
                                                 :alt="selectedCountry"
                                                 style="width:24px;height:16px;object-fit:cover;border-radius:2px;">
                                            <span x-text="selectedCountry" style="color:var(--dark-900);"></span>
                                        </div>
                                    </template>
                                    <svg style="width:14px;height:14px;position:absolute;right:12px;top:50%;transform:translateY(-50%) rotate(0deg);transition:transform .2s;color:var(--gold-deep);"
                                         :style="open ? 'transform:translateY(-50%) rotate(180deg)' : 'transform:translateY(-50%) rotate(0deg)'"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="open"
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="royal-dropdown-panel"
                                     style="display:none;">
                                    <div class="royal-dropdown-search">
                                        <input type="text"
                                               x-model="search"
                                               placeholder="Rechercher un pays..."
                                               @click.stop>
                                    </div>
                                    <div class="royal-dropdown-list">
                                        <template x-for="country in filteredCountries" :key="country.value">
                                            <button type="button"
                                                    class="royal-dropdown-option"
                                                    :class="{'selected': selectedValue === country.value}"
                                                    @click="selectCountry(country)">
                                                <img :src="`https://flagcdn.com/w20/${country.flag}.png`"
                                                     :alt="country.name"
                                                     style="width:24px;height:16px;object-fit:cover;border-radius:2px;">
                                                <span x-text="country.name"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <p class="field-error hidden" id="country-error"></p>
                        </div>

                        <button type="button" id="nextButton" class="btn-royal" style="width:100%;">
                            <span>Suivant</span>
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Step 2: Professional Info -->
                    <div id="step2" class="hidden">
                        <!-- Status -->
                        <div style="margin-bottom:1rem;">
                            <label class="royal-label" for="status">Statut actuel</label>
                            <div class="input-icon-wrap">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <select id="status" class="royal-input" required>
                                    <option value="">Sélectionnez votre statut</option>
                                    <option value="student">Étudiant</option>
                                    <option value="professional">Professionnel</option>
                                    <option value="graduate">Diplômé</option>
                                </select>
                            </div>
                            <p class="field-error hidden" id="status-error"></p>
                        </div>

                        <!-- Specialty -->
                        <div style="margin-bottom:1.25rem;">
                            <label class="royal-label" for="specialty">Spécialité / Poste actuel</label>
                            <div class="input-icon-wrap">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <input type="text" id="specialty" class="royal-input" required
                                    placeholder="Ex: Étudiant en Réseaux à l'Université de Pékin">
                            </div>
                            <p class="field-hint">Exemples: Étudiant en Réseaux à l'Université de Pékin, Ingénieur Système chez IBM</p>
                            <p class="field-error hidden" id="specialty-error"></p>
                        </div>

                        <div style="display:flex;gap:.75rem;">
                            <button type="button" id="prevButton" class="btn-ghost" style="flex:1;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                                </svg>
                                <span>Retour</span>
                            </button>
                            <button type="button" id="nextButton2" class="btn-royal" style="flex:1;">
                                <span>Suivant</span>
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Security -->
                    <div id="step3" class="hidden">
                        <!-- Password -->
                        <div style="margin-bottom:1rem;">
                            <label class="royal-label" for="password">Mot de passe</label>
                            <div class="input-icon-wrap">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <input type="password" id="password" class="royal-input" required placeholder="Minimum 8 caractères">
                            </div>
                            <p class="field-error hidden" id="password-error"></p>
                        </div>

                        <!-- Confirm Password -->
                        <div style="margin-bottom:1rem;">
                            <label class="royal-label" for="password_confirmation">Confirmer le mot de passe</label>
                            <div class="input-icon-wrap">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <input type="password" id="password_confirmation" class="royal-input" required placeholder="Confirmez votre mot de passe">
                            </div>
                            <p class="field-error hidden" id="password_confirmation-error"></p>
                        </div>

                        <!-- Terms -->
                        <div style="display:flex;align-items:flex-start;gap:.625rem;margin-bottom:1.25rem;">
                            <input type="checkbox" id="terms" required class="royal-checkbox" style="margin-top:2px;">
                            <label for="terms" style="font-family:var(--font-body);font-size:.85rem;color:var(--dark-800);line-height:1.5;cursor:pointer;">
                                J'accepte les
                                <a href="#" class="royal-link" style="font-weight:700;">conditions d'utilisation</a>
                            </label>
                        </div>

                        <div style="display:flex;gap:.75rem;">
                            <button type="button" id="prevButton2" class="btn-ghost" style="flex:1;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                                </svg>
                                <span>Retour</span>
                            </button>
                            <button type="submit" id="registerButton" class="btn-royal" style="flex:1;">
                                <span id="registerButtonText">Créer mon compte</span>
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="royal-divider"><span>Déjà inscrit</span></div>
                <p style="text-align:center;font-family:var(--font-body);font-size:.85rem;color:var(--dark-700);">
                    Vous avez déjà un compte ?
                    <a href="/login" class="royal-link" style="font-weight:700;margin-left:.25rem;">Se connecter</a>
                </p>
            </div>

            <div style="text-align:center;margin-top:1.5rem;">
                <a href="/" class="royal-link" style="font-size:.8rem;font-family:var(--font-body);display:inline-flex;align-items:center;gap:.5rem;color:var(--dark-600);">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à l'accueil
                </a>
            </div>

        </div>
    </div>

    <script>
        // Alpine.js country selector component
        function countrySelector() {
            return {
                open: false,
                search: '',
                selectedValue: '',
                selectedCountry: '',
                selectedFlag: '',
                countries: [
                    {value: 'afghanistan', name: 'Afghanistan', flag: 'af'},
                    {value: 'south_africa', name: 'Afrique du Sud', flag: 'za'},
                    {value: 'albania', name: 'Albanie', flag: 'al'},
                    {value: 'algeria', name: 'Algérie', flag: 'dz'},
                    {value: 'germany', name: 'Allemagne', flag: 'de'},
                    {value: 'andorra', name: 'Andorre', flag: 'ad'},
                    {value: 'angola', name: 'Angola', flag: 'ao'},
                    {value: 'saudi_arabia', name: 'Arabie Saoudite', flag: 'sa'},
                    {value: 'argentina', name: 'Argentine', flag: 'ar'},
                    {value: 'armenia', name: 'Arménie', flag: 'am'},
                    {value: 'australia', name: 'Australie', flag: 'au'},
                    {value: 'austria', name: 'Autriche', flag: 'at'},
                    {value: 'azerbaijan', name: 'Azerbaïdjan', flag: 'az'},
                    {value: 'bahamas', name: 'Bahamas', flag: 'bs'},
                    {value: 'bahrain', name: 'Bahreïn', flag: 'bh'},
                    {value: 'bangladesh', name: 'Bangladesh', flag: 'bd'},
                    {value: 'barbados', name: 'Barbade', flag: 'bb'},
                    {value: 'belgium', name: 'Belgique', flag: 'be'},
                    {value: 'belize', name: 'Belize', flag: 'bz'},
                    {value: 'benin', name: 'Bénin', flag: 'bj'},
                    {value: 'bhutan', name: 'Bhoutan', flag: 'bt'},
                    {value: 'belarus', name: 'Biélorussie', flag: 'by'},
                    {value: 'bolivia', name: 'Bolivie', flag: 'bo'},
                    {value: 'bosnia', name: 'Bosnie-Herzégovine', flag: 'ba'},
                    {value: 'botswana', name: 'Botswana', flag: 'bw'},
                    {value: 'brazil', name: 'Brésil', flag: 'br'},
                    {value: 'brunei', name: 'Brunei', flag: 'bn'},
                    {value: 'bulgaria', name: 'Bulgarie', flag: 'bg'},
                    {value: 'burkina', name: 'Burkina Faso', flag: 'bf'},
                    {value: 'burundi', name: 'Burundi', flag: 'bi'},
                    {value: 'cambodia', name: 'Cambodge', flag: 'kh'},
                    {value: 'cameroon', name: 'Cameroun', flag: 'cm'},
                    {value: 'canada', name: 'Canada', flag: 'ca'},
                    {value: 'cape_verde', name: 'Cap-Vert', flag: 'cv'},
                    {value: 'chile', name: 'Chili', flag: 'cl'},
                    {value: 'china', name: 'Chine', flag: 'cn'},
                    {value: 'cyprus', name: 'Chypre', flag: 'cy'},
                    {value: 'colombia', name: 'Colombie', flag: 'co'},
                    {value: 'comoros', name: 'Comores', flag: 'km'},
                    {value: 'congo', name: 'Congo', flag: 'cg'},
                    {value: 'drc', name: 'Congo (RDC)', flag: 'cd'},
                    {value: 'north_korea', name: 'Corée du Nord', flag: 'kp'},
                    {value: 'south_korea', name: 'Corée du Sud', flag: 'kr'},
                    {value: 'costa_rica', name: 'Costa Rica', flag: 'cr'},
                    {value: 'ivory_coast', name: "Côte d'Ivoire", flag: 'ci'},
                    {value: 'croatia', name: 'Croatie', flag: 'hr'},
                    {value: 'cuba', name: 'Cuba', flag: 'cu'},
                    {value: 'denmark', name: 'Danemark', flag: 'dk'},
                    {value: 'djibouti', name: 'Djibouti', flag: 'dj'},
                    {value: 'dominica', name: 'Dominique', flag: 'dm'},
                    {value: 'egypt', name: 'Égypte', flag: 'eg'},
                    {value: 'uae', name: 'Émirats Arabes Unis', flag: 'ae'},
                    {value: 'ecuador', name: 'Équateur', flag: 'ec'},
                    {value: 'eritrea', name: 'Érythrée', flag: 'er'},
                    {value: 'spain', name: 'Espagne', flag: 'es'},
                    {value: 'estonia', name: 'Estonie', flag: 'ee'},
                    {value: 'eswatini', name: 'Eswatini', flag: 'sz'},
                    {value: 'usa', name: 'États-Unis', flag: 'us'},
                    {value: 'ethiopia', name: 'Éthiopie', flag: 'et'},
                    {value: 'fiji', name: 'Fidji', flag: 'fj'},
                    {value: 'finland', name: 'Finlande', flag: 'fi'},
                    {value: 'france', name: 'France', flag: 'fr'},
                    {value: 'gabon', name: 'Gabon', flag: 'ga'},
                    {value: 'gambia', name: 'Gambie', flag: 'gm'},
                    {value: 'georgia', name: 'Géorgie', flag: 'ge'},
                    {value: 'ghana', name: 'Ghana', flag: 'gh'},
                    {value: 'greece', name: 'Grèce', flag: 'gr'},
                    {value: 'grenada', name: 'Grenade', flag: 'gd'},
                    {value: 'guatemala', name: 'Guatemala', flag: 'gt'},
                    {value: 'guinea', name: 'Guinée', flag: 'gn'},
                    {value: 'guinea_bissau', name: 'Guinée-Bissau', flag: 'gw'},
                    {value: 'equatorial_guinea', name: 'Guinée équatoriale', flag: 'gq'},
                    {value: 'guyana', name: 'Guyana', flag: 'gy'},
                    {value: 'haiti', name: 'Haïti', flag: 'ht'},
                    {value: 'honduras', name: 'Honduras', flag: 'hn'},
                    {value: 'hungary', name: 'Hongrie', flag: 'hu'},
                    {value: 'india', name: 'Inde', flag: 'in'},
                    {value: 'indonesia', name: 'Indonésie', flag: 'id'},
                    {value: 'iraq', name: 'Irak', flag: 'iq'},
                    {value: 'iran', name: 'Iran', flag: 'ir'},
                    {value: 'ireland', name: 'Irlande', flag: 'ie'},
                    {value: 'iceland', name: 'Islande', flag: 'is'},
                    {value: 'israel', name: 'Israël', flag: 'il'},
                    {value: 'italy', name: 'Italie', flag: 'it'},
                    {value: 'jamaica', name: 'Jamaïque', flag: 'jm'},
                    {value: 'japan', name: 'Japon', flag: 'jp'},
                    {value: 'jordan', name: 'Jordanie', flag: 'jo'},
                    {value: 'kazakhstan', name: 'Kazakhstan', flag: 'kz'},
                    {value: 'kenya', name: 'Kenya', flag: 'ke'},
                    {value: 'kyrgyzstan', name: 'Kirghizistan', flag: 'kg'},
                    {value: 'kiribati', name: 'Kiribati', flag: 'ki'},
                    {value: 'kosovo', name: 'Kosovo', flag: 'xk'},
                    {value: 'kuwait', name: 'Koweït', flag: 'kw'},
                    {value: 'laos', name: 'Laos', flag: 'la'},
                    {value: 'lesotho', name: 'Lesotho', flag: 'ls'},
                    {value: 'latvia', name: 'Lettonie', flag: 'lv'},
                    {value: 'lebanon', name: 'Liban', flag: 'lb'},
                    {value: 'liberia', name: 'Libéria', flag: 'lr'},
                    {value: 'libya', name: 'Libye', flag: 'ly'},
                    {value: 'liechtenstein', name: 'Liechtenstein', flag: 'li'},
                    {value: 'lithuania', name: 'Lituanie', flag: 'lt'},
                    {value: 'luxembourg', name: 'Luxembourg', flag: 'lu'},
                    {value: 'north_macedonia', name: 'Macédoine du Nord', flag: 'mk'},
                    {value: 'madagascar', name: 'Madagascar', flag: 'mg'},
                    {value: 'malaysia', name: 'Malaisie', flag: 'my'},
                    {value: 'malawi', name: 'Malawi', flag: 'mw'},
                    {value: 'maldives', name: 'Maldives', flag: 'mv'},
                    {value: 'mali', name: 'Mali', flag: 'ml'},
                    {value: 'malta', name: 'Malte', flag: 'mt'},
                    {value: 'morocco', name: 'Maroc', flag: 'ma'},
                    {value: 'mauritius', name: 'Maurice', flag: 'mu'},
                    {value: 'mauritania', name: 'Mauritanie', flag: 'mr'},
                    {value: 'mexico', name: 'Mexique', flag: 'mx'},
                    {value: 'micronesia', name: 'Micronésie', flag: 'fm'},
                    {value: 'moldova', name: 'Moldavie', flag: 'md'},
                    {value: 'monaco', name: 'Monaco', flag: 'mc'},
                    {value: 'mongolia', name: 'Mongolie', flag: 'mn'},
                    {value: 'montenegro', name: 'Monténégro', flag: 'me'},
                    {value: 'mozambique', name: 'Mozambique', flag: 'mz'},
                    {value: 'myanmar', name: 'Myanmar', flag: 'mm'},
                    {value: 'namibia', name: 'Namibie', flag: 'na'},
                    {value: 'nauru', name: 'Nauru', flag: 'nr'},
                    {value: 'nepal', name: 'Népal', flag: 'np'},
                    {value: 'nicaragua', name: 'Nicaragua', flag: 'ni'},
                    {value: 'niger', name: 'Niger', flag: 'ne'},
                    {value: 'nigeria', name: 'Nigéria', flag: 'ng'},
                    {value: 'norway', name: 'Norvège', flag: 'no'},
                    {value: 'new_zealand', name: 'Nouvelle-Zélande', flag: 'nz'},
                    {value: 'oman', name: 'Oman', flag: 'om'},
                    {value: 'uganda', name: 'Ouganda', flag: 'ug'},
                    {value: 'uzbekistan', name: 'Ouzbékistan', flag: 'uz'},
                    {value: 'pakistan', name: 'Pakistan', flag: 'pk'},
                    {value: 'palau', name: 'Palaos', flag: 'pw'},
                    {value: 'palestine', name: 'Palestine', flag: 'ps'},
                    {value: 'panama', name: 'Panama', flag: 'pa'},
                    {value: 'papua_new_guinea', name: 'Papouasie-Nouvelle-Guinée', flag: 'pg'},
                    {value: 'paraguay', name: 'Paraguay', flag: 'py'},
                    {value: 'netherlands', name: 'Pays-Bas', flag: 'nl'},
                    {value: 'peru', name: 'Pérou', flag: 'pe'},
                    {value: 'philippines', name: 'Philippines', flag: 'ph'},
                    {value: 'poland', name: 'Pologne', flag: 'pl'},
                    {value: 'portugal', name: 'Portugal', flag: 'pt'},
                    {value: 'qatar', name: 'Qatar', flag: 'qa'},
                    {value: 'dominican_republic', name: 'République Dominicaine', flag: 'do'},
                    {value: 'czech_republic', name: 'République Tchèque', flag: 'cz'},
                    {value: 'romania', name: 'Roumanie', flag: 'ro'},
                    {value: 'uk', name: 'Royaume-Uni', flag: 'gb'},
                    {value: 'russia', name: 'Russie', flag: 'ru'},
                    {value: 'rwanda', name: 'Rwanda', flag: 'rw'},
                    {value: 'saint_kitts', name: 'Saint-Kitts-et-Nevis', flag: 'kn'},
                    {value: 'saint_lucia', name: 'Sainte-Lucie', flag: 'lc'},
                    {value: 'saint_vincent', name: 'Saint-Vincent-et-les-Grenadines', flag: 'vc'},
                    {value: 'samoa', name: 'Samoa', flag: 'ws'},
                    {value: 'san_marino', name: 'Saint-Marin', flag: 'sm'},
                    {value: 'sao_tome', name: 'São Tomé-et-Príncipe', flag: 'st'},
                    {value: 'senegal', name: 'Sénégal', flag: 'sn'},
                    {value: 'serbia', name: 'Serbie', flag: 'rs'},
                    {value: 'seychelles', name: 'Seychelles', flag: 'sc'},
                    {value: 'sierra_leone', name: 'Sierra Leone', flag: 'sl'},
                    {value: 'singapore', name: 'Singapour', flag: 'sg'},
                    {value: 'slovakia', name: 'Slovaquie', flag: 'sk'},
                    {value: 'slovenia', name: 'Slovénie', flag: 'si'},
                    {value: 'somalia', name: 'Somalie', flag: 'so'},
                    {value: 'sudan', name: 'Soudan', flag: 'sd'},
                    {value: 'south_sudan', name: 'Soudan du Sud', flag: 'ss'},
                    {value: 'sri_lanka', name: 'Sri Lanka', flag: 'lk'},
                    {value: 'sweden', name: 'Suède', flag: 'se'},
                    {value: 'switzerland', name: 'Suisse', flag: 'ch'},
                    {value: 'suriname', name: 'Suriname', flag: 'sr'},
                    {value: 'syria', name: 'Syrie', flag: 'sy'},
                    {value: 'tajikistan', name: 'Tadjikistan', flag: 'tj'},
                    {value: 'tanzania', name: 'Tanzanie', flag: 'tz'},
                    {value: 'chad', name: 'Tchad', flag: 'td'},
                    {value: 'thailand', name: 'Thaïlande', flag: 'th'},
                    {value: 'east_timor', name: 'Timor oriental', flag: 'tl'},
                    {value: 'togo', name: 'Togo', flag: 'tg'},
                    {value: 'tonga', name: 'Tonga', flag: 'to'},
                    {value: 'trinidad', name: 'Trinité-et-Tobago', flag: 'tt'},
                    {value: 'tunisia', name: 'Tunisie', flag: 'tn'},
                    {value: 'turkmenistan', name: 'Turkménistan', flag: 'tm'},
                    {value: 'turkey', name: 'Turquie', flag: 'tr'},
                    {value: 'tuvalu', name: 'Tuvalu', flag: 'tv'},
                    {value: 'ukraine', name: 'Ukraine', flag: 'ua'},
                    {value: 'uruguay', name: 'Uruguay', flag: 'uy'},
                    {value: 'vanuatu', name: 'Vanuatu', flag: 'vu'},
                    {value: 'vatican', name: 'Vatican', flag: 'va'},
                    {value: 'venezuela', name: 'Venezuela', flag: 've'},
                    {value: 'vietnam', name: 'Vietnam', flag: 'vn'},
                    {value: 'yemen', name: 'Yémen', flag: 'ye'},
                    {value: 'zambia', name: 'Zambie', flag: 'zm'},
                    {value: 'zimbabwe', name: 'Zimbabwe', flag: 'zw'}
                ],
                get filteredCountries() {
                    if (!this.search) return this.countries;
                    const searchLower = this.search.toLowerCase();
                    return this.countries.filter(c =>
                        c.name.toLowerCase().includes(searchLower)
                    );
                },
                selectCountry(country) {
                    this.selectedValue = country.value;
                    this.selectedCountry = country.name;
                    this.selectedFlag = country.flag;
                    this.open = false;
                    this.search = '';
                }
            }
        }

        let currentStep = 1;

        // Navigation entre les étapes
        // Step 1 -> Step 2
        document.getElementById('nextButton').addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const country = document.getElementById('country').value;

            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));

            if (!name || !email || !country) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '2';
            document.getElementById('progressFill').style.width = '66.66%';
            currentStep = 2;
        });

        // Step 2 -> Step 3
        document.getElementById('nextButton2').addEventListener('click', function() {
            const status = document.getElementById('status').value;
            const specialty = document.getElementById('specialty').value;

            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));

            if (!status || !specialty) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '3';
            document.getElementById('progressFill').style.width = '100%';
            currentStep = 3;
        });

        // Step 2 -> Step 1
        document.getElementById('prevButton').addEventListener('click', function() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '1';
            document.getElementById('progressFill').style.width = '33.33%';
            currentStep = 1;
        });

        // Step 3 -> Step 2
        document.getElementById('prevButton2').addEventListener('click', function() {
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '2';
            document.getElementById('progressFill').style.width = '66.66%';
            currentStep = 2;
        });

        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = document.getElementById('registerButton');
            const buttonText = document.getElementById('registerButtonText');
            const alertContainer = document.getElementById('alert-container');

            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));
            alertContainer.innerHTML = '';

            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password.length < 8) {
                const errorEl = document.getElementById('password-error');
                errorEl.textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
                errorEl.classList.remove('hidden');
                return;
            }

            if (password !== passwordConfirmation) {
                const errorEl = document.getElementById('password_confirmation-error');
                errorEl.textContent = 'Les mots de passe ne correspondent pas.';
                errorEl.classList.remove('hidden');
                return;
            }

            if (!document.getElementById('terms').checked) {
                alertContainer.innerHTML = `
                    <div class="alert-danger">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink:0;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Veuillez accepter les conditions d'utilisation</span>
                    </div>
                `;
                return;
            }

            button.disabled = true;
            buttonText.textContent = 'Inscription en cours...';

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        country: document.getElementById('country').value,
                        password: document.getElementById('password').value,
                        password_confirmation: document.getElementById('password_confirmation').value,
                        status: document.getElementById('status').value,
                        specialty: document.getElementById('specialty').value,
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));

                    alertContainer.innerHTML = `
                        <div class="alert-success">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink:0;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>${data.message}</span>
                        </div>
                    `;

                    setTimeout(() => window.location.href = '/', 1200);
                } else {
                    if (data.errors) {
                        const step1Fields = ['name', 'email', 'country'];
                        const step2Fields = ['status', 'specialty'];

                        const hasStep1Error = Object.keys(data.errors).some(key => step1Fields.includes(key));
                        const hasStep2Error = Object.keys(data.errors).some(key => step2Fields.includes(key));

                        if (hasStep1Error && currentStep !== 1) {
                            document.getElementById('step2').classList.add('hidden');
                            document.getElementById('step3').classList.add('hidden');
                            document.getElementById('step1').classList.remove('hidden');
                            document.getElementById('stepIndicator').textContent = '1';
                            document.getElementById('progressFill').style.width = '33.33%';
                            currentStep = 1;
                        } else if (hasStep2Error && currentStep !== 2) {
                            document.getElementById('step1').classList.add('hidden');
                            document.getElementById('step3').classList.add('hidden');
                            document.getElementById('step2').classList.remove('hidden');
                            document.getElementById('stepIndicator').textContent = '2';
                            document.getElementById('progressFill').style.width = '66.66%';
                            currentStep = 2;
                        }

                        Object.keys(data.errors).forEach(key => {
                            const el = document.getElementById(`${key}-error`);
                            if (el) {
                                el.textContent = data.errors[key][0];
                                el.classList.remove('hidden');
                            }
                        });

                        const firstError = Object.values(data.errors)[0][0];
                        alertContainer.innerHTML = `
                            <div class="alert-danger">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink:0;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>${firstError}</span>
                            </div>
                        `;
                    } else if (data.message) {
                        alertContainer.innerHTML = `
                            <div class="alert-danger">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink:0;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>${data.message}</span>
                            </div>
                        `;
                    }
                }
            } catch (error) {
                alertContainer.innerHTML = `
                    <div class="alert-danger">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink:0;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Erreur de connexion au serveur</span>
                    </div>
                `;
            } finally {
                button.disabled = false;
                buttonText.textContent = 'Créer mon compte';
            }
        });
    </script>
</body>
</html>

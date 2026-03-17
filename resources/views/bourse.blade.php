<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Testez votre éligibilité aux bourses d'études - Travel Express Burkina Faso">
    <title>Ma Bourse - Travel Express</title>

    <!-- Google Fonts -->
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
            --color-success: #2ECABB;
            --color-warning: #F0B428;
            --color-danger:  #E74C3C;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--dark-800);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
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
                radial-gradient(ellipse 70vw 50vh at 15% 0%, rgba(201,168,76,.05) 0%, transparent 70%),
                radial-gradient(ellipse 50vw 40vh at 85% 100%, rgba(201,168,76,.03) 0%, transparent 70%);
            pointer-events: none;
        }
    </style>
    <script src="{{ asset('js/country-codes.js') }}"></script>
</head>
<body class="antialiased" x-data="{
    moyenne: '',
    resultat: null,
    bourses: [],
    contactModalOpen: false,
    selectedBourse: null,
    formSuccess: false,
    formLoading: false,

    determinerBourse() {
        const moy = parseFloat(this.moyenne);

        if (isNaN(moy) || moy < 0 || moy > 20) {
            this.resultat = { message: 'Veuillez entrer une moyenne valide entre 0 et 20.', type: null, color: 'red' };
            this.bourses = [];
            return;
        }

        if (moy >= 16) {
            this.resultat = { message: 'Félicitations ! Vous avez droit à une bourse complète.', type: 'complète', color: 'green' };
        } else if (moy >= 14) {
            this.resultat = { message: 'Bravo ! Vous avez droit à une bourse complète.', type: 'complète', color: 'green' };
        } else if (moy >= 12) {
            this.resultat = { message: 'Vous avez droit à une bourse semi-complète.', type: 'semi-complète', color: 'blue' };
        } else if (moy >= 10) {
            this.resultat = { message: 'Vous êtes éligible à une bourse partielle.', type: 'partielle', color: 'yellow' };
        } else {
            this.resultat = { message: 'Malheureusement, votre moyenne ne vous permet pas d\'accéder à une bourse. Travaillez dur pour améliorer vos résultats !', type: null, color: 'red' };
            this.bourses = [];
            return;
        }

        this.filtrerBourses();
    },

    filtrerBourses() {
        const toutesLesBourses = [
            { nom: 'Bourse d\'Excellence Chine', type: 'complète', pays: 'Chine', destination: 'china', description: 'Couverture totale des frais de scolarité et hébergement', icon: '🇨🇳' },
            { nom: 'Bourse Gouvernementale CSC', type: 'complète', pays: 'Chine', destination: 'china', description: 'Programme officiel du gouvernement chinois', icon: '🎓' },
            { nom: 'Bourse Mérite Espagne', type: 'complète', pays: 'Espagne', destination: 'spain', description: 'Pour les étudiants excellents en sciences', icon: '🇪🇸' },
            { nom: 'Bourse DAAD Allemagne', type: 'complète', pays: 'Allemagne', destination: 'germany', description: 'Programme d\'échange académique allemand', icon: '🇩🇪' },
            { nom: 'Bourse Semi-Complète Chine', type: 'semi-complète', pays: 'Chine', destination: 'china', description: '50% des frais de scolarité couverts', icon: '🇨🇳' },
            { nom: 'Bourse Erasmus+', type: 'semi-complète', pays: 'Espagne', destination: 'spain', description: 'Programme européen de mobilité', icon: '🇪🇺' },
            { nom: 'Bourse Partielle Universitaire', type: 'partielle', pays: 'Chine', destination: 'china', description: 'Réduction sur les frais de scolarité', icon: '📚' },
            { nom: 'Aide à la Formation', type: 'partielle', pays: 'Allemagne', destination: 'germany', description: 'Soutien financier pour formations techniques', icon: '🛠️' }
        ];

        if (this.resultat && this.resultat.type) {
            const types = [];
            if (this.resultat.type === 'complète') {
                types.push('complète', 'semi-complète', 'partielle');
            } else if (this.resultat.type === 'semi-complète') {
                types.push('semi-complète', 'partielle');
            } else if (this.resultat.type === 'partielle') {
                types.push('partielle');
            }
            this.bourses = toutesLesBourses.filter(b => types.includes(b.type));
        }
    },

    getTypeColor(type) {
        switch(type) {
            case 'complète': return 'badge-success';
            case 'semi-complète': return 'badge-blue';
            case 'partielle': return 'badge-warning';
            default: return 'badge-gray';
        }
    },

    openContactModal(bourse = null) {
        this.selectedBourse = bourse;
        this.contactModalOpen = true;
        this.formSuccess = false;
        document.body.style.overflow = 'hidden';

        this.$nextTick(() => {
            if (bourse) {
                const destinationSelect = document.getElementById('modal-destination');
                if (destinationSelect && bourse.destination) {
                    destinationSelect.value = bourse.destination;
                }
                const projectSelect = document.getElementById('modal-project-type');
                if (projectSelect) {
                    projectSelect.value = 'etudes';
                }
                const messageField = document.getElementById('modal-message');
                if (messageField) {
                    messageField.value = `Je souhaite postuler pour la ${bourse.nom}. Ma moyenne est de ${this.moyenne}/20.`;
                }
            }
        });
    },

    closeContactModal() {
        this.contactModalOpen = false;
        this.selectedBourse = null;
        document.body.style.overflow = '';
    },

    async submitContactForm(event) {
        event.preventDefault();
        this.formLoading = true;

        const form = event.target;
        const formData = new FormData(form);

        const phoneCode = document.getElementById('modal-phone-code')?.value || '+226';
        const phone = phoneCode + formData.get('phone');

        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: phone,
            destination: formData.get('destination'),
            project_type: formData.get('project_type'),
            message: formData.get('message')
        };

        try {
            const response = await fetch('/api/contact-requests', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                this.formSuccess = true;
                form.reset();
            } else {
                const result = await response.json();
                alert(result.message || 'Une erreur est survenue. Veuillez réessayer.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue. Veuillez réessayer.');
        } finally {
            this.formLoading = false;
        }
    }
}">

    <style>
        /* ── Header ─────────────────────────────────────────────────── */
        .site-header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 40;
            background: rgba(8,8,8,.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,168,76,.15);
        }
        .header-inner {
            display: flex; align-items: center; justify-content: space-between;
            height: 70px; padding: 0 1.5rem;
            max-width: 1100px; margin: 0 auto;
        }
        .logo-link { display: flex; align-items: center; gap: .75rem; text-decoration: none; }
        .logo-icon {
            width: 44px; height: 44px; border-radius: var(--r-lg);
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
        }
        .logo-icon svg { color: #000; }
        .logo-name {
            font-family: var(--font-serif); font-size: 1.3rem;
            font-weight: 700; color: var(--dark-900); letter-spacing: .02em;
        }
        .logo-sub {
            font-family: var(--font-body); font-size: .6rem;
            font-weight: 700; letter-spacing: .2em;
            text-transform: uppercase; color: var(--gold-primary);
            display: block; margin-top: -2px;
        }
        .btn-back {
            display: flex; align-items: center; gap: .5rem;
            padding: .5rem 1.1rem;
            border: 1px solid rgba(201,168,76,.25);
            border-radius: var(--r-lg);
            font-family: var(--font-body); font-size: .82rem; font-weight: 600;
            color: var(--gold-primary); text-decoration: none;
            transition: all .2s; background: transparent;
        }
        .btn-back:hover { background: rgba(201,168,76,.08); border-color: rgba(201,168,76,.5); }

        /* ── Main ───────────────────────────────────────────────────── */
        main {
            position: relative; z-index: 1;
            padding-top: 90px; padding-bottom: 3rem;
        }
        .page-inner { max-width: 900px; margin: 0 auto; padding: 0 1.25rem; }

        /* ── Hero ───────────────────────────────────────────────────── */
        .hero-section { text-align: center; margin-bottom: 2.5rem; }
        .hero-icon {
            width: 72px; height: 72px; border-radius: var(--r-xl);
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            box-shadow: var(--glow-gold);
        }
        .hero-icon svg { color: #000; }
        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(2rem,5vw,3rem);
            letter-spacing: .06em;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .75rem;
        }
        .hero-desc { font-size: .95rem; color: var(--dark-600); max-width: 560px; margin: 0 auto; line-height: 1.6; }

        /* ── Cards ──────────────────────────────────────────────────── */
        .lux-card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            overflow: hidden; position: relative;
            margin-bottom: 1.5rem;
        }
        .lux-card::before {
            content: '';
            position: absolute; top: 0; left: 10%; right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.45), transparent);
        }

        /* ── Form inputs ────────────────────────────────────────────── */
        .form-label {
            display: block; font-size: .7rem; font-weight: 700;
            letter-spacing: .15em; text-transform: uppercase;
            color: var(--gold-deep); margin-bottom: .5rem;
        }
        .form-input {
            width: 100%; padding: .875rem 1rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            color: var(--dark-900);
            font-family: var(--font-body); font-size: .95rem;
            transition: border-color .25s, box-shadow .25s; outline: none;
        }
        .form-input:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.1);
        }
        .form-input::placeholder { color: var(--dark-500); }

        /* ── Buttons ────────────────────────────────────────────────── */
        .btn-primary {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .875rem 1.75rem;
            background: var(--gold-gradient);
            color: #080808;
            font-family: var(--font-body); font-size: .85rem; font-weight: 700;
            letter-spacing: .1em; text-transform: uppercase;
            border: none; border-radius: var(--r-lg); cursor: pointer;
            transition: box-shadow .3s, transform .2s;
        }
        .btn-primary:hover { box-shadow: var(--glow-gold-strong); transform: translateY(-2px); }
        .btn-primary:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        .btn-secondary {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .875rem 1.5rem;
            background: transparent;
            color: var(--gold-primary);
            border: 1px solid rgba(201,168,76,.3);
            border-radius: var(--r-lg); cursor: pointer;
            font-family: var(--font-body); font-size: .85rem; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase;
            transition: all .2s; text-decoration: none;
        }
        .btn-secondary:hover { background: rgba(201,168,76,.08); border-color: rgba(201,168,76,.55); }

        /* ── Result box ─────────────────────────────────────────────── */
        .result-box {
            border-radius: var(--r-xl); padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem; border: 1px solid;
            transition: all .3s;
        }
        .result-success {
            background: rgba(46,202,187,.07);
            border-color: rgba(46,202,187,.25);
        }
        .result-warning {
            background: rgba(240,180,40,.07);
            border-color: rgba(240,180,40,.25);
        }
        .result-info {
            background: rgba(96,165,250,.07);
            border-color: rgba(96,165,250,.25);
        }
        .result-error {
            background: rgba(231,76,60,.07);
            border-color: rgba(231,76,60,.25);
        }

        /* ── Badges ─────────────────────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px; border-radius: var(--r-full);
            font-size: .7rem; font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase; border: 1px solid;
        }
        .badge-success { color:var(--color-success); border-color:rgba(46,202,187,.35); background:rgba(46,202,187,.08); }
        .badge-blue    { color:#60a5fa; border-color:rgba(96,165,250,.35); background:rgba(96,165,250,.08); }
        .badge-warning { color:var(--color-warning); border-color:rgba(240,180,40,.35); background:rgba(240,180,40,.08); }
        .badge-gray    { color:var(--dark-700); border-color:rgba(176,176,176,.3); background:rgba(176,176,176,.06); }
        .badge-gold    { color:var(--gold-primary); border-color:rgba(201,168,76,.3); background:rgba(201,168,76,.08); }

        /* ── Scholarship card ───────────────────────────────────────── */
        .bourse-card {
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.12);
            border-radius: var(--r-lg);
            padding: 1.1rem 1.25rem;
            transition: all .25s;
        }
        .bourse-card:hover {
            background: var(--dark-300);
            border-color: rgba(201,168,76,.3);
            box-shadow: var(--glow-gold);
        }

        /* ── Info section ───────────────────────────────────────────── */
        .info-section {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.12);
            border-radius: var(--r-xl);
            padding: 1.75rem 2rem;
            margin-top: 2rem;
        }
        .info-step {
            display: flex; align-items: flex-start; gap: .875rem;
            padding: .75rem 0;
            border-bottom: 1px solid rgba(201,168,76,.07);
        }
        .info-step:last-child { border-bottom: none; }
        .step-num {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-body); font-size: .75rem; font-weight: 700;
            flex-shrink: 0;
        }

        /* ── Modal overlay ──────────────────────────────────────────── */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 50;
            display: flex; align-items: center; justify-content: center;
            padding: 1rem;
            background: rgba(0,0,0,.7);
            backdrop-filter: blur(4px);
        }
        .modal-box {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.2);
            border-radius: var(--r-xl);
            width: 100%; max-width: 520px;
            max-height: 90vh; overflow-y: auto;
            position: relative;
            box-shadow: 0 24px 80px rgba(0,0,0,.8), var(--glow-gold);
        }
        .modal-box::before {
            content: '';
            position: absolute; top: 0; left: 10%; right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.5), transparent);
        }
        .modal-header {
            position: sticky; top: 0;
            background: var(--dark-100);
            border-bottom: 1px solid rgba(201,168,76,.12);
            padding: 1.25rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            border-radius: var(--r-xl) var(--r-xl) 0 0;
            z-index: 10;
        }
        .modal-title {
            font-family: var(--font-display);
            font-size: 1.5rem; font-weight: 400;
            letter-spacing: .08em; color: var(--dark-900);
        }
        .modal-close {
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(201,168,76,.08);
            border: 1px solid rgba(201,168,76,.2);
            color: var(--dark-700); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all .2s;
        }
        .modal-close:hover { color: var(--gold-primary); border-color: rgba(201,168,76,.5); }
        .modal-body { padding: 1.5rem; }

        /* ── Select styling ─────────────────────────────────────────── */
        select.form-input { appearance: none; background-image: url("data:image/svg+xml,%3Csvg fill='%238B6914' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right .75rem center; background-size: 1.1em; padding-right: 2.5rem; }
        textarea.form-input { resize: vertical; min-height: 90px; }

        /* ── Checkbox ───────────────────────────────────────────────── */
        .checkbox-label { display: flex; align-items: flex-start; gap: .75rem; cursor: pointer; }
        .checkbox-label input[type="checkbox"] {
            width: 16px; height: 16px; flex-shrink: 0; margin-top: 2px;
            accent-color: var(--gold-primary);
        }

        /* ── Trust badges ───────────────────────────────────────────── */
        .trust-badge {
            display: flex; align-items: center; gap: .4rem;
            font-size: .75rem; color: var(--dark-600);
        }

        /* ── Footer ─────────────────────────────────────────────────── */
        .site-footer {
            position: relative; z-index: 1;
            border-top: 1px solid rgba(201,168,76,.1);
            padding: 1.5rem 1.25rem;
            text-align: center;
        }
        .site-footer p { font-size: .85rem; color: var(--dark-600); }

        /* ── Scrollbar ──────────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-0); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,.25); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,.5); }

        /* Phone dropdown */
        .phone-wrap { display: flex; gap: .5rem; }
        .phone-flag-btn {
            display: flex; align-items: center; gap: .4rem;
            padding: .875rem .75rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            cursor: pointer; color: var(--dark-900);
            font-family: var(--font-body); font-size: .85rem; font-weight: 600;
            transition: all .2s; white-space: nowrap; min-width: 110px;
        }
        .phone-flag-btn:hover { border-color: rgba(201,168,76,.4); }
        .phone-dropdown {
            position: absolute; z-index: 50; left: 0; top: calc(100% + 6px);
            width: 260px;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.2);
            border-radius: var(--r-lg);
            box-shadow: 0 16px 48px rgba(0,0,0,.6);
            overflow: hidden;
        }
        .phone-search {
            width: 100%; padding: .6rem .875rem;
            background: var(--dark-300);
            border: none; border-bottom: 1px solid rgba(201,168,76,.1);
            color: var(--dark-900); font-family: var(--font-body); font-size: .85rem;
            outline: none;
        }
        .phone-list { max-height: 200px; overflow-y: auto; }
        .phone-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .6rem .875rem; cursor: pointer;
            transition: background .15s;
            font-size: .85rem;
        }
        .phone-item:hover,
        .phone-item.selected { background: rgba(201,168,76,.08); }
        .phone-item-country { flex: 1; color: var(--dark-800); }
        .phone-item-code { color: var(--dark-600); font-weight: 600; }

        /* Animate in */
        @keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
        .animate-in { animation: fadeUp .5s ease both; }
    </style>

    <!-- Header -->
    <header class="site-header">
        <div class="header-inner">
            <a href="/" class="logo-link">
                <div class="logo-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="logo-name">Travel Express</span>
                    <span class="logo-sub">Study Abroad</span>
                </div>
            </a>

            <a href="/" class="btn-back">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="hidden sm:inline">Retour à l'accueil</span>
                <span class="sm:hidden">Retour</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="page-inner">

            <!-- Hero Section -->
            <div class="hero-section animate-in">
                <div class="hero-icon">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="hero-title">Testez votre éligibilité</h1>
                <p class="hero-desc">
                    Entrez votre moyenne générale pour découvrir les bourses auxquelles vous pouvez prétendre
                </p>
            </div>

            <!-- Calculator Card -->
            <div class="lux-card animate-in" style="padding:1.75rem;animation-delay:.05s;">
                <div style="display:flex;flex-wrap:wrap;gap:1rem;align-items:flex-end;">
                    <div style="flex:1;min-width:200px;">
                        <label for="moyenne" class="form-label">
                            Votre moyenne générale <span style="color:var(--color-danger)">*</span>
                        </label>
                        <div style="position:relative;">
                            <input
                                type="number"
                                id="moyenne"
                                x-model="moyenne"
                                @keyup.enter="determinerBourse()"
                                min="0"
                                max="20"
                                step="0.01"
                                placeholder="Ex: 14.5"
                                class="form-input"
                                style="padding-right:3rem;"
                            >
                            <span style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);color:var(--dark-600);font-weight:700;font-size:.9rem;">/20</span>
                        </div>
                    </div>
                    <div>
                        <button
                            @click="determinerBourse()"
                            class="btn-primary"
                        >
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <span>Vérifier</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Result Section -->
            <template x-if="resultat">
                <div
                    class="result-box"
                    :class="{
                        'result-success': resultat.color === 'green',
                        'result-info':    resultat.color === 'blue',
                        'result-warning': resultat.color === 'yellow',
                        'result-error':   resultat.color === 'red'
                    }"
                >
                    <div style="display:flex;align-items:flex-start;gap:1rem;">
                        <div
                            style="width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid;"
                            :style="resultat.type
                                ? 'background:rgba(46,202,187,.12);border-color:rgba(46,202,187,.3);'
                                : 'background:rgba(231,76,60,.12);border-color:rgba(231,76,60,.3);'"
                        >
                            <template x-if="resultat.type">
                                <svg width="20" height="20" fill="none" stroke="#2ECABB" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </template>
                            <template x-if="!resultat.type">
                                <svg width="20" height="20" fill="none" stroke="#E74C3C" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </template>
                        </div>
                        <div style="flex:1;">
                            <h3
                                style="font-family:var(--font-display);font-size:1.25rem;font-weight:400;letter-spacing:.06em;margin-bottom:.35rem;"
                                :style="resultat.type ? 'color:var(--color-success)' : 'color:var(--color-danger)'"
                            >
                                <span x-show="resultat.type">Éligible à une bourse <span x-text="resultat.type"></span></span>
                                <span x-show="!resultat.type">Non éligible</span>
                            </h3>
                            <p
                                style="font-size:.9rem;line-height:1.6;"
                                :style="resultat.type ? 'color:var(--dark-700)' : 'color:var(--dark-600)'"
                                x-text="resultat.message"
                            ></p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Scholarships List -->
            <template x-if="bourses.length > 0">
                <div>
                    <h2 style="font-family:var(--font-display);font-size:1.6rem;font-weight:400;letter-spacing:.06em;color:var(--dark-900);margin-bottom:1.25rem;display:flex;align-items:center;gap:.6rem;">
                        <svg width="22" height="22" fill="none" stroke="var(--gold-primary)" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Bourses disponibles pour vous
                    </h2>

                    <div style="display:flex;flex-direction:column;gap:.875rem;">
                        <template x-for="(bourse, index) in bourses" :key="index">
                            <div class="bourse-card">
                                <div style="display:flex;flex-wrap:wrap;align-items:center;gap:1rem;">
                                    <div style="display:flex;align-items:center;gap:1rem;flex:1;min-width:200px;">
                                        <div style="font-size:2rem;flex-shrink:0;" x-text="bourse.icon"></div>
                                        <div style="flex:1;min-width:0;">
                                            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:.5rem;margin-bottom:.35rem;">
                                                <span style="font-family:var(--font-body);font-weight:700;color:var(--dark-900);font-size:.95rem;" x-text="bourse.nom"></span>
                                                <span class="badge" :class="getTypeColor(bourse.type)" x-text="bourse.type"></span>
                                            </div>
                                            <p style="font-size:.85rem;color:var(--dark-600);" x-text="bourse.description"></p>
                                            <p style="font-size:.8rem;color:var(--dark-500);margin-top:.25rem;">
                                                <span style="font-weight:700;color:var(--gold-deep);">Pays :</span> <span x-text="bourse.pays"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <button
                                        @click="openContactModal(bourse)"
                                        class="btn-primary"
                                        style="white-space:nowrap;"
                                    >
                                        <span>Postuler</span>
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <!-- Info Section -->
            <div class="info-section">
                <h3 style="font-family:var(--font-display);font-size:1.3rem;font-weight:400;letter-spacing:.06em;color:var(--dark-900);margin-bottom:1.25rem;display:flex;align-items:center;gap:.5rem;">
                    <svg width="18" height="18" fill="none" stroke="var(--gold-primary)" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Comment ça marche ?
                </h3>
                <div>
                    <div class="info-step">
                        <span class="step-num" style="background:var(--gold-gradient);color:#000;">1</span>
                        <span style="font-size:.9rem;color:var(--dark-700);"><strong style="color:var(--dark-900);">16-20/20 :</strong> Bourse complète — 100% des frais couverts</span>
                    </div>
                    <div class="info-step">
                        <span class="step-num" style="background:var(--gold-gradient);color:#000;">2</span>
                        <span style="font-size:.9rem;color:var(--dark-700);"><strong style="color:var(--dark-900);">14-16/20 :</strong> Bourse complète — Excellents résultats</span>
                    </div>
                    <div class="info-step">
                        <span class="step-num" style="background:rgba(96,165,250,.15);color:#60a5fa;border:1px solid rgba(96,165,250,.3);">3</span>
                        <span style="font-size:.9rem;color:var(--dark-700);"><strong style="color:var(--dark-900);">12-14/20 :</strong> Bourse semi-complète — 50% des frais couverts</span>
                    </div>
                    <div class="info-step">
                        <span class="step-num" style="background:rgba(240,180,40,.1);color:var(--color-warning);border:1px solid rgba(240,180,40,.3);">4</span>
                        <span style="font-size:.9rem;color:var(--dark-700);"><strong style="color:var(--dark-900);">10-12/20 :</strong> Bourse partielle — Réduction sur les frais</span>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div style="text-align:center;margin-top:2.5rem;">
                <p style="color:var(--dark-600);margin-bottom:1rem;font-size:.9rem;">
                    Besoin d'aide pour votre dossier de bourse ?
                </p>
                <button
                    @click="openContactModal(null)"
                    class="btn-primary"
                >
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Contactez-nous</span>
                </button>
            </div>
        </div>
    </main>

    <!-- Contact Modal -->
    <div
        x-show="contactModalOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="modal-overlay"
        @click.self="closeContactModal()"
        style="display: none;"
    >
        <div
            x-show="contactModalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="modal-box"
        >
            <!-- Modal Header -->
            <div class="modal-header">
                <div>
                    <h3 class="modal-title">Postuler</h3>
                    <p style="font-size:.8rem;color:var(--gold-primary);" x-show="selectedBourse" x-text="selectedBourse?.nom"></p>
                </div>
                <button @click="closeContactModal()" class="modal-close">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Success Message -->
                <div x-show="formSuccess" style="text-align:center;padding:2rem 1rem;">
                    <div style="width:72px;height:72px;border-radius:50%;background:rgba(46,202,187,.12);border:1px solid rgba(46,202,187,.35);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <svg width="32" height="32" fill="none" stroke="#2ECABB" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.8rem;font-weight:400;letter-spacing:.06em;color:var(--dark-900);margin-bottom:.5rem;">Demande envoyée !</h4>
                    <p style="color:var(--dark-600);margin-bottom:1.5rem;font-size:.9rem;">Notre équipe vous contactera sous 24h via WhatsApp ou email.</p>
                    <button @click="closeContactModal()" class="btn-primary">Fermer</button>
                </div>

                <!-- Contact Form -->
                <form x-show="!formSuccess" @submit="submitContactForm($event)" style="display:flex;flex-direction:column;gap:1rem;">
                    <!-- Name & Email -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                        <div>
                            <label for="modal-name" class="form-label">Nom complet <span style="color:var(--color-danger)">*</span></label>
                            <input type="text" id="modal-name" name="name" required placeholder="Votre nom" class="form-input">
                        </div>
                        <div>
                            <label for="modal-email" class="form-label">Email <span style="color:var(--color-danger)">*</span></label>
                            <input type="email" id="modal-email" name="email" required placeholder="votre@email.com" class="form-input">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="modal-phone" class="form-label">WhatsApp / Téléphone <span style="color:var(--color-danger)">*</span></label>
                        <div class="phone-wrap" x-data="{
                            open: false,
                            search: '',
                            selectedCode: '+226',
                            selectedIso: 'bf',
                            selectedCountry: 'Burkina Faso',
                            countries: window.COUNTRY_PHONE_CODES || [],
                            get filteredCountries() {
                                if (!this.search) return this.countries;
                                const s = this.search.toLowerCase();
                                return this.countries.filter(c => c.country.toLowerCase().includes(s) || c.code.includes(s));
                            },
                            selectCountry(c) {
                                this.selectedCode = c.code;
                                this.selectedIso = c.iso;
                                this.selectedCountry = c.country;
                                this.open = false;
                                this.search = '';
                                document.getElementById('modal-phone-code').value = c.code;
                            }
                        }">
                            <input type="hidden" id="modal-phone-code" name="phone_code" x-bind:value="selectedCode">

                            <div style="position:relative;">
                                <button type="button" @click="open = !open" class="phone-flag-btn">
                                    <img :src="'https://flagcdn.com/24x18/' + selectedIso + '.png'"
                                         :alt="selectedCountry"
                                         style="width:20px;height:14px;object-fit:cover;border-radius:2px;"
                                         onerror="this.style.display='none'">
                                    <span x-text="selectedCode"></span>
                                    <svg :class="{ 'rotate-180': open }" style="transition:transform .2s;margin-left:auto;" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" x-transition class="phone-dropdown" style="display: none;">
                                    <div style="padding:.5rem;">
                                        <input type="text" x-model="search" placeholder="Rechercher..."
                                               class="phone-search" style="border-radius:var(--r-md);" @click.stop>
                                    </div>
                                    <div class="phone-list">
                                        <template x-for="c in filteredCountries" :key="c.iso">
                                            <div @click="selectCountry(c)" class="phone-item" :class="{ selected: selectedIso === c.iso }">
                                                <img :src="'https://flagcdn.com/24x18/' + c.iso + '.png'"
                                                     :alt="c.country"
                                                     style="width:20px;height:14px;object-fit:cover;border-radius:2px;"
                                                     onerror="this.style.display='none'">
                                                <span class="phone-item-country" x-text="c.country"></span>
                                                <span class="phone-item-code" x-text="c.code"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <input type="tel" id="modal-phone" name="phone" required placeholder="65 60 45 92" class="form-input" style="flex:1;">
                        </div>
                    </div>

                    <!-- Destination & Project Type -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                        <div>
                            <label for="modal-destination" class="form-label">Destination <span style="color:var(--color-danger)">*</span></label>
                            <select id="modal-destination" name="destination" required class="form-input">
                                <option value="">Choisir...</option>
                                <option value="china">🇨🇳 Chine</option>
                                <option value="germany">🇩🇪 Allemagne</option>
                                <option value="spain">🇪🇸 Espagne</option>
                                <option value="other">🌍 Autre</option>
                            </select>
                        </div>
                        <div>
                            <label for="modal-project-type" class="form-label">Type de projet <span style="color:var(--color-danger)">*</span></label>
                            <select id="modal-project-type" name="project_type" required class="form-input">
                                <option value="">Choisir...</option>
                                <option value="etudes">📚 Études</option>
                                <option value="travail">💼 Travail</option>
                                <option value="business">🏢 Business</option>
                                <option value="autre">📋 Autre</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="modal-message" class="form-label">Votre message</label>
                        <textarea id="modal-message" name="message" rows="3"
                                  placeholder="Décrivez brièvement votre projet..."
                                  class="form-input"></textarea>
                    </div>

                    <!-- Consent -->
                    <label class="checkbox-label">
                        <input type="checkbox" id="modal-consent" name="consent" required
                               style="accent-color:var(--gold-primary);width:16px;height:16px;flex-shrink:0;margin-top:2px;">
                        <span style="font-size:.85rem;color:var(--dark-700);line-height:1.5;">
                            J'accepte d'être contacté(e) par Travel Express. <span style="color:var(--color-danger)">*</span>
                        </span>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit"
                            :disabled="formLoading"
                            class="btn-primary"
                            style="width:100%;justify-content:center;padding:1rem;">
                        <span x-show="!formLoading">Envoyer ma demande</span>
                        <svg x-show="!formLoading" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <svg x-show="formLoading" style="animation:spin .8s linear infinite;" width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <circle style="opacity:.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path style="opacity:.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-show="formLoading">Envoi en cours...</span>
                    </button>

                    <!-- Trust badges -->
                    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:1rem;padding-top:.5rem;">
                        <div class="trust-badge">
                            <svg width="14" height="14" fill="var(--color-success)" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Sécurisé</span>
                        </div>
                        <div class="trust-badge">
                            <svg width="14" height="14" fill="none" stroke="var(--gold-primary)" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Réponse 24h</span>
                        </div>
                        <div class="trust-badge">
                            <svg width="14" height="14" fill="none" stroke="var(--color-success)" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Gratuit</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <p>&copy; 2024 Travel Express Burkina Faso. Tous droits réservés.</p>
    </footer>
</body>
</html>

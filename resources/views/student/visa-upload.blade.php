<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dossier Visa — Travel Express</title>
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

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--dark-800);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
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
                radial-gradient(ellipse 80vw 60vh at 15% 0%, rgba(201,168,76,.055) 0%, transparent 70%),
                radial-gradient(ellipse 60vw 50vh at 85% 100%, rgba(201,168,76,.035) 0%, transparent 70%);
            pointer-events: none;
        }

        .page-wrap {
            position: relative; z-index: 1;
            max-width: 700px;
            margin: 0 auto;
            padding: 3rem 1.25rem 5rem;
        }

        /* ── Card ──────────────────────────────────────────────────── */
        .card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute; top: 0; left: 12%; right: 12%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.55), transparent);
        }

        .card-body { padding: 2rem; }

        /* ── Ornament ──────────────────────────────────────────────── */
        .ornament {
            display: flex; align-items: center; gap: 14px;
            color: var(--gold-primary);
            font-family: var(--font-display);
            font-size: 0.8rem; letter-spacing: 0.2em; text-transform: uppercase;
        }
        .ornament::before, .ornament::after { content: ''; flex: 1; height: 1px; }
        .ornament::before { background: linear-gradient(90deg, transparent, rgba(201,168,76,.4)); }
        .ornament::after  { background: linear-gradient(90deg, rgba(201,168,76,.4), transparent); }

        .divider { border: none; border-top: 1px solid rgba(201,168,76,.1); margin: 1.5rem 0; }

        /* ── Typography ────────────────────────────────────────────── */
        .display-heading {
            font-family: var(--font-display);
            letter-spacing: .06em;
        }

        .section-label {
            font-family: var(--font-body);
            font-size: 0.7rem; letter-spacing: 0.15em;
            font-weight: 700; text-transform: uppercase;
            color: var(--gold-deep);
            display: block;
        }

        .muted { color: var(--dark-600); }
        .text-gold { color: var(--gold-primary); }
        .text-success { color: var(--color-success); }
        .text-danger  { color: var(--color-danger); }

        /* ── Progress ──────────────────────────────────────────────── */
        .progress-track {
            height: 3px;
            background: rgba(201,168,76,.1);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: var(--gold-gradient);
            border-radius: 2px;
            transition: width 0.7s cubic-bezier(0.4,0,0.2,1);
            box-shadow: 0 0 10px rgba(201,168,76,.45);
        }

        /* ── Badge ─────────────────────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: var(--r-full);
            font-size: 0.75rem; font-weight: 700; letter-spacing: 0.06em;
            border: 1px solid; white-space: nowrap; text-transform: uppercase;
        }
        .badge-gold    { color: var(--gold-primary);    border-color: rgba(201,168,76,.4);  background: rgba(201,168,76,.07); }
        .badge-green   { color: var(--color-success);   border-color: rgba(46,202,187,.4);  background: rgba(46,202,187,.07); }
        .badge-red     { color: var(--color-danger);    border-color: rgba(231,76,60,.4);   background: rgba(231,76,60,.07); }
        .badge-gray    { color: var(--dark-700);        border-color: rgba(176,176,176,.3); background: rgba(176,176,176,.06); }

        /* ── Avatar ────────────────────────────────────────────────── */
        .avatar {
            width: 50px; height: 50px; border-radius: var(--r-lg); flex-shrink: 0;
            background: var(--dark-200);
            border: 1.5px solid rgba(201,168,76,.3);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-serif); font-size: 1.15rem;
            color: var(--gold-primary); font-weight: 700;
        }

        /* ── Form inputs ───────────────────────────────────────────── */
        .field-label {
            font-family: var(--font-body);
            font-size: 0.7rem; letter-spacing: .15em; font-weight: 700;
            text-transform: uppercase; color: var(--gold-deep);
            display: block; margin-bottom: 8px;
        }
        .field-input {
            width: 100%; padding: 12px 15px;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            color: var(--dark-900);
            font-family: var(--font-body); font-size: .95rem; font-weight: 400;
            transition: all 0.25s; outline: none;
        }
        .field-input:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.1);
        }
        .field-input::placeholder { color: var(--dark-500); }

        /* ── Buttons ───────────────────────────────────────────────── */
        .btn-gold {
            display: inline-flex; align-items: center; justify-content: center; gap: 9px;
            padding: 12px 26px; border-radius: var(--r-lg); border: none; cursor: pointer;
            background: var(--gold-gradient);
            color: #080808; font-family: var(--font-body);
            font-size: 0.82rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; transition: all 0.3s;
            position: relative; overflow: hidden;
        }
        .btn-gold::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent 50%, rgba(255,255,255,.15) 100%);
            opacity: 0; transition: opacity 0.3s;
        }
        .btn-gold:hover { transform: translateY(-2px); box-shadow: var(--glow-gold-strong); }
        .btn-gold:hover::after { opacity: 1; }
        .btn-gold:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }

        .btn-ghost-gold {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 15px; border-radius: var(--r-md); cursor: pointer;
            background: transparent;
            border: 1px solid rgba(201,168,76,.3);
            color: var(--gold-primary); font-size: 0.85rem; font-weight: 600;
            transition: all 0.22s; text-decoration: none; white-space: nowrap;
        }
        .btn-ghost-gold:hover { background: rgba(201,168,76,.09); border-color: rgba(201,168,76,.55); }

        .btn-ghost-red {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 15px; border-radius: var(--r-md); cursor: pointer;
            background: transparent;
            border: 1px solid rgba(231,76,60,.22);
            color: var(--color-danger); font-size: 0.85rem; font-weight: 600;
            transition: all 0.22s; white-space: nowrap;
        }
        .btn-ghost-red:hover { background: rgba(231,76,60,.07); border-color: rgba(231,76,60,.45); }

        .btn-upload-label {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 16px; border-radius: var(--r-md); cursor: pointer;
            background: rgba(201,168,76,.08);
            border: 1px solid rgba(201,168,76,.28);
            color: var(--gold-primary); font-size: 0.85rem; font-weight: 600;
            transition: all 0.25s; white-space: nowrap;
        }
        .btn-upload-label:hover {
            background: rgba(201,168,76,.16); border-color: rgba(201,168,76,.6);
            transform: translateY(-1px);
            box-shadow: var(--glow-gold);
        }

        /* ── Document rows ─────────────────────────────────────────── */
        .doc-row {
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.1);
            border-left: 3px solid transparent;
            border-radius: var(--r-lg);
            padding: 1.1rem 1.2rem;
            transition: all 0.3s;
        }
        .doc-row + .doc-row { margin-top: 0.75rem; }
        .doc-row:hover { border-color: rgba(201,168,76,.25); background: var(--dark-300); }
        .doc-row.state-pending  { border-left-color: rgba(201,168,76,.4);  background: linear-gradient(to right, rgba(201,168,76,.03), var(--dark-200)); }
        .doc-row.state-approved { border-left-color: rgba(46,202,187,.6);  background: linear-gradient(to right, rgba(46,202,187,.04), var(--dark-200)); }
        .doc-row.state-rejected { border-left-color: rgba(231,76,60,.6);   background: linear-gradient(to right, rgba(231,76,60,.04), var(--dark-200)); }

        .doc-row-inner {
            display: flex; flex-wrap: wrap; gap: 1rem;
            align-items: flex-start; justify-content: space-between;
        }
        .doc-info { flex: 1; min-width: 180px; }
        .doc-name { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 4px; }
        .doc-name-text { font-size: 0.95rem; font-weight: 600; color: var(--dark-900); }
        .doc-meta { display: flex; align-items: center; gap: 8px; margin-top: 6px; flex-wrap: wrap; }
        .doc-filename { font-size: 0.84rem; font-weight: 400; color: var(--dark-600); font-style: italic; }
        .doc-rejection {
            margin-top: 8px;
            font-size: 0.86rem; font-weight: 500; color: var(--color-danger);
            padding: 7px 12px;
            background: rgba(231,76,60,.06);
            border-left: 2px solid rgba(231,76,60,.35);
            border-radius: 0 var(--r-md) var(--r-md) 0;
        }
        .doc-actions { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; flex-shrink: 0; }

        /* ── Submit section ────────────────────────────────────────── */
        .submit-card {
            background: linear-gradient(160deg, var(--dark-100) 0%, var(--dark-200) 100%);
            border: 1px solid rgba(201,168,76,.28);
            border-radius: var(--r-xl);
            padding: 2.75rem 2rem;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .submit-card::before {
            content: '';
            position: absolute; top: 0; left: 12%; right: 12%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.5), transparent);
        }
        .submit-card::after {
            content: '';
            position: absolute; bottom: -100px; right: -100px;
            width: 250px; height: 250px;
            background: radial-gradient(circle, rgba(201,168,76,.05) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Toast ─────────────────────────────────────────────────── */
        .toast {
            position: fixed; top: 1.5rem; right: 1.5rem; z-index: 200;
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.28);
            border-radius: var(--r-xl);
            padding: 1rem 1.25rem;
            max-width: 340px; min-width: 260px;
            transform: translateX(140%);
            transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 12px 40px rgba(0,0,0,.7), 0 0 0 1px rgba(201,168,76,.06);
        }
        .toast::before {
            content: '';
            position: absolute; top: 0; left: 20%; right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.4), transparent);
        }
        .toast.show { transform: translateX(0); }

        /* ── Pulse animation ───────────────────────────────────────── */
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 8px 28px rgba(201,168,76,.28); }
            50%       { box-shadow: 0 8px 40px rgba(201,168,76,.5), 0 0 0 6px rgba(201,168,76,.07); }
        }
        .btn-pulse { animation: glow-pulse 2.5s ease-in-out infinite; }

        @keyframes rise {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .rise { animation: rise 0.5s ease both; }

        /* ── Scrollbar ─────────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-0); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,.25); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,.5); }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 540px) {
            .grid-2 { grid-template-columns: 1fr; }
            .card-body { padding: 1.5rem; }
            .doc-actions { width: 100%; }
            .submit-card { padding: 2rem 1.25rem; }
        }
        .hidden { display: none !important; }

        .mb-6 { margin-bottom: 1.25rem; }
    </style>
</head>
<body x-data="visaForm()">

<div class="page-wrap">

    {{-- ═══════════════════ BRAND HEADER ═══════════════════════════════ --}}
    <header class="rise" style="text-align:center; margin-bottom:3rem;">
        <div class="ornament" style="margin-bottom:1.5rem; justify-content:center; max-width:320px; margin-left:auto; margin-right:auto;">
            <span>✦</span> Travel Express <span>✦</span>
        </div>

        <h1 class="display-heading" style="font-size:clamp(2.2rem,5vw,3.2rem); font-weight:400; line-height:1.1; color:var(--dark-900);">
            Dossier <span class="text-gold">Visa</span>
        </h1>
        <p class="muted" style="margin-top:10px; font-size:0.95rem; letter-spacing:0.04em;">
            Complétez votre dossier pour initier votre demande de visa
        </p>
    </header>

    {{-- ═══════════════════ IDENTITY + PROGRESS CARD ════════════════════ --}}
    <div class="card mb-6 rise" style="animation-delay:0.06s;">
        <div class="card-body">
            {{-- Identity row --}}
            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:1rem; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div class="avatar">
                        @if($visa->student_name)
                            {{ strtoupper(substr($visa->student_name, 0, 1)) }}
                        @else
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="section-label" style="margin-bottom:5px;">Titulaire du dossier</p>
                        <p class="display-heading" style="font-size:1.3rem; font-weight:400; color:var(--dark-900);">
                            {{ $visa->student_name ?? 'Non renseigné' }}
                        </p>
                    </div>
                </div>

                {{-- Status badge --}}
                @php $si = $visa->status_info; @endphp
                <span class="badge {{ $si['color']==='green' ? 'badge-green' : ($si['color']==='red' ? 'badge-red' : 'badge-gold') }}">
                    <span style="width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0;"></span>
                    {{ $si['label'] }}
                </span>
            </div>

            <hr class="divider">

            {{-- Progress --}}
            @php
                $reqCount      = count(array_diff(array_keys(\App\Models\VisaApplication::DOCUMENTS), \App\Models\VisaApplication::OPTIONAL_DOCUMENTS));
                $uploadedCount = $uploadedDocuments->count();
            @endphp
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                <p class="section-label">Progression du dossier</p>
                <p id="visa-percentage" class="text-gold display-heading" style="font-size:1.15rem; font-weight:400;">
                    {{ $visa->completion_percentage }}%
                </p>
            </div>
            <div class="progress-track">
                <div class="progress-fill" id="visa-progress" style="width:{{ $visa->completion_percentage }}%"></div>
            </div>
            <p class="muted" style="font-size:0.86rem; font-weight:400; margin-top:7px; text-align:right;">
                {{ $uploadedCount }} / {{ count($documents) }} documents soumis
            </p>
        </div>
    </div>

    {{-- ═══════════════════ PERSONAL INFO FORM ════════════════════════ --}}
    <div class="card rise" style="animation-delay:0.12s; margin-bottom:1.25rem;">
        <div class="card-body">
            <p class="section-label" style="margin-bottom:1.5rem;">Informations personnelles</p>

            <form @submit.prevent="saveInfo">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Nom complet *</label>
                        <input type="text" x-model="info.student_name" required
                               class="field-input" placeholder="Votre nom complet">
                    </div>
                    <div>
                        <label class="field-label">Adresse e-mail *</label>
                        <input type="email" x-model="info.student_email" required
                               class="field-input" placeholder="votre@email.com">
                    </div>
                    <div>
                        <label class="field-label">Téléphone</label>
                        <input type="tel" x-model="info.student_phone"
                               class="field-input" placeholder="+226 XX XX XX XX">
                    </div>
                    <div>
                        <label class="field-label">N° Passeport</label>
                        <input type="text" x-model="info.passport_number"
                               class="field-input" placeholder="Numéro de passeport">
                    </div>
                </div>

                <div style="margin-top:1.5rem;">
                    <button type="submit" class="btn-gold" :disabled="saving">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-show="!saving">Enregistrer les informations</span>
                        <span x-show="saving">Enregistrement…</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══════════════════ DOCUMENTS SECTION ═════════════════════════ --}}
    <div class="card rise" style="animation-delay:0.18s; margin-bottom:1.25rem;">
        <div class="card-body">
            <p class="section-label" style="margin-bottom:4px;">Documents à fournir</p>
            <p class="muted" style="font-size:0.9rem; font-weight:400; margin-bottom:1.5rem;">
                PDF, JPG, PNG, DOC acceptés · 10 Mo maximum par fichier
            </p>

            <hr class="divider" style="margin-top:0;">

            @foreach($documents as $docType => $docLabel)
                @php
                    $uploaded   = $uploadedDocuments->get($docType);
                    $isOptional = in_array($docType, \App\Models\VisaApplication::OPTIONAL_DOCUMENTS);
                    $cleanLabel = str_replace(' (optionnel)', '', $docLabel);

                    $stateClass = '';
                    if ($uploaded) {
                        $stateClass = match($uploaded->status) {
                            'approved' => 'state-approved',
                            'rejected' => 'state-rejected',
                            default    => 'state-pending',
                        };
                    }
                @endphp

                <div class="doc-row {{ $stateClass }}" data-doc-type="{{ $docType }}">
                    <div class="doc-row-inner">
                        {{-- Left: document info --}}
                        <div class="doc-info">
                            <div class="doc-name">
                                {{-- State icon --}}
                                @if($uploaded)
                                    @if($uploaded->status === 'approved')
                                        <svg width="15" height="15" viewBox="0 0 20 20" fill="var(--color-success)"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    @elseif($uploaded->status === 'rejected')
                                        <svg width="15" height="15" viewBox="0 0 20 20" fill="var(--color-danger)"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                    @else
                                        <svg width="15" height="15" fill="none" stroke="var(--gold-primary)" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                @else
                                    <svg width="15" height="15" fill="none" stroke="rgba(201,168,76,.35)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                @endif

                                <span class="doc-name-text">{{ $cleanLabel }}</span>

                                @if($isOptional)
                                    <span class="badge badge-gray" style="font-size:0.7rem; padding:3px 10px;">Optionnel</span>
                                @else
                                    <span class="badge badge-gold" style="font-size:0.7rem; padding:3px 10px;">Requis</span>
                                @endif
                            </div>

                            @if($uploaded)
                                <div class="doc-meta">
                                    <span class="doc-filename">{{ $uploaded->original_filename }}</span>
                                    @if($uploaded->status === 'approved')
                                        <span class="badge badge-green" style="font-size:0.7rem; padding:3px 10px;">Approuvé</span>
                                    @elseif($uploaded->status === 'rejected')
                                        <span class="badge badge-red" style="font-size:0.7rem; padding:3px 10px;">Rejeté</span>
                                    @else
                                        <span class="badge badge-gold" style="font-size:0.7rem; padding:3px 10px;">En révision</span>
                                    @endif
                                </div>

                                @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                    <p class="doc-rejection">{{ $uploaded->rejection_reason }}</p>
                                @endif
                            @endif
                        </div>

                        {{-- Right: action buttons --}}
                        <div class="doc-actions">
                            @if($uploaded)
                                <a href="{{ route('visa.document.download', $uploaded->id) }}" class="btn-ghost-gold">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Télécharger
                                </a>
                                @if($uploaded->status !== 'approved')
                                    <button @click="deleteDocument('{{ $docType }}', {{ $uploaded->id }})" class="btn-ghost-red">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                @endif
                            @endif

                            @if(!$uploaded || $uploaded->status === 'rejected')
                                <label class="btn-upload-label">
                                    <input type="file" class="hidden"
                                           @change="uploadFile('{{ $docType }}', $event.target.files[0])"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.webp">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    {{ $uploaded ? 'Remplacer' : 'Uploader' }}
                                </label>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ═══════════════════ SUBMIT / CONFIRMATION ═══════════════════════ --}}
    @if(!$visa->student_submitted_at)
        <div class="submit-card rise" style="animation-delay:0.24s; margin-bottom:1.25rem;">
            <svg width="38" height="38" fill="none" stroke="var(--gold-primary)" viewBox="0 0 24 24"
                 style="margin:0 auto 1.25rem; display:block; opacity:0.85;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <p class="display-heading text-gold" style="font-size:1.1rem; font-weight:400; letter-spacing:0.1em; margin-bottom:8px;">
                Prêt à soumettre votre dossier ?
            </p>
            <p class="muted" style="font-size:0.95rem; max-width:380px; margin:0 auto 2rem; line-height:1.6;">
                Assurez-vous que tous les documents requis sont uploadés avant de soumettre. Notre équipe examinera votre dossier et vous contactera.
            </p>
            <button @click="submitDossier" class="btn-gold btn-pulse"
                    style="min-width:240px; padding:14px 32px;"
                    :disabled="submitting">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                <span x-show="!submitting">Soumettre mon dossier</span>
                <span x-show="submitting">Soumission en cours…</span>
            </button>
        </div>
    @else
        <div class="card rise" style="animation-delay:0.24s; margin-bottom:1.25rem; border-color:rgba(46,202,187,.28); padding:2.5rem; text-align:center;">
            <svg width="46" height="46" fill="none" stroke="var(--color-success)" viewBox="0 0 24 24"
                 style="margin:0 auto 1rem; display:block; opacity:0.9;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="display-heading" style="font-size:1.1rem; font-weight:400; color:var(--color-success); letter-spacing:0.08em; margin-bottom:6px;">
                Dossier soumis avec succès
            </p>
            <p class="muted" style="font-size:0.9rem;">
                Soumis le {{ $visa->student_submitted_at->format('d/m/Y à H:i') }}
                · Notre équipe vous contactera prochainement.
            </p>
        </div>
    @endif

    {{-- Footer ornament --}}
    <div class="ornament rise" style="animation-delay:0.3s; opacity:0.5;">
        Travel Express &copy; {{ date('Y') }}
    </div>

</div>

{{-- ═══════════════════ TOAST ════════════════════════════════════════ --}}
<div class="toast" :class="{ show: toast.show }">
    <div style="display:flex; align-items:flex-start; gap:12px;">
        <div style="flex-shrink:0; margin-top:1px;">
            <svg x-show="toast.type === 'success'" width="18" height="18" viewBox="0 0 20 20" fill="var(--color-success)">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <svg x-show="toast.type === 'error'" width="18" height="18" viewBox="0 0 20 20" fill="var(--color-danger)">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <p class="display-heading text-gold" style="font-size:0.88rem; font-weight:400; margin-bottom:3px;" x-text="toast.title"></p>
            <p class="muted" style="font-size:0.84rem; line-height:1.4;" x-text="toast.message"></p>
        </div>
    </div>
</div>

{{-- ═══════════════════ ALPINE.JS ════════════════════════════════════ --}}
<script>
function visaForm() {
    return {
        token: '{{ $visa->access_token ?? $visa->unique_token }}',
        saving: false,
        submitting: false,
        toast: { show: false, type: 'success', title: '', message: '' },
        info: {
            student_name:    '{{ addslashes($visa->student_name ?? '') }}',
            student_email:   '{{ addslashes($visa->student_email ?? '') }}',
            student_phone:   '{{ addslashes($visa->student_phone ?? '') }}',
            passport_number: '{{ addslashes($visa->passport_number ?? '') }}',
        },

        showToast(type, title, message) {
            this.toast = { show: true, type, title, message };
            setTimeout(() => this.toast.show = false, 5000);
        },

        async saveInfo() {
            this.saving = true;
            try {
                const res = await fetch(`/visa/${this.token}/info`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(this.info),
                });
                const data = await res.json();
                if (res.ok) this.showToast('success', 'Enregistré', data.message);
                else        this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
            } catch { this.showToast('error', 'Erreur', 'Impossible de sauvegarder'); }
            this.saving = false;
        },

        async uploadFile(docType, file) {
            if (!file) return;
            const formData = new FormData();
            formData.append('document_type', docType);
            formData.append('file', file);
            this.showToast('success', 'Upload en cours…', 'Veuillez patienter');
            try {
                const res = await fetch(`/visa/${this.token}/upload`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: formData,
                });
                const data = await res.json();
                if (res.ok) {
                    document.getElementById('visa-percentage').textContent = data.completion_percentage + '%';
                    document.getElementById('visa-progress').style.width = data.completion_percentage + '%';
                    this.showToast('success', 'Document uploadé', data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                }
            } catch { this.showToast('error', 'Erreur', "Impossible d'uploader le document"); }
        },

        async deleteDocument(docType, documentId) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) return;
            try {
                const res = await fetch(`/visa/${this.token}/document/${documentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });
                const data = await res.json();
                if (res.ok) {
                    document.getElementById('visa-percentage').textContent = data.completion_percentage + '%';
                    document.getElementById('visa-progress').style.width = data.completion_percentage + '%';
                    this.showToast('success', 'Supprimé', data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    this.showToast('error', 'Erreur', data.error || 'Impossible de supprimer');
                }
            } catch { this.showToast('error', 'Erreur', 'Une erreur est survenue'); }
        },

        async submitDossier() {
            if (!confirm('Confirmer la soumission de votre dossier visa ?')) return;
            this.submitting = true;
            try {
                const res = await fetch(`/visa/${this.token}/submit`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });
                const data = await res.json();
                if (res.ok) {
                    this.showToast('success', 'Dossier soumis !', data.message);
                    setTimeout(() => location.reload(), 2000);
                } else {
                    this.showToast('error', 'Erreur', data.error || 'Impossible de soumettre');
                }
            } catch { this.showToast('error', 'Erreur', 'Une erreur est survenue'); }
            this.submitting = false;
        },
    };
}
</script>

</body>
</html>

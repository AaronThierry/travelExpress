<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dossier de candidature — Travel Express</title>
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
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--dark-800);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Ambient Background ────────────────────────────────────── */
        .bg-scene {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
        }
        .bg-scene::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% -10%, rgba(201,168,76,.07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 110%, rgba(201,168,76,.05) 0%, transparent 55%);
        }
        .bg-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(201,168,76,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .bg-grain {
            position: absolute; inset: 0; opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        }

        /* ── Layout ────────────────────────────────────────────────── */
        .page-wrap {
            position: relative; z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1.75rem 5rem;
        }

        /* ── Cards ─────────────────────────────────────────────────── */
        .lux-card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s;
        }
        .lux-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            opacity: 0.5;
        }
        .lux-card:hover { border-color: rgba(201,168,76,.35); }

        /* ── Typography ────────────────────────────────────────────── */
        .font-display { font-family: var(--font-display); }
        .gold-text { color: var(--gold-primary); }
        .label-text {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold-deep);
        }

        /* ── Gold ornament line ────────────────────────────────────── */
        .ornament {
            display: flex; align-items: center; gap: 0.75rem;
            color: rgba(201,168,76,.3);
        }
        .ornament::before, .ornament::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.25), transparent);
        }
        .ornament-sm {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .ornament-sm::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, rgba(201,168,76,.25), transparent);
        }

        /* ── Avatar ────────────────────────────────────────────────── */
        .avatar-ring {
            width: 68px; height: 68px;
            border-radius: 50%;
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-serif);
            font-size: 1.75rem; font-weight: 700;
            color: var(--dark-0);
            position: relative;
            flex-shrink: 0;
            box-shadow: 0 0 0 1px rgba(201,168,76,.2), 0 8px 32px rgba(201,168,76,.2);
        }
        .avatar-ring::after {
            content: '';
            position: absolute; inset: -4px;
            border-radius: 50%;
            border: 1px solid rgba(201,168,76,.25);
        }

        /* ── Step Indicator ────────────────────────────────────────── */
        .steps { display: flex; align-items: center; }
        .step-dot {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700;
            border: 1px solid rgba(201,168,76,.2);
            color: var(--dark-600);
            background: var(--dark-200);
            transition: all 0.3s;
            flex-shrink: 0;
        }
        .step-dot.active {
            background: var(--gold-gradient);
            color: var(--dark-0);
            border-color: transparent;
            box-shadow: 0 4px 16px rgba(201,168,76,.3);
        }
        .step-dot.done {
            background: rgba(46,202,187,.1);
            border-color: rgba(46,202,187,.4);
            color: var(--color-success);
        }
        .step-connector {
            width: 44px; height: 1px;
            background: rgba(201,168,76,.2);
        }
        .step-connector.done { background: var(--gold-primary); }

        /* ── Progress Bars ─────────────────────────────────────────── */
        .prog-track {
            height: 3px;
            background: rgba(201,168,76,.1);
            border-radius: var(--r-full);
            overflow: visible;
            position: relative;
        }
        .prog-fill {
            height: 100%;
            border-radius: var(--r-full);
            background: var(--gold-gradient);
            position: relative;
            transition: width 0.7s cubic-bezier(0.4,0,0.2,1);
        }
        .prog-fill::after {
            content: '';
            position: absolute; top: -2px; right: -1px;
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--gold-bright);
            box-shadow: 0 0 8px var(--gold-primary);
        }

        /* ── Status Pills ──────────────────────────────────────────── */
        .pill {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.3rem 0.85rem;
            border-radius: var(--r-full);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border: 1px solid;
        }
        .pill-green  { color:var(--color-success); border-color:rgba(46,202,187,.3); background:rgba(46,202,187,.07); }
        .pill-red    { color:var(--color-danger);  border-color:rgba(231,76,60,.3);  background:rgba(231,76,60,.07); }
        .pill-blue   { color:#60a5fa; border-color:rgba(96,165,250,.3); background:rgba(96,165,250,.07); }
        .pill-yellow { color:var(--color-warning); border-color:rgba(240,180,40,.3); background:rgba(240,180,40,.07); }
        .pill-gray   { color:var(--dark-600); border-color:rgba(176,176,176,.15); background:rgba(176,176,176,.04); }
        .pill-gold   { color:var(--gold-primary); border-color:rgba(201,168,76,.3); background:rgba(201,168,76,.08); }

        /* ── Form Inputs ───────────────────────────────────────────── */
        .lux-input {
            width: 100%;
            padding: 0.875rem 1.125rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            color: var(--dark-900);
            font-family: var(--font-body);
            font-size: 0.9rem;
            transition: border-color 0.25s, box-shadow 0.25s;
        }
        .lux-input:focus {
            outline: none;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(201,168,76,.1);
        }
        .lux-input::placeholder { color: var(--dark-500); }
        textarea.lux-input { resize: vertical; min-height: 90px; }

        .field-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--gold-deep);
            margin-bottom: 0.625rem;
        }

        /* ── Section Divider ───────────────────────────────────────── */
        .section-divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 2.25rem 0;
        }
        .section-divider::before, .section-divider::after {
            content: ''; flex: 1; height: 1px;
            background: rgba(201,168,76,.15);
        }

        /* ── Tabs ──────────────────────────────────────────────────── */
        .tab-bar {
            display: flex;
            gap: 0;
            border-bottom: 1px solid rgba(201,168,76,.15);
            margin-bottom: 2rem;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .tab-bar::-webkit-scrollbar { display: none; }
        .tab-btn {
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--dark-600);
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
            transition: color 0.25s, border-color 0.25s;
            background: none;
            border-top: none; border-left: none; border-right: none;
        }
        .tab-btn:hover { color: var(--gold-bright); }
        .tab-btn.active {
            color: var(--gold-primary);
            border-bottom-color: var(--gold-primary);
        }

        /* ── Document Items ────────────────────────────────────────── */
        .doc-row {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1.35rem 1.5rem;
            background: var(--dark-200);
            border: 1px solid rgba(201,168,76,.1);
            border-left: 3px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            transition: all 0.25s;
        }
        .doc-row:hover {
            background: var(--dark-300);
            border-left-color: var(--gold-primary);
            border-color: rgba(201,168,76,.3);
            box-shadow: var(--glow-gold);
        }
        .doc-row.doc-done {
            border-left-color: rgba(46,202,187,.5);
            border-color: rgba(46,202,187,.15);
        }
        @media (min-width: 640px) {
            .doc-row { flex-direction: row; align-items: center; }
        }

        /* ── Buttons ───────────────────────────────────────────────── */
        .btn-gold {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--gold-gradient);
            color: var(--dark-0);
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: none;
            border-radius: var(--r-md);
            cursor: pointer;
            transition: all 0.25s;
            white-space: nowrap;
        }
        .btn-gold:hover {
            transform: translateY(-1px);
            box-shadow: var(--glow-gold-strong);
        }
        .btn-gold:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1rem;
            border: 1px solid rgba(201,168,76,.25);
            color: var(--gold-primary);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            border-radius: var(--r-md);
            cursor: pointer;
            background: none;
            transition: all 0.2s;
            white-space: nowrap;
            text-decoration: none;
        }
        .btn-ghost:hover { background: rgba(201,168,76,.08); border-color: rgba(201,168,76,.45); }

        .btn-danger {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1rem;
            border: 1px solid rgba(231,76,60,.25);
            color: var(--color-danger);
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: var(--r-md);
            cursor: pointer;
            background: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-danger:hover { background: rgba(231,76,60,.08); border-color: rgba(231,76,60,.4); }

        /* ── Submit Button ─────────────────────────────────────────── */
        .btn-submit {
            width: 100%;
            padding: 1.1rem 2rem;
            background: var(--gold-gradient);
            color: var(--dark-0);
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: none;
            border-radius: var(--r-xl);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .btn-submit::before {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent);
            transition: left 0.5s;
        }
        .btn-submit:hover::before { left: 100%; }
        .btn-submit:hover {
            box-shadow: var(--glow-gold-strong);
            transform: translateY(-2px);
        }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        /* ── Toast ─────────────────────────────────────────────────── */
        .toast-wrap {
            position: fixed;
            bottom: 1.5rem; right: 1.5rem;
            z-index: 100;
            transform: translateY(120%);
            transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
            max-width: 340px;
        }
        .toast-wrap.show { transform: translateY(0); }
        .toast-inner {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.25);
            border-radius: var(--r-xl);
            padding: 1rem 1.25rem;
            display: flex; align-items: flex-start; gap: 0.875rem;
            box-shadow: 0 16px 48px rgba(0,0,0,.6), 0 0 0 1px rgba(201,168,76,.05);
        }
        .toast-inner::before {
            content: '';
            position: absolute; top: 0; left: 1.5rem; right: 1.5rem;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,.25), transparent);
        }

        /* ── Animations ────────────────────────────────────────────── */
        @keyframes fade-up {
            from { opacity:0; transform: translateY(16px); }
            to   { opacity:1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .animate-in {
            animation: fade-up 0.5s ease both;
        }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.19s; }

        .shimmer-text {
            background: var(--gold-gradient);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        /* ── Submitted Banner ──────────────────────────────────────── */
        .submitted-banner {
            padding: 2.5rem;
            border: 1px solid rgba(46,202,187,.25);
            border-radius: var(--r-xl);
            background: rgba(46,202,187,.04);
            text-align: center;
        }
        .submitted-icon {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: rgba(46,202,187,.1);
            border: 1px solid rgba(46,202,187,.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
        }

        /* ── Section header ────────────────────────────────────────── */
        .section-title {
            font-family: var(--font-serif);
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--dark-900);
            letter-spacing: 0.01em;
        }
        .section-icon {
            width: 36px; height: 36px;
            border-radius: var(--r-lg);
            background: rgba(201,168,76,.1);
            border: 1px solid rgba(201,168,76,.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ── Doc status badges ─────────────────────────────────────── */
        .doc-status {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: var(--r-full);
            font-size: 0.67rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .doc-status-approved { color:var(--color-success); background:rgba(46,202,187,.1);   border:1px solid rgba(46,202,187,.25); }
        .doc-status-rejected  { color:var(--color-danger);  background:rgba(231,76,60,.1);   border:1px solid rgba(231,76,60,.25); }
        .doc-status-pending   { color:var(--color-warning); background:rgba(240,180,40,.08); border:1px solid rgba(240,180,40,.2); }

        /* ── Footer ────────────────────────────────────────────────── */
        .page-footer {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(201,168,76,.1);
            text-align: center;
        }

        /* ── Scrollbar ─────────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-0); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,.25); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,.5); }
    </style>
</head>
<body x-data="studentForm()">

    <!-- Ambient background -->
    <div class="bg-scene">
        <div class="bg-grid"></div>
        <div class="bg-grain"></div>
    </div>

    <div class="page-wrap">

        <!-- ── HEADER CARD ─────────────────────────────────────────── -->
        <div class="lux-card animate-in" style="padding:2.25rem;margin-bottom:1.75rem;">

            <div class="flex flex-col sm:flex-row sm:items-center" style="gap:2rem;">

                <!-- Avatar + Identity -->
                <div class="flex items-center flex-1 min-w-0" style="gap:1.5rem;">
                    <div class="avatar-ring">
                        @if($application->student_name)
                            {{ strtoupper(substr($application->student_name, 0, 1)) }}
                        @else
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="label-text mb-1">Candidat</p>
                        <h1 class="font-display text-2xl md:text-3xl shimmer-text truncate" style="font-weight:400; letter-spacing:.05em;">
                            {{ $application->student_name ?? 'Nouveau Dossier' }}
                        </h1>
                        <p class="text-sm mt-0.5" style="color:var(--dark-600);">
                            Programme
                            <span style="color:var(--gold-primary)">{{ ucfirst($application->program_type) }}</span>
                            &mdash;
                            Dossier {{ $application->dossier_type === 'complementaire' ? 'Complémentaire' : 'Initial' }}
                        </p>
                    </div>
                </div>

                <!-- Steps -->
                <div class="steps flex-shrink-0">
                    <div class="step-dot {{ $application->current_step >= 1 ? ($application->current_step > 1 ? 'done' : 'active') : '' }}">
                        @if($application->current_step > 1)
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        @else 1 @endif
                    </div>
                    <div class="step-connector {{ $application->current_step > 1 ? 'done' : '' }}"></div>
                    <div class="step-dot {{ $application->current_step >= 2 ? ($application->current_step > 2 ? 'done' : 'active') : '' }}">
                        @if($application->current_step > 2)
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        @else 2 @endif
                    </div>
                    <div class="step-connector {{ $application->current_step > 2 ? 'done' : '' }}"></div>
                    <div class="step-dot {{ $application->current_step >= 3 ? 'active' : '' }}">3</div>
                </div>

            </div>

            <!-- Progress -->
            <div class="grid md:grid-cols-2" style="gap:2rem;margin-top:2rem;">
                @php
                    $statusInfo     = $application->status_info;
                    $compStatusInfo = $application->complementary_status_info;
                @endphp

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="label-text">Dossier Initial</span>
                        <span class="font-display text-base gold-text" style="font-weight:400;" id="initial-percentage">{{ $application->completion_percentage }}%</span>
                    </div>
                    <div class="prog-track">
                        <div class="prog-fill" id="initial-progress" style="width:{{ $application->completion_percentage }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="label-text">Dossier Complémentaire</span>
                        <span class="font-display text-base gold-text" style="font-weight:400;" id="comp-percentage">{{ $application->complementary_completion_percentage }}%</span>
                    </div>
                    <div class="prog-track">
                        <div class="prog-fill" id="comp-progress" style="width:{{ $application->complementary_completion_percentage }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Status pills -->
            <div class="flex flex-wrap" style="gap:0.75rem;margin-top:1.5rem;">
                <span class="pill
                    @if($statusInfo['color']==='green') pill-green
                    @elseif($statusInfo['color']==='red') pill-red
                    @elseif($statusInfo['color']==='blue') pill-blue
                    @elseif($statusInfo['color']==='yellow') pill-yellow
                    @else pill-gray @endif">
                    <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block;"></span>
                    Initial&nbsp;·&nbsp;{{ $statusInfo['label'] }}
                </span>
                <span class="pill
                    @if($compStatusInfo['color']==='green') pill-green
                    @elseif($compStatusInfo['color']==='red') pill-red
                    @elseif($compStatusInfo['color']==='blue') pill-blue
                    @elseif($compStatusInfo['color']==='yellow') pill-yellow
                    @else pill-gray @endif">
                    <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block;"></span>
                    Complémentaire&nbsp;·&nbsp;{{ $compStatusInfo['label'] }}
                </span>
            </div>
        </div>

        <!-- ── PERSONAL INFO CARD ──────────────────────────────────── -->
        <div class="lux-card animate-in delay-1" style="padding:2.25rem;margin-bottom:1.75rem;">

            <div class="flex items-center" style="gap:1rem;margin-bottom:1.75rem;">
                <div class="section-icon">
                    <svg class="w-4 h-4" fill="none" stroke="var(--gold-primary)" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="section-title">Informations personnelles</h2>
            </div>

            <form @submit.prevent="saveInfo">
                <div class="grid md:grid-cols-2" style="gap:1.5rem;">
                    <div>
                        <label class="field-label">Nom complet <span style="color:var(--gold-primary)">*</span></label>
                        <input type="text" x-model="info.student_name" required class="lux-input" placeholder="Votre nom complet">
                    </div>
                    <div>
                        <label class="field-label">Adresse email <span style="color:var(--gold-primary)">*</span></label>
                        <input type="email" x-model="info.student_email" required class="lux-input" placeholder="votre@email.com">
                    </div>
                    <div>
                        <label class="field-label">Téléphone</label>
                        <input type="tel" x-model="info.student_phone" class="lux-input" placeholder="+226 XX XX XX XX">
                    </div>
                    <div>
                        <label class="field-label">Numéro de passeport</label>
                        <input type="text" x-model="info.passport_number" class="lux-input" placeholder="Numéro de passeport">
                    </div>

                    @if($application->dossier_type === 'complementaire' || $application->current_step >= 2)
                    <div class="md:col-span-2">
                        <div class="section-divider">
                            <span class="label-text" style="white-space:nowrap">Informations complémentaires</span>
                        </div>
                    </div>
                    <div>
                        <label class="field-label">Visa actuel</label>
                        <input type="text" x-model="info.visa_current" class="lux-input" placeholder="Type et numéro de visa">
                    </div>
                    <div>
                        <label class="field-label">Numéro chinois</label>
                        <input type="text" x-model="info.numero_chinois" class="lux-input" placeholder="Numéro d'étudiant chinois">
                    </div>
                    <div class="md:col-span-2">
                        <label class="field-label">Notes complémentaires</label>
                        <textarea x-model="info.complement_application" class="lux-input" placeholder="Toute information pertinente…"></textarea>
                    </div>
                    @endif
                </div>

                <div style="margin-top:1.75rem;">
                    <button type="submit" class="btn-gold" :disabled="saving">
                        <span x-show="!saving" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            Enregistrer les informations
                        </span>
                        <span x-show="saving">Enregistrement…</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- ── DOCUMENTS CARD ──────────────────────────────────────── -->
        <div class="lux-card animate-in delay-2" style="padding:2.25rem;">

            <div class="flex items-center" style="gap:1rem;margin-bottom:1.75rem;">
                <div class="section-icon">
                    <svg class="w-4 h-4" fill="none" stroke="var(--gold-primary)" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="section-title">Documents requis</h2>
            </div>

            <!-- Tab bar -->
            <div class="tab-bar">
                <button class="tab-btn" :class="{ active: activeTab === 'initial' }" @click="activeTab = 'initial'">
                    Dossier Initial <span style="opacity:0.5">({{ count($requiredDocuments) }})</span>
                </button>
                <button class="tab-btn" :class="{ active: activeTab === 'complementary' }" @click="activeTab = 'complementary'">
                    Complémentaire <span style="opacity:0.5">({{ count($complementaryDocuments) }})</span>
                </button>
            </div>

            <!-- Initial Documents -->
            <div x-show="activeTab === 'initial'" class="space-y-4">
                @foreach($requiredDocuments as $docType => $docLabel)
                    @php
                        $uploaded   = $uploadedDocuments->get($docType);
                        $isOptional = in_array($docType, ['certificat_anglais','test_csca','plan_etude','lettre_motivation','capacite_financiere']);
                    @endphp
                    <div class="doc-row {{ $uploaded ? 'doc-done' : '' }}" data-doc-type="{{ $docType }}">
                        <!-- Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                @if($uploaded)
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--color-success)" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @else
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--dark-500)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @endif
                                <span class="font-medium text-sm" style="color:var(--dark-900);font-family:var(--font-body);">{{ $docLabel }}</span>
                                @if($isOptional)
                                    <span class="pill pill-gray" style="font-size:0.62rem;padding:0.15rem 0.5rem;">Optionnel</span>
                                @endif
                            </div>
                            @if($uploaded)
                                <div class="flex flex-wrap items-center gap-2 mt-1.5 ml-6">
                                    <span class="text-xs" style="color:var(--dark-600);font-style:italic;">{{ $uploaded->original_filename }}</span>
                                    @if($uploaded->status === 'approved')
                                        <span class="doc-status doc-status-approved">Approuvé</span>
                                    @elseif($uploaded->status === 'rejected')
                                        <span class="doc-status doc-status-rejected">Rejeté</span>
                                    @else
                                        <span class="doc-status doc-status-pending">En révision</span>
                                    @endif
                                </div>
                                @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                    <p class="text-xs mt-1.5 ml-6 px-3 py-2 rounded-lg" style="color:var(--color-danger);background:rgba(231,76,60,.08);border:1px solid rgba(231,76,60,.2)">
                                        {{ $uploaded->rejection_reason }}
                                    </p>
                                @endif
                            @endif
                        </div>
                        <!-- Actions -->
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($uploaded)
                                <a href="{{ route('document.download', $uploaded->id) }}" class="btn-ghost">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Télécharger
                                </a>
                                @if($uploaded->status !== 'approved')
                                    <button @click="deleteDocument('{{ $docType }}', {{ $uploaded->id }})" class="btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Supprimer
                                    </button>
                                @endif
                            @endif
                            @if(!$uploaded || $uploaded->status === 'rejected')
                                <label class="btn-gold cursor-pointer">
                                    <input type="file" class="hidden" @change="uploadFile('{{ $docType }}', $event.target.files[0])" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    {{ $uploaded ? 'Remplacer' : 'Uploader' }}
                                </label>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Complementary Documents -->
            <div x-show="activeTab === 'complementary'" class="space-y-4">
                @foreach($complementaryDocuments as $docType => $docLabel)
                    @php $uploaded = $uploadedDocuments->get($docType); @endphp
                    <div class="doc-row {{ $uploaded ? 'doc-done' : '' }}" data-doc-type="{{ $docType }}">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                @if($uploaded)
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--color-success)" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @else
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--dark-500)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @endif
                                <span class="font-medium text-sm" style="color:var(--dark-900);font-family:var(--font-body);">{{ $docLabel }}</span>
                            </div>
                            @if($uploaded)
                                <div class="flex flex-wrap items-center gap-2 mt-1.5 ml-6">
                                    <span class="text-xs" style="color:var(--dark-600);font-style:italic;">{{ $uploaded->original_filename }}</span>
                                    @if($uploaded->status === 'approved')
                                        <span class="doc-status doc-status-approved">Approuvé</span>
                                    @elseif($uploaded->status === 'rejected')
                                        <span class="doc-status doc-status-rejected">Rejeté</span>
                                    @else
                                        <span class="doc-status doc-status-pending">En révision</span>
                                    @endif
                                </div>
                                @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                    <p class="text-xs mt-1.5 ml-6 px-3 py-2 rounded-lg" style="color:var(--color-danger);background:rgba(231,76,60,.08);border:1px solid rgba(231,76,60,.2)">
                                        {{ $uploaded->rejection_reason }}
                                    </p>
                                @endif
                            @endif
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($uploaded)
                                <a href="{{ route('document.download', $uploaded->id) }}" class="btn-ghost">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Télécharger
                                </a>
                                @if($uploaded->status !== 'approved')
                                    <button @click="deleteDocument('{{ $docType }}', {{ $uploaded->id }})" class="btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Supprimer
                                    </button>
                                @endif
                            @endif
                            @if(!$uploaded || $uploaded->status === 'rejected')
                                <label class="btn-gold cursor-pointer">
                                    <input type="file" class="hidden" @change="uploadFile('{{ $docType }}', $event.target.files[0])" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    {{ $uploaded ? 'Remplacer' : 'Uploader' }}
                                </label>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- ── SUBMIT BUTTON ────────────────────────────────────────── -->
        <div class="mt-6 animate-in delay-3">
            @if(!$application->student_submitted_at)
                <button @click="submitApplication" class="btn-submit" :disabled="submitting">
                    <span x-show="!submitting" class="flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Soumettre mon dossier
                    </span>
                    <span x-show="submitting">Soumission en cours…</span>
                </button>
            @else
                <div class="submitted-banner">
                    <div class="submitted-icon">
                        <svg class="w-8 h-8" style="color:var(--color-success)" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="font-display text-xl" style="font-weight:400;color:var(--color-success);letter-spacing:.06em;">Dossier soumis</h3>
                    <p class="text-sm mt-1" style="color:rgba(46,202,187,.7)">
                        Le {{ $application->student_submitted_at->format('d/m/Y à H:i') }}
                    </p>
                    <p class="text-sm mt-3" style="color:var(--dark-600)">
                        Vous recevrez une notification par email dès que votre dossier sera examiné.
                    </p>
                </div>
            @endif
        </div>

        <!-- ── FOOTER ───────────────────────────────────────────────── -->
        <div class="page-footer">
            <p class="font-serif text-base italic" style="color:var(--dark-600)">
                Travel Express &mdash; <span style="color:var(--gold-primary)">Votre partenaire pour les études à l'étranger</span>
            </p>
        </div>

    </div>

    <!-- ── TOAST ──────────────────────────────────────────────────────── -->
    <div class="toast-wrap" :class="{ show: toast.show }">
        <div class="toast-inner" style="position:relative">
            <div :style="toast.type === 'success' ? 'color:var(--color-success)' : 'color:var(--color-danger)'">
                <svg x-show="toast.type === 'success'" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <svg x-show="toast.type === 'error'" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p class="font-medium text-sm" style="color:var(--gold-primary);font-family:var(--font-body);" x-text="toast.title"></p>
                <p class="text-sm mt-0.5" style="color:var(--dark-600)" x-text="toast.message"></p>
            </div>
        </div>
    </div>

    <script>
        function studentForm() {
            return {
                token: '{{ $application->access_token ?? $application->unique_token }}',
                activeTab: '{{ $application->dossier_type === "complementaire" ? "complementary" : "initial" }}',
                saving: false,
                submitting: false,
                toast: { show: false, type: 'success', title: '', message: '' },
                info: {
                    student_name:           '{{ addslashes($application->student_name ?? "") }}',
                    student_email:          '{{ addslashes($application->student_email ?? "") }}',
                    student_phone:          '{{ addslashes($application->student_phone ?? "") }}',
                    passport_number:        '{{ addslashes($application->passport_number ?? "") }}',
                    visa_current:           '{{ addslashes($application->visa_current ?? "") }}',
                    numero_chinois:         '{{ addslashes($application->numero_chinois ?? "") }}',
                    complement_application: '{{ addslashes($application->complement_application ?? "") }}'
                },
                requiredDocuments:     @json($requiredDocuments),
                complementaryDocuments:@json($complementaryDocuments),
                visaDocuments:         @json($visaDocuments),

                showToast(type, title, message) {
                    this.toast = { show: true, type, title, message };
                    setTimeout(() => this.toast.show = false, 5000);
                },

                async saveInfo() {
                    this.saving = true;
                    try {
                        const res  = await fetch(`/dossier/${this.token}/info`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.info)
                        });
                        const data = await res.json();
                        res.ok
                            ? this.showToast('success', 'Enregistré', data.message)
                            : this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                    } catch { this.showToast('error', 'Erreur', 'Impossible de sauvegarder'); }
                    this.saving = false;
                },

                async uploadFile(docType, file) {
                    if (!file) return;
                    const fd = new FormData();
                    fd.append('document_type', docType);
                    fd.append('file', file);
                    try {
                        const res  = await fetch(`/dossier/${this.token}/upload`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd
                        });
                        const data = await res.json();
                        if (res.ok) {
                            this.showToast('success', 'Document uploadé', data.message);
                            this.updateProgress(data.completion_percentage, data.complementary_completion_percentage);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Une erreur est survenue');
                        }
                    } catch { this.showToast('error', 'Erreur', "Impossible d'uploader le document"); }
                },

                async deleteDocument(docType, documentId) {
                    if (!confirm('Supprimer ce document ?')) return;
                    try {
                        const res  = await fetch(`/dossier/${this.token}/document/${documentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();
                        if (res.ok) {
                            this.showToast('success', 'Supprimé', data.message);
                            this.updateProgress(data.completion_percentage, data.complementary_completion_percentage);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible de supprimer');
                        }
                    } catch { this.showToast('error', 'Erreur', 'Une erreur est survenue'); }
                },

                async submitApplication() {
                    if (!confirm('Soumettre définitivement votre dossier ?')) return;
                    this.submitting = true;
                    try {
                        const res  = await fetch(`/dossier/${this.token}/submit`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();
                        if (res.ok) {
                            this.showToast('success', 'Soumis !', data.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible de soumettre');
                        }
                    } catch { this.showToast('error', 'Erreur', 'Une erreur est survenue'); }
                    this.submitting = false;
                },

                updateProgress(initial, complementary) {
                    document.getElementById('initial-percentage').textContent  = initial + '%';
                    document.getElementById('initial-progress').style.width    = initial + '%';
                    document.getElementById('comp-percentage').textContent     = complementary + '%';
                    document.getElementById('comp-progress').style.width       = complementary + '%';
                }
            };
        }
    </script>
</body>
</html>

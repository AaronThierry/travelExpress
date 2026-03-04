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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold:        #D4AF37;
            --gold-bright: #F0C85C;
            --gold-dark:   #9A7B1E;
            --gold-dim:    rgba(212,175,55,0.18);
            --gold-line:   rgba(212,175,55,0.25);
            --obsidian:    #080807;
            --card:        #0e0d0b;
            --card-hover:  #141209;
            --text:        #F2ECD8;
            --text-muted:  rgba(242,236,216,0.45);
            --text-faint:  rgba(242,236,216,0.22);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--obsidian);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Ambient Background ───────────────────────────────────── */
        .bg-scene {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
        }
        .bg-scene::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% -10%, rgba(212,175,55,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 110%, rgba(212,175,55,0.05) 0%, transparent 55%);
        }
        .bg-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(212,175,55,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212,175,55,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .bg-grain {
            position: absolute; inset: 0; opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        }

        /* ── Layout ───────────────────────────────────────────────── */
        .page-wrap {
            position: relative; z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1.75rem 5rem;
        }

        /* ── Cards ────────────────────────────────────────────────── */
        .lux-card {
            background: var(--card);
            border: 1px solid var(--gold-line);
            border-radius: 1.25rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s;
        }
        .lux-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: 0.5;
        }
        .lux-card:hover { border-color: rgba(212,175,55,0.4); }

        /* ── Typography ───────────────────────────────────────────── */
        .font-display { font-family: 'Cormorant Garamond', serif; }
        .gold-text { color: var(--gold); }
        .label-text {
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* ── Gold ornament line ───────────────────────────────────── */
        .ornament {
            display: flex; align-items: center; gap: 0.75rem;
            color: var(--gold-dim);
        }
        .ornament::before, .ornament::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-line), transparent);
        }
        .ornament-sm {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .ornament-sm::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, var(--gold-line), transparent);
        }

        /* ── Avatar ───────────────────────────────────────────────── */
        .avatar-ring {
            width: 68px; height: 68px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem; font-weight: 700;
            color: var(--obsidian);
            position: relative;
            flex-shrink: 0;
            box-shadow: 0 0 0 1px var(--gold-dim), 0 8px 32px rgba(212,175,55,0.2);
        }
        .avatar-ring::after {
            content: '';
            position: absolute; inset: -4px;
            border-radius: 50%;
            border: 1px solid var(--gold-line);
        }

        /* ── Step Indicator ───────────────────────────────────────── */
        .steps { display: flex; align-items: center; }
        .step-dot {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 600;
            border: 1px solid var(--gold-line);
            color: var(--text-muted);
            background: var(--card);
            transition: all 0.3s;
            flex-shrink: 0;
        }
        .step-dot.active {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: var(--obsidian);
            border-color: transparent;
            box-shadow: 0 4px 16px rgba(212,175,55,0.3);
        }
        .step-dot.done {
            background: rgba(34,197,94,0.1);
            border-color: rgba(34,197,94,0.4);
            color: #4ade80;
        }
        .step-connector {
            width: 44px; height: 1px;
            background: var(--gold-line);
        }
        .step-connector.done { background: var(--gold); }

        /* ── Progress Bars ────────────────────────────────────────── */
        .prog-track {
            height: 3px;
            background: rgba(212,175,55,0.12);
            border-radius: 99px;
            overflow: visible;
            position: relative;
        }
        .prog-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--gold-dark) 0%, var(--gold) 50%, var(--gold-bright) 100%);
            position: relative;
            transition: width 0.7s cubic-bezier(0.4,0,0.2,1);
        }
        .prog-fill::after {
            content: '';
            position: absolute; top: -2px; right: -1px;
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--gold-bright);
            box-shadow: 0 0 8px var(--gold);
        }

        /* ── Status Pills ─────────────────────────────────────────── */
        .pill {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.3rem 0.85rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border: 1px solid;
        }
        .pill-green  { color:#4ade80; border-color:rgba(74,222,128,0.3); background:rgba(74,222,128,0.07); }
        .pill-red    { color:#f87171; border-color:rgba(248,113,113,0.3); background:rgba(248,113,113,0.07); }
        .pill-blue   { color:#60a5fa; border-color:rgba(96,165,250,0.3); background:rgba(96,165,250,0.07); }
        .pill-yellow { color:#fbbf24; border-color:rgba(251,191,36,0.3); background:rgba(251,191,36,0.07); }
        .pill-gray   { color:rgba(242,236,216,0.5); border-color:rgba(242,236,216,0.12); background:rgba(242,236,216,0.04); }
        .pill-gold   { color:var(--gold); border-color:var(--gold-line); background:var(--gold-dim); }

        /* ── Form Inputs ──────────────────────────────────────────── */
        .lux-input {
            width: 100%;
            padding: 0.875rem 1.125rem;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--gold-line);
            border-radius: 0.625rem;
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            transition: border-color 0.25s, box-shadow 0.25s;
        }
        .lux-input:focus {
            outline: none;
            border-color: rgba(212,175,55,0.5);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.08);
        }
        .lux-input::placeholder { color: var(--text-faint); }
        textarea.lux-input { resize: vertical; min-height: 90px; }

        .field-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.625rem;
        }

        /* ── Section Divider ──────────────────────────────────────── */
        .section-divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 2.25rem 0;
        }
        .section-divider::before, .section-divider::after {
            content: ''; flex: 1; height: 1px;
            background: var(--gold-line);
        }

        /* ── Tabs ─────────────────────────────────────────────────── */
        .tab-bar {
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--gold-line);
            margin-bottom: 2rem;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .tab-bar::-webkit-scrollbar { display: none; }

        .tab-btn {
            padding: 1rem 1.5rem;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
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
            color: var(--gold);
            border-bottom-color: var(--gold);
        }

        /* ── Document Items ───────────────────────────────────────── */
        .doc-row {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1.35rem 1.5rem;
            background: rgba(255,255,255,0.015);
            border: 1px solid rgba(212,175,55,0.1);
            border-left: 3px solid rgba(212,175,55,0.15);
            border-radius: 0.75rem;
            transition: all 0.25s;
        }
        .doc-row:hover {
            background: rgba(212,175,55,0.04);
            border-left-color: var(--gold);
            border-color: rgba(212,175,55,0.25);
        }
        .doc-row.doc-done {
            border-left-color: rgba(74,222,128,0.5);
            border-color: rgba(74,222,128,0.15);
        }
        @media (min-width: 640px) {
            .doc-row { flex-direction: row; align-items: center; }
        }

        /* ── Buttons ──────────────────────────────────────────────── */
        .btn-gold {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 100%);
            color: var(--obsidian);
            font-family: 'Outfit', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.25s;
            white-space: nowrap;
        }
        .btn-gold:hover {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-bright) 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(212,175,55,0.28);
        }
        .btn-gold:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1rem;
            border: 1px solid var(--gold-line);
            color: var(--gold);
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            border-radius: 0.5rem;
            cursor: pointer;
            background: none;
            transition: all 0.2s;
            white-space: nowrap;
            text-decoration: none;
        }
        .btn-ghost:hover { background: var(--gold-dim); border-color: rgba(212,175,55,0.45); }

        .btn-danger {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1rem;
            border: 1px solid rgba(239,68,68,0.25);
            color: rgba(252,165,165,0.8);
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: 0.5rem;
            cursor: pointer;
            background: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-danger:hover { background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.4); }

        /* ── Submit Button ────────────────────────────────────────── */
        .btn-submit {
            width: 100%;
            padding: 1.1rem 2rem;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 50%, var(--gold-bright) 100%);
            color: var(--obsidian);
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border: none;
            border-radius: 0.875rem;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .btn-submit::before {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .btn-submit:hover::before { left: 100%; }
        .btn-submit:hover {
            box-shadow: 0 8px 40px rgba(212,175,55,0.35);
            transform: translateY(-2px);
        }
        .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        /* ── Toast ────────────────────────────────────────────────── */
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
            background: var(--card);
            border: 1px solid var(--gold-line);
            border-radius: 0.875rem;
            padding: 1rem 1.25rem;
            display: flex; align-items: flex-start; gap: 0.875rem;
            box-shadow: 0 16px 48px rgba(0,0,0,0.6), 0 0 0 1px rgba(212,175,55,0.05);
        }
        .toast-inner::before {
            content: '';
            position: absolute; top: 0; left: 1.5rem; right: 1.5rem;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-line), transparent);
        }

        /* ── Animations ───────────────────────────────────────────── */
        @keyframes fade-up {
            from { opacity:0; transform: translateY(16px); }
            to   { opacity:1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:0.4} }

        .animate-in {
            animation: fade-up 0.5s ease both;
        }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.19s; }

        .shimmer-text {
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-bright), var(--gold-dark));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        /* ── Submitted Banner ─────────────────────────────────────── */
        .submitted-banner {
            padding: 2.5rem;
            border: 1px solid rgba(74,222,128,0.25);
            border-radius: 1.25rem;
            background: rgba(74,222,128,0.04);
            text-align: center;
        }
        .submitted-icon {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: rgba(74,222,128,0.1);
            border: 1px solid rgba(74,222,128,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
        }

        /* ── Section header ───────────────────────────────────────── */
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--text);
            letter-spacing: 0.01em;
        }
        .section-icon {
            width: 36px; height: 36px;
            border-radius: 0.625rem;
            background: var(--gold-dim);
            border: 1px solid var(--gold-line);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ── Doc status badges ────────────────────────────────────── */
        .doc-status {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
            font-size: 0.67rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .doc-status-approved { color:#4ade80; background:rgba(74,222,128,0.1); border:1px solid rgba(74,222,128,0.25); }
        .doc-status-rejected  { color:#f87171; background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.25); }
        .doc-status-pending   { color:#fbbf24; background:rgba(251,191,36,0.08); border:1px solid rgba(251,191,36,0.2); }

        /* ── Footer ───────────────────────────────────────────────── */
        .page-footer {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gold-line);
            text-align: center;
        }
    </style>
</head>
<body x-data="studentForm()">

    <!-- Ambient background -->
    <div class="bg-scene">
        <div class="bg-grid"></div>
        <div class="bg-grain"></div>
    </div>

    <div class="page-wrap">

        <!-- ── HEADER CARD ──────────────────────────────────────────── -->
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
                        <h1 class="font-display text-2xl md:text-3xl font-600 shimmer-text truncate">
                            {{ $application->student_name ?? 'Nouveau Dossier' }}
                        </h1>
                        <p class="text-sm mt-0.5" style="color:var(--text-muted)">
                            Programme
                            <span style="color:var(--gold)">{{ ucfirst($application->program_type) }}</span>
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
                        <span class="font-display text-base font-600" style="color:var(--gold)" id="initial-percentage">{{ $application->completion_percentage }}%</span>
                    </div>
                    <div class="prog-track">
                        <div class="prog-fill" id="initial-progress" style="width:{{ $application->completion_percentage }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="label-text">Dossier Complémentaire</span>
                        <span class="font-display text-base font-600" style="color:var(--gold)" id="comp-percentage">{{ $application->complementary_completion_percentage }}%</span>
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

        <!-- ── PERSONAL INFO CARD ────────────────────────────────────── -->
        <div class="lux-card animate-in delay-1" style="padding:2.25rem;margin-bottom:1.75rem;">

            <div class="flex items-center" style="gap:1rem;margin-bottom:1.75rem;">
                <div class="section-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" style="color:var(--gold)">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="section-title">Informations personnelles</h2>
            </div>

            <form @submit.prevent="saveInfo">
                <div class="grid md:grid-cols-2" style="gap:1.5rem;">
                    <div>
                        <label class="field-label">Nom complet <span style="color:var(--gold)">*</span></label>
                        <input type="text" x-model="info.student_name" required class="lux-input" placeholder="Votre nom complet">
                    </div>
                    <div>
                        <label class="field-label">Adresse email <span style="color:var(--gold)">*</span></label>
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

        <!-- ── DOCUMENTS CARD ────────────────────────────────────────── -->
        <div class="lux-card animate-in delay-2" style="padding:2.25rem;">

            <div class="flex items-center" style="gap:1rem;margin-bottom:1.75rem;">
                <div class="section-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" style="color:var(--gold)">
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
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:#4ade80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @else
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--text-faint)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @endif
                                <span class="font-medium text-sm" style="color:var(--text)">{{ $docLabel }}</span>
                                @if($isOptional)
                                    <span class="pill pill-gray" style="font-size:0.62rem;padding:0.15rem 0.5rem;">Optionnel</span>
                                @endif
                            </div>
                            @if($uploaded)
                                <div class="flex flex-wrap items-center gap-2 mt-1.5 ml-6">
                                    <span class="text-xs" style="color:var(--text-muted)">{{ $uploaded->original_filename }}</span>
                                    @if($uploaded->status === 'approved')
                                        <span class="doc-status doc-status-approved">Approuvé</span>
                                    @elseif($uploaded->status === 'rejected')
                                        <span class="doc-status doc-status-rejected">Rejeté</span>
                                    @else
                                        <span class="doc-status doc-status-pending">En révision</span>
                                    @endif
                                </div>
                                @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                    <p class="text-xs mt-1.5 ml-6 px-3 py-2 rounded-lg" style="color:#fca5a5;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2)">
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
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:#4ade80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @else
                                    <svg class="w-4 h-4 flex-shrink-0" style="color:var(--text-faint)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @endif
                                <span class="font-medium text-sm" style="color:var(--text)">{{ $docLabel }}</span>
                            </div>
                            @if($uploaded)
                                <div class="flex flex-wrap items-center gap-2 mt-1.5 ml-6">
                                    <span class="text-xs" style="color:var(--text-muted)">{{ $uploaded->original_filename }}</span>
                                    @if($uploaded->status === 'approved')
                                        <span class="doc-status doc-status-approved">Approuvé</span>
                                    @elseif($uploaded->status === 'rejected')
                                        <span class="doc-status doc-status-rejected">Rejeté</span>
                                    @else
                                        <span class="doc-status doc-status-pending">En révision</span>
                                    @endif
                                </div>
                                @if($uploaded->status === 'rejected' && $uploaded->rejection_reason)
                                    <p class="text-xs mt-1.5 ml-6 px-3 py-2 rounded-lg" style="color:#fca5a5;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2)">
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

        <!-- ── SUBMIT BUTTON ─────────────────────────────────────────── -->
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
                        <svg class="w-8 h-8" style="color:#4ade80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="font-display text-xl font-600" style="color:#4ade80">Dossier soumis</h3>
                    <p class="text-sm mt-1" style="color:rgba(74,222,128,0.7)">
                        Le {{ $application->student_submitted_at->format('d/m/Y à H:i') }}
                    </p>
                    <p class="text-sm mt-3" style="color:var(--text-muted)">
                        Vous recevrez une notification par email dès que votre dossier sera examiné.
                    </p>
                </div>
            @endif
        </div>

        <!-- ── FOOTER ───────────────────────────────────────────────── -->
        <div class="page-footer">
            <p class="font-display text-base italic" style="color:var(--text-muted)">
                Travel Express &mdash; <span style="color:var(--gold)">Votre partenaire pour les études à l'étranger</span>
            </p>
        </div>

    </div>

    <!-- ── TOAST ──────────────────────────────────────────────────────── -->
    <div class="toast-wrap" :class="{ show: toast.show }">
        <div class="toast-inner" style="position:relative">
            <div :style="toast.type === 'success' ? 'color:#4ade80' : 'color:#f87171'">
                <svg x-show="toast.type === 'success'" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <svg x-show="toast.type === 'error'" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p class="font-medium text-sm" style="color:var(--gold)" x-text="toast.title"></p>
                <p class="text-sm mt-0.5" style="color:var(--text-muted)" x-text="toast.message"></p>
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

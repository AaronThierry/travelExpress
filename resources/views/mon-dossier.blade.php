<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Dossier — Travel Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ── Royal Design System ────────────────────────────────── */
        :root {
            --gold-primary:  #C9A84C;
            --gold-bright:   #F0D07A;
            --gold-deep:     #8B6914;
            --gold-gradient: linear-gradient(135deg, #8B6914 0%, #C9A84C 30%, #F0D07A 50%, #C9A84C 70%, #8B6914 100%);
            --dark-0:   #080808;
            --dark-50:  #0D0D0D;
            --dark-100: #141414;
            --dark-200: #1C1C1C;
            --dark-300: #262626;
            --dark-400: #333333;
            --dark-500: #4A4A4A;
            --dark-600: #6B6B6B;
            --dark-700: #8A8A8A;
            --dark-800: #B0B0B0;
            --dark-900: #D4D4D4;
            --glow-gold:        0 0 20px rgba(201,168,76,.25), 0 0 60px rgba(201,168,76,.08);
            --glow-gold-strong: 0 0 30px rgba(201,168,76,.4),  0 0 80px rgba(201,168,76,.15);
            --r-sm:   3px;
            --r-md:   6px;
            --r-lg:   10px;
            --r-xl:   14px;
            --r-full: 9999px;
            --font-display: 'Bebas Neue', sans-serif;
            --font-serif:   'Cormorant Garamond', Georgia, serif;
            --font-body:    'Lato', sans-serif;
            --color-success: #2ECABB;
            --color-warning: #F0B428;
            --color-danger:  #E74C3C;
            /* Aliases used by existing classes */
            --gold:       #C9A84C;
            --gold-line:  rgba(201,168,76,.18);
            --gold-dim:   rgba(201,168,76,.08);
            --bg:         #080808;
            --bg-card:    #141414;
            --text:       #D4D4D4;
            --text-muted: #6B6B6B;
            /* Legacy aliases kept for inline styles referencing old vars */
            --gold-dark:  #8B6914;
            --obsidian:   #080808;
            --card:       #141414;
            --card-2:     #1C1C1C;
            --text-faint: rgba(212,212,212,.18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Scrollbar ──────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-100); }
        ::-webkit-scrollbar-thumb { background: var(--gold-deep); border-radius: var(--r-full); }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold-primary); }

        /* ── Background ───────────────────────────────────────── */
        .bg-scene { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
        .bg-scene::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 15% -5%,  rgba(201,168,76,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 85% 105%, rgba(201,168,76,0.05) 0%, transparent 55%);
        }
        .bg-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(201,168,76,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* ── Layout ───────────────────────────────────────────── */
        .page-wrap {
            position: relative; z-index: 1;
            max-width: 980px;
            margin: 0 auto;
            padding: 0 1.5rem 5rem;
        }

        /* ── Header ───────────────────────────────────────────── */
        .site-header {
            position: sticky; top: 0; z-index: 50;
            background: rgba(8,8,8,0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--gold-line);
        }
        .header-inner {
            max-width: 980px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .logo-mark {
            width: 36px; height: 36px;
            border-radius: var(--r-lg);
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-name { font-family: var(--font-serif); font-size: 1.2rem; font-weight: 600; color: var(--text); }
        .logo-sub  { font-size: 0.62rem; font-weight: 500; letter-spacing: 0.15em; text-transform: uppercase; color: var(--gold-primary); }
        .btn-back {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.45rem 1rem;
            border: 1px solid var(--gold-line);
            color: var(--text-muted);
            font-size: 0.78rem;
            border-radius: var(--r-md);
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { color: var(--gold-primary); border-color: rgba(201,168,76,.4); background: var(--gold-dim); }

        /* ── Page title ───────────────────────────────────────── */
        .page-title-block { padding: 2.5rem 0 2rem; }

        /* ── Cards ────────────────────────────────────────────── */
        .lux-card {
            background: var(--card);
            border: 1px solid var(--gold-line);
            border-radius: var(--r-xl);
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s;
        }
        .lux-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            opacity: 0.45;
        }
        .lux-card:hover { border-color: rgba(201,168,76,.38); }

        /* ── Label text ───────────────────────────────────────── */
        .label-text {
            font-size: 0.68rem; font-weight: 500;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--text-muted);
        }

        /* ── Avatar ───────────────────────────────────────────── */
        .avatar-ring {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: var(--gold-gradient);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-serif);
            font-size: 1.5rem; font-weight: 700;
            color: var(--dark-0);
            position: relative; flex-shrink: 0;
            box-shadow: 0 0 0 1px var(--gold-dim), 0 6px 24px rgba(201,168,76,.18);
        }
        .avatar-ring::after {
            content: '';
            position: absolute; inset: -4px;
            border-radius: 50%;
            border: 1px solid var(--gold-line);
        }

        /* ── Shimmer text ─────────────────────────────────────── */
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }
        .shimmer-text {
            background: linear-gradient(90deg, var(--gold-deep), var(--gold-bright), var(--gold-deep));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        /* ── Progress ─────────────────────────────────────────── */
        .prog-track {
            height: 4px;
            background: rgba(201,168,76,.1);
            border-radius: var(--r-full); overflow: hidden; position: relative;
        }
        .prog-fill {
            height: 100%; border-radius: var(--r-full);
            background: var(--gold-gradient);
            transition: width 0.9s cubic-bezier(0.4,0,0.2,1);
        }
        .prog-fill-blue {
            height: 100%; border-radius: var(--r-full);
            background: linear-gradient(90deg, #1d4ed8, #3b82f6, #60a5fa);
            transition: width 0.9s cubic-bezier(0.4,0,0.2,1);
        }

        /* ── Status Pills ─────────────────────────────────────── */
        .pill {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.25rem 0.75rem; border-radius: var(--r-full);
            font-size: 0.68rem; font-weight: 500;
            letter-spacing: 0.06em; text-transform: uppercase;
            border: 1px solid;
        }
        .pill-green  { color:#4ade80; border-color:rgba(74,222,128,0.3);  background:rgba(74,222,128,0.07); }
        .pill-red    { color:#f87171; border-color:rgba(248,113,113,0.3); background:rgba(248,113,113,0.07); }
        .pill-blue   { color:#60a5fa; border-color:rgba(96,165,250,0.3);  background:rgba(96,165,250,0.07); }
        .pill-yellow { color:#fbbf24; border-color:rgba(251,191,36,0.3);  background:rgba(251,191,36,0.07); }
        .pill-gray   { color:var(--dark-700); border-color:rgba(212,212,212,.12); background:rgba(212,212,212,.04); }
        .pill-gold   { color:var(--gold-primary); border-color:var(--gold-line); background:var(--gold-dim); }

        /* ── Tabs ─────────────────────────────────────────────── */
        .tab-bar {
            display: flex;
            border-bottom: 1px solid var(--gold-line);
            background: rgba(0,0,0,0.2);
            overflow-x: auto; scrollbar-width: none;
        }
        .tab-bar::-webkit-scrollbar { display: none; }
        .tab-btn {
            padding: 1rem 1.75rem;
            font-size: 0.75rem; font-weight: 500;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            cursor: pointer; white-space: nowrap; flex-shrink: 0;
            transition: color 0.2s, border-color 0.2s;
            background: none;
            border-top: none; border-left: none; border-right: none;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .tab-btn:hover { color: var(--gold-bright); }
        .tab-btn.active { color: var(--gold-primary); border-bottom-color: var(--gold-primary); }
        .tab-count {
            display: inline-flex; align-items: center; justify-content: center;
            width: 20px; height: 20px; border-radius: var(--r-full);
            font-size: 0.6rem; font-weight: 600;
            background: rgba(201,168,76,.15);
            border: 1px solid var(--gold-line);
            color: var(--gold-primary);
        }
        .tab-count.done { background: rgba(74,222,128,0.12); border-color: rgba(74,222,128,0.3); color: #4ade80; }

        /* ── Doc rows ─────────────────────────────────────────── */
        .doc-row {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 1.1rem 1.35rem;
            background: rgba(255,255,255,0.01);
            border: 1px solid rgba(201,168,76,.08);
            border-left: 3px solid rgba(201,168,76,.15);
            border-radius: var(--r-lg);
            transition: all 0.22s;
        }
        @media (min-width: 600px) {
            .doc-row { flex-direction: row; align-items: center; }
        }
        .doc-row:hover { background: rgba(201,168,76,.04); border-left-color: var(--gold-primary); border-color: rgba(201,168,76,.22); }
        .doc-row.doc-done { border-left-color: rgba(74,222,128,0.6); border-color: rgba(74,222,128,0.12); background: rgba(74,222,128,0.02); }
        .doc-row.doc-optional { border-left-color: rgba(201,168,76,.08); opacity: 0.75; }
        .doc-row.doc-optional:hover { opacity: 1; }

        /* ── Doc status ───────────────────────────────────────── */
        .doc-status {
            display: inline-flex; align-items: center; gap: 0.25rem;
            padding: 0.15rem 0.55rem;
            border-radius: var(--r-full);
            font-size: 0.62rem; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase;
        }
        .doc-status-approved { color:#4ade80; background:rgba(74,222,128,0.1);  border:1px solid rgba(74,222,128,0.25); }
        .doc-status-pending   { color:#fbbf24; background:rgba(251,191,36,0.08); border:1px solid rgba(251,191,36,0.2); }
        .doc-status-rejected  { color:#f87171; background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.25); }

        /* ── Buttons ──────────────────────────────────────────── */
        .btn-gold {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem;
            padding: 0.52rem 1.05rem;
            background: var(--gold-gradient);
            color: var(--dark-0);
            font-family: var(--font-body);
            font-size: 0.72rem; font-weight: 700;
            letter-spacing: 0.07em; text-transform: uppercase;
            border: none; border-radius: var(--r-md);
            cursor: pointer; transition: all 0.22s; white-space: nowrap;
        }
        .btn-gold:hover { opacity: 0.88; transform: translateY(-1px); box-shadow: 0 5px 20px rgba(201,168,76,.28); }
        .btn-gold:disabled { opacity: 0.45; cursor: not-allowed; transform: none; }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.48rem 0.85rem;
            border: 1px solid var(--gold-line);
            color: var(--gold-primary);
            font-size: 0.72rem; font-weight: 500; letter-spacing: 0.04em;
            border-radius: var(--r-md); cursor: pointer; background: none;
            transition: all 0.2s; white-space: nowrap; text-decoration: none;
        }
        .btn-ghost:hover { background: var(--gold-dim); border-color: rgba(201,168,76,.4); }

        /* ── Section title ────────────────────────────────────── */
        .section-title { font-family: var(--font-serif); font-size: 1.25rem; font-weight: 600; color: var(--text); letter-spacing: 0.01em; }
        .section-icon {
            width: 34px; height: 34px; border-radius: var(--r-md);
            background: var(--gold-dim); border: 1px solid var(--gold-line);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        /* ── Stats grid ───────────────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 0.75rem;
        }
        .stat-box {
            padding: 1rem;
            background: rgba(201,168,76,.05);
            border: 1px solid var(--gold-line);
            border-radius: var(--r-lg);
            text-align: center;
        }
        .stat-num {
            font-family: var(--font-serif);
            font-size: 1.8rem; font-weight: 700;
            color: var(--gold-primary); line-height: 1; display: block;
        }
        .stat-lbl {
            font-size: 0.65rem; font-weight: 500;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--text-muted); display: block; margin-top: 0.2rem;
        }

        /* ── Optional badge ───────────────────────────────────── */
        .opt-badge {
            font-size: 0.6rem; font-weight: 500; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 0.1rem 0.45rem;
            border-radius: var(--r-full); border: 1px solid rgba(201,168,76,.2);
            color: var(--text-muted); background: rgba(201,168,76,.05);
        }

        /* ── Auto-validation badge ────────────────────────────── */
        .auto-badge {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.6rem 1rem;
            background: rgba(74,222,128,0.05);
            border: 1px solid rgba(74,222,128,0.18);
            border-radius: var(--r-lg);
        }

        /* ── Spinner ──────────────────────────────────────────── */
        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner {
            width: 40px; height: 40px;
            border: 3px solid rgba(201,168,76,.12);
            border-top-color: var(--gold-primary);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        /* ── Animations ───────────────────────────────────────── */
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim   { animation: fade-up 0.45s ease both; }
        .anim-1 { animation-delay: 0.06s; }
        .anim-2 { animation-delay: 0.12s; }

        /* ── Toast ────────────────────────────────────────────── */
        .toast-wrap {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 200;
            transform: translateY(130%);
            transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
            max-width: 320px;
        }
        .toast-wrap.show { transform: translateY(0); }
        .toast-inner {
            background: var(--card);
            border: 1px solid var(--gold-line);
            border-radius: var(--r-xl);
            padding: 0.875rem 1.125rem;
            display: flex; align-items: flex-start; gap: 0.75rem;
            box-shadow: 0 12px 40px rgba(0,0,0,0.6);
        }

        .page-footer {
            margin-top: 3.5rem; padding-top: 1.5rem;
            border-top: 1px solid var(--gold-line);
            text-align: center;
        }
    </style>
</head>
<body x-data="dossierApp()" x-init="init()">

    <div class="bg-scene"><div class="bg-grid"></div></div>

    <!-- ── HEADER ────────────────────────────────────────────────── -->
    <header class="site-header">
        <div class="header-inner">
            <a href="/" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
                <div class="logo-mark">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;color:var(--dark-0)">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="logo-name">Travel Express</div>
                    <div class="logo-sub">Mon Dossier</div>
                </div>
            </a>
            <a href="/" class="btn-back">
                <svg style="width:13px;height:13px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Retour au site
            </a>
        </div>
    </header>

    <div class="page-wrap">

        <!-- Page title -->
        <div class="page-title-block anim">
            <p class="label-text" style="margin-bottom:0.5rem;">Espace candidat</p>
            <h1 style="font-family:var(--font-serif);font-size:2.25rem;font-weight:600;line-height:1.1;color:var(--text)">
                Mon <span class="shimmer-text">Dossier</span>
            </h1>
            <p style="margin-top:0.5rem;font-size:0.875rem;color:var(--text-muted)">
                Gérez l'intégralité de vos documents et suivez l'avancement de votre candidature.
            </p>
        </div>

        <!-- LOADING -->
        <div x-show="loading" class="anim" style="text-align:center;padding:5rem 0;">
            <div class="spinner" style="margin:0 auto 1.25rem;"></div>
            <p style="color:var(--text-muted);font-size:0.875rem;">Chargement de votre dossier…</p>
        </div>

        <!-- NOT LOGGED IN -->
        <div x-show="!loading && !isLoggedIn" class="lux-card anim" style="padding:3rem;text-align:center;">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--gold-dim);border:1px solid var(--gold-line);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                <svg style="width:28px;height:28px;color:var(--gold-primary)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h2 style="font-family:var(--font-serif);font-size:1.6rem;font-weight:600;margin-bottom:0.75rem;">Connexion requise</h2>
            <p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:1.75rem;">Connectez-vous pour accéder à votre dossier de candidature.</p>
            <a href="/login" class="btn-gold" style="padding:0.75rem 2rem;font-size:0.85rem;">Se connecter</a>
        </div>

        <!-- ERROR -->
        <div x-show="error && isLoggedIn" class="lux-card anim" style="padding:1.5rem;border-color:rgba(231,76,60,.25);margin-bottom:1rem;">
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <svg style="width:18px;height:18px;color:var(--color-danger);flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <p style="color:var(--color-danger);font-size:0.875rem;" x-text="error"></p>
            </div>
        </div>

        <!-- NO DOSSIER -->
        <div x-show="!loading && isLoggedIn && applications.length === 0 && !error" class="lux-card anim" style="padding:3rem;text-align:center;">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--gold-dim);border:1px solid var(--gold-line);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                <svg style="width:28px;height:28px;color:var(--gold-primary)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h2 style="font-family:var(--font-serif);font-size:1.6rem;font-weight:600;margin-bottom:0.75rem;">Aucun dossier trouvé</h2>
            <p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:0.5rem;">Aucun dossier n'est associé à votre adresse email.</p>
            <p class="label-text" x-text="userEmail" style="margin-top:0.25rem;"></p>
        </div>

        <!-- ── DOSSIERS ─────────────────────────────────────────── -->
        <template x-if="!loading && isLoggedIn && applications.length > 0">
            <div>
                <template x-for="(app, appIdx) in applications" :key="app.id">
                    <div style="margin-bottom:2rem;">

                        <!-- ── IDENTITY CARD ─────────────────────────── -->
                        <div class="lux-card anim" style="margin-bottom:1.25rem;overflow:hidden;">

                            <!-- Card Header — dark hero band -->
                            <div style="
                                position:relative;
                                padding:2rem 2rem 1.6rem;
                                background:linear-gradient(135deg,var(--dark-50) 0%,var(--dark-100) 60%,var(--dark-50) 100%);
                                overflow:hidden;
                            ">
                                <!-- Decorative corner glow -->
                                <div style="position:absolute;top:-40px;right:-40px;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,0.12) 0%,transparent 70%);pointer-events:none;"></div>
                                <div style="position:absolute;bottom:-60px;left:-20px;width:140px;height:140px;border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,0.06) 0%,transparent 70%);pointer-events:none;"></div>

                                <!-- Diagonal stripe texture -->
                                <div style="position:absolute;inset:0;background-image:repeating-linear-gradient(55deg,rgba(201,168,76,0.025) 0px,rgba(201,168,76,0.025) 1px,transparent 1px,transparent 28px);pointer-events:none;"></div>

                                <!-- Top row: logo mark + status pill -->
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;position:relative;">
                                    <div style="display:flex;align-items:center;gap:0.5rem;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:var(--gold-primary);box-shadow:0 0 8px var(--gold-primary);"></div>
                                        <span style="font-size:0.72rem;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold-primary);">Travel Express</span>
                                        <span style="color:var(--gold-line);font-size:0.8rem;margin:0 0.25rem;">·</span>
                                        <span style="font-size:0.7rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);">Carte Candidat</span>
                                    </div>
                                    <span class="pill"
                                        :class="{
                                            'pill-green':  app.status === 'approved',
                                            'pill-red':    app.status === 'rejected',
                                            'pill-blue':   app.status === 'complete',
                                            'pill-yellow': app.status === 'pending' || app.status === 'incomplete',
                                            'pill-gray':   !app.status
                                        }"
                                        x-text="app.status_info?.label || app.status || 'En attente'">
                                    </span>
                                </div>

                                <!-- Main identity row -->
                                <div style="display:flex;align-items:flex-end;gap:1.5rem;flex-wrap:wrap;position:relative;">

                                    <!-- Avatar -->
                                    <div style="position:relative;flex-shrink:0;">
                                        <div style="
                                            width:76px;height:76px;border-radius:18px;
                                            background:var(--gold-gradient);
                                            display:flex;align-items:center;justify-content:center;
                                            font-family:var(--font-serif);font-size:1.9rem;font-weight:700;
                                            color:var(--dark-0);letter-spacing:-1px;
                                            box-shadow:0 8px 32px rgba(201,168,76,0.3),0 0 0 1px rgba(201,168,76,0.4);
                                        " x-text="app.student_name ? app.student_name.split(' ').map(n=>n[0]).join('').toUpperCase().substring(0,2) : '?'"></div>
                                        <!-- verified dot -->
                                        <div style="position:absolute;bottom:-3px;right:-3px;width:18px;height:18px;border-radius:50%;background:var(--dark-50);border:2px solid var(--dark-50);display:flex;align-items:center;justify-content:center;">
                                            <svg style="width:11px;height:11px;color:#4ade80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </div>
                                    </div>

                                    <!-- Name + info -->
                                    <div style="flex:1;min-width:0;">
                                        <p style="font-size:0.7rem;font-weight:500;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-muted);margin-bottom:0.3rem;">Nom complet</p>
                                        <h2 style="font-family:var(--font-serif);font-size:1.9rem;font-weight:700;line-height:1.1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="shimmer-text" x-text="app.student_name || 'Sans nom'"></h2>
                                        <p style="font-size:0.9rem;color:var(--text-muted);margin-top:0.35rem;display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                                            <svg style="width:13px;height:13px;flex-shrink:0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            <span x-text="app.student_email"></span>
                                        </p>
                                    </div>

                                    <!-- Right badges column -->
                                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.5rem;flex-shrink:0;">
                                        <!-- Program badge -->
                                        <template x-if="app.program_type">
                                            <div style="
                                                display:inline-flex;align-items:center;gap:0.35rem;
                                                padding:0.3rem 0.75rem;
                                                background:rgba(201,168,76,0.1);
                                                border:1px solid var(--gold-line);
                                                border-radius:var(--r-md);
                                            ">
                                                <svg style="width:11px;height:11px;color:var(--gold-primary)" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                                <span style="font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold-primary);" x-text="app.program_type"></span>
                                            </div>
                                        </template>
                                        <!-- Dossier ID -->
                                        <p style="font-size:0.7rem;color:var(--text-faint);letter-spacing:0.08em;" x-text="'ID #' + String(app.id).padStart(6,'0')"></p>
                                    </div>
                                </div>

                                <!-- SIM chip decorative -->
                                <div style="position:absolute;bottom:1.25rem;right:2rem;opacity:0.18;">
                                    <div style="width:36px;height:28px;border-radius:4px;border:1px solid var(--gold-primary);display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:1fr 1fr 1fr;gap:2px;padding:3px;">
                                        <div style="background:var(--gold-primary);border-radius:1px;grid-column:1/-1;"></div>
                                        <div style="background:var(--gold-primary);border-radius:1px;"></div>
                                        <div style="background:transparent;border-radius:1px;"></div>
                                        <div style="background:var(--gold-primary);border-radius:1px;"></div>
                                        <div style="background:var(--gold-primary);border-radius:1px;grid-column:1/-1;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer — progress + stats -->
                            <div style="padding:1.35rem 2rem 1.5rem;background:var(--card-2);border-top:1px solid var(--gold-line);">

                                <!-- Dual progress bars -->
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.25rem;">
                                    <div>
                                        <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:0.45rem;">
                                            <span style="font-size:0.72rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:rgba(96,165,250,0.7);">Initial</span>
                                            <span style="font-family:var(--font-serif);font-size:1.2rem;font-weight:700;color:#60a5fa;" x-text="app.completion_percentage + '%'"></span>
                                        </div>
                                        <div style="height:6px;background:rgba(96,165,250,0.1);border-radius:99px;overflow:hidden;">
                                            <div style="height:100%;border-radius:99px;background:linear-gradient(90deg,#1d4ed8,#3b82f6,#60a5fa);transition:width 1s cubic-bezier(0.4,0,0.2,1);" :style="'width:' + app.completion_percentage + '%'"></div>
                                        </div>
                                        <p style="font-size:0.7rem;color:var(--text-faint);margin-top:0.3rem;" x-text="app.documents.filter(d => !d.is_complementary).length + ' / 9 documents'"></p>
                                    </div>
                                    <div>
                                        <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:0.45rem;">
                                            <span style="font-size:0.72rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.7);">Complémentaire</span>
                                            <span style="font-family:var(--font-serif);font-size:1.2rem;font-weight:700;color:var(--gold-primary);" x-text="app.complementary_completion_percentage + '%'"></span>
                                        </div>
                                        <div style="height:6px;background:rgba(201,168,76,0.1);border-radius:99px;overflow:hidden;">
                                            <div style="height:100%;border-radius:99px;background:var(--gold-gradient);transition:width 1s cubic-bezier(0.4,0,0.2,1);" :style="'width:' + app.complementary_completion_percentage + '%'"></div>
                                        </div>
                                        <p style="font-size:0.7rem;color:var(--text-faint);margin-top:0.3rem;" x-text="app.documents.filter(d => d.is_complementary).length + ' / 7 documents'"></p>
                                    </div>
                                </div>

                                <!-- Stats strip -->
                                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;border:1px solid var(--gold-line);border-radius:var(--r-lg);overflow:hidden;">
                                    <div style="padding:0.9rem;text-align:center;border-right:1px solid var(--gold-line);">
                                        <span style="display:block;font-family:var(--font-serif);font-size:1.75rem;font-weight:700;color:#60a5fa;line-height:1;" x-text="app.documents.filter(d => !d.is_complementary).length"></span>
                                        <span style="display:block;font-size:0.68rem;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-top:0.25rem;">Initiaux</span>
                                    </div>
                                    <div style="padding:0.9rem;text-align:center;border-right:1px solid var(--gold-line);">
                                        <span style="display:block;font-family:var(--font-serif);font-size:1.75rem;font-weight:700;color:var(--gold-primary);line-height:1;" x-text="app.documents.filter(d => d.is_complementary).length"></span>
                                        <span style="display:block;font-size:0.68rem;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-top:0.25rem;">Complémentaires</span>
                                    </div>
                                    <div style="padding:0.9rem;text-align:center;border-right:1px solid var(--gold-line);">
                                        <span style="display:block;font-family:var(--font-serif);font-size:1.1rem;font-weight:700;color:var(--text);line-height:1;padding-top:0.2rem;" x-text="app.current_step_label || ('Étape ' + app.current_step)"></span>
                                        <span style="display:block;font-size:0.68rem;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-top:0.25rem;">Étape</span>
                                    </div>
                                    <div style="padding:0.9rem;text-align:center;">
                                        <span style="display:block;font-family:var(--font-serif);font-size:0.95rem;font-weight:700;color:var(--text);line-height:1;padding-top:0.25rem;" x-text="app.created_at"></span>
                                        <span style="display:block;font-size:0.68rem;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin-top:0.25rem;">Création</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ── DOCUMENTS CARD with TABS ──────────────── -->
                        <div class="lux-card anim anim-1">

                            <!-- Tabs -->
                            <div class="tab-bar">
                                <button
                                    class="tab-btn"
                                    :class="{ active: app._tab === 'initial' || !app._tab }"
                                    @click="app._tab = 'initial'">
                                    <svg style="width:13px;height:13px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Dossier Initial
                                    <span class="tab-count"
                                        :class="{ done: app.completion_percentage >= 100 }"
                                        x-text="app.documents.filter(d => !d.is_complementary).length + '/' + requiredCount(app)">
                                    </span>
                                </button>
                                <button
                                    class="tab-btn"
                                    :class="{ active: app._tab === 'complementaire' }"
                                    @click="app._tab = 'complementaire'">
                                    <svg style="width:13px;height:13px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                    Dossier Complémentaire
                                    <span class="tab-count"
                                        :class="{ done: app.complementary_completion_percentage >= 100 }"
                                        x-text="app.documents.filter(d => d.is_complementary).length + '/' + Object.keys(app.complementary_documents).length">
                                    </span>
                                </button>
                            </div>

                            <!-- Auto-validation notice -->
                            <div style="padding:0.875rem 1.5rem;border-bottom:1px solid var(--gold-line);">
                                <div class="auto-badge">
                                    <svg style="width:13px;height:13px;color:#4ade80;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <span style="font-size:0.72rem;color:#4ade80;font-weight:500;letter-spacing:0.04em;">Auto-validation active — vos documents sont approuvés instantanément après upload</span>
                                </div>
                            </div>

                            <!-- ── TAB: INITIAL ───────────────────────── -->
                            <div x-show="app._tab === 'initial' || !app._tab" style="padding:1.5rem;">

                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.75rem;">
                                    <div style="display:flex;align-items:center;gap:0.75rem;">
                                        <div class="section-icon" style="background:rgba(96,165,250,0.1);border-color:rgba(96,165,250,0.25);">
                                            <svg style="width:15px;height:15px;color:#60a5fa" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <h3 class="section-title">Documents Initiaux</h3>
                                    </div>
                                    <span class="label-text" style="color:var(--text-faint);">Programme : <span style="color:var(--gold-primary);text-transform:capitalize;" x-text="app.program_type || 'licence'"></span></span>
                                </div>

                                <div style="display:flex;flex-direction:column;gap:0.6rem;">
                                    <template x-for="(label, docType) in app.required_documents" :key="'init_' + docType">
                                        <div class="doc-row"
                                            :class="{
                                                'doc-done': getDoc(app, docType),
                                                'doc-optional': isOptional(docType)
                                            }">
                                            <div style="flex:1;min-width:0;">
                                                <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                                                    <template x-if="getDoc(app, docType)">
                                                        <svg style="width:14px;height:14px;color:#4ade80;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                    </template>
                                                    <template x-if="!getDoc(app, docType)">
                                                        <svg style="width:14px;height:14px;color:var(--text-faint);flex-shrink:0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                                    </template>
                                                    <span style="font-size:0.875rem;font-weight:500;color:var(--text);" x-text="label.replace(' (optionnel)', '')"></span>
                                                    <span x-show="isOptional(docType)" class="opt-badge">Optionnel</span>
                                                </div>
                                                <template x-if="getDoc(app, docType)">
                                                    <div style="display:flex;align-items:center;gap:0.5rem;margin-top:0.3rem;margin-left:1.35rem;flex-wrap:wrap;">
                                                        <span style="font-size:0.75rem;color:var(--text-muted);" x-text="getDoc(app, docType).original_filename"></span>
                                                        <span class="doc-status"
                                                            :class="{
                                                                'doc-status-approved': getDoc(app, docType).status === 'approved',
                                                                'doc-status-pending':  getDoc(app, docType).status === 'pending',
                                                                'doc-status-rejected': getDoc(app, docType).status === 'rejected'
                                                            }">
                                                            <svg style="width:7px;height:7px" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                                                            <span x-text="getDoc(app, docType).status === 'approved' ? 'Validé' : getDoc(app, docType).status === 'rejected' ? 'Rejeté' : 'En attente'"></span>
                                                        </span>
                                                    </div>
                                                </template>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                                                <template x-if="getDoc(app, docType)">
                                                    <a :href="'/document/' + getDoc(app, docType).id + '/download'" class="btn-ghost" target="_blank">
                                                        <svg style="width:12px;height:12px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                        Télécharger
                                                    </a>
                                                </template>
                                                <label class="btn-gold" style="cursor:pointer;" :style="uploading[app.id + '_' + docType] ? 'opacity:0.6;pointer-events:none' : ''">
                                                    <input type="file" style="display:none" @change="uploadDoc(app, docType, $event.target.files[0], false)" accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx">
                                                    <svg style="width:11px;height:11px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                    <span x-text="uploading[app.id + '_' + docType] ? 'Upload…' : (getDoc(app, docType) ? 'Remplacer' : 'Uploader')"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- ── TAB: COMPLÉMENTAIRE ────────────────── -->
                            <div x-show="app._tab === 'complementaire'" style="padding:1.5rem;">

                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.75rem;">
                                    <div style="display:flex;align-items:center;gap:0.75rem;">
                                        <div class="section-icon">
                                            <svg style="width:15px;height:15px;color:var(--gold-primary)" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                        </div>
                                        <h3 class="section-title">Documents Complémentaires</h3>
                                    </div>
                                    <span class="pill pill-gold" style="font-size:0.63rem;"
                                        x-text="app.documents.filter(d=>d.is_complementary).length + '/' + Object.keys(app.complementary_documents).length + ' documents'">
                                    </span>
                                </div>

                                <div style="display:flex;flex-direction:column;gap:0.6rem;">
                                    <template x-for="(label, docType) in app.complementary_documents" :key="'comp_' + docType">
                                        <div class="doc-row" :class="{ 'doc-done': getDoc(app, docType) }">
                                            <div style="flex:1;min-width:0;">
                                                <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                                                    <template x-if="getDoc(app, docType)">
                                                        <svg style="width:14px;height:14px;color:#4ade80;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                    </template>
                                                    <template x-if="!getDoc(app, docType)">
                                                        <svg style="width:14px;height:14px;color:var(--text-faint);flex-shrink:0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                                    </template>
                                                    <span style="font-size:0.875rem;font-weight:500;color:var(--text);" x-text="label"></span>
                                                </div>
                                                <template x-if="getDoc(app, docType)">
                                                    <div style="display:flex;align-items:center;gap:0.5rem;margin-top:0.3rem;margin-left:1.35rem;flex-wrap:wrap;">
                                                        <span style="font-size:0.75rem;color:var(--text-muted);" x-text="getDoc(app, docType).original_filename"></span>
                                                        <span class="doc-status doc-status-approved">
                                                            <svg style="width:7px;height:7px" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                                                            Validé
                                                        </span>
                                                    </div>
                                                </template>
                                            </div>
                                            <div style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                                                <template x-if="getDoc(app, docType)">
                                                    <a :href="'/document/' + getDoc(app, docType).id + '/download'" class="btn-ghost" target="_blank">
                                                        <svg style="width:12px;height:12px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                        Télécharger
                                                    </a>
                                                </template>
                                                <label class="btn-gold" style="cursor:pointer;" :style="uploading[app.id + '_' + docType] ? 'opacity:0.6;pointer-events:none' : ''">
                                                    <input type="file" style="display:none" @change="uploadDoc(app, docType, $event.target.files[0], true)" accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx">
                                                    <svg style="width:11px;height:11px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                    <span x-text="uploading[app.id + '_' + docType] ? 'Upload…' : (getDoc(app, docType) ? 'Remplacer' : 'Uploader')"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                            </div>
                        </div>

                    </div>
                </template>

                <div class="page-footer">
                    <p style="font-family:var(--font-serif);font-size:1rem;font-style:italic;color:var(--text-muted);">
                        Travel Express &mdash; <span style="color:var(--gold-primary);">Votre partenaire pour les études à l'étranger</span>
                    </p>
                </div>
            </div>
        </template>

    </div>

    <!-- TOAST -->
    <div class="toast-wrap" :class="{ show: toast.show }">
        <div class="toast-inner">
            <div :style="toast.type === 'success' ? 'color:#4ade80' : 'color:var(--color-danger)'">
                <svg x-show="toast.type === 'success'" style="width:18px;height:18px;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <svg x-show="toast.type === 'error'" style="width:18px;height:18px;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p style="font-size:0.85rem;font-weight:500;color:var(--gold-primary);" x-text="toast.title"></p>
                <p style="font-size:0.8rem;color:var(--text-muted);margin-top:0.15rem;" x-text="toast.message"></p>
            </div>
        </div>
    </div>

    <script>
        const OPTIONAL_DOCS  = ['certificat_anglais','test_csca','plan_etude','lettre_motivation','capacite_financiere'];
        const MAX_SIZE_BYTES = 10 * 1024 * 1024; // 10 Mo
        const ALLOWED_EXTS  = ['pdf','jpg','jpeg','png','doc','docx','webp'];
        const ALLOWED_MIMES = [
            'application/pdf',
            'image/jpeg','image/jpg','image/png','image/webp',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        function dossierApp() {
            return {
                loading:      true,
                isLoggedIn:   false,
                userEmail:    '',
                applications: [],
                uploading:    {},
                error:        null,
                toast:        { show: false, type: 'success', title: '', message: '' },

                showToast(type, title, message) {
                    this.toast = { show: true, type, title, message };
                    setTimeout(() => this.toast.show = false, 5000);
                },

                // Returns uploaded doc by type, or null
                getDoc(app, docType) {
                    return app.documents.find(d => d.document_type === docType) || null;
                },

                isOptional(docType) {
                    return OPTIONAL_DOCS.includes(docType);
                },

                // Count only required (non-optional) docs
                requiredCount(app) {
                    if (!app.required_documents) return 0;
                    return Object.keys(app.required_documents).filter(k => !OPTIONAL_DOCS.includes(k)).length;
                },

                async init() {
                    const token = localStorage.getItem('auth_token');
                    if (!token) {
                        this.loading    = false;
                        this.isLoggedIn = false;
                        return;
                    }

                    this.isLoggedIn = true;
                    const userData = localStorage.getItem('user');
                    if (userData) {
                        try { this.userEmail = JSON.parse(userData).email || ''; } catch {}
                    }

                    try {
                        const res = await fetch('/api/my-dossier', {
                            headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + token }
                        });

                        if (res.status === 401) {
                            this.isLoggedIn = false;
                            localStorage.removeItem('auth_token');
                            localStorage.removeItem('user');
                            return;
                        }

                        const data = await res.json();

                        if (!res.ok) {
                            this.error = data.message || data.error || 'Erreur lors du chargement';
                            return;
                        }

                        // Inject reactive _tab property
                        this.applications = (data.data || []).map(app => ({ ...app, _tab: 'initial' }));

                    } catch (err) {
                        this.error = 'Impossible de charger votre dossier. Vérifiez votre connexion.';
                        console.error(err);
                    } finally {
                        this.loading = false;
                    }
                },

                validateFile(file) {
                    if (!file) return 'Aucun fichier sélectionné.';

                    // Taille max 10 Mo
                    if (file.size > MAX_SIZE_BYTES) {
                        const mb = (file.size / 1024 / 1024).toFixed(1);
                        return `Fichier trop volumineux (${mb} Mo). Maximum autorisé : 10 Mo.`;
                    }

                    // Extension
                    const ext = file.name.split('.').pop().toLowerCase();
                    if (!ALLOWED_EXTS.includes(ext)) {
                        return `Extension .${ext} non acceptée. Formats autorisés : PDF, JPG, PNG, DOC, DOCX, WebP.`;
                    }

                    // MIME type (si disponible côté navigateur)
                    if (file.type && !ALLOWED_MIMES.includes(file.type)) {
                        return `Type de fichier non autorisé (${file.type}). Formats acceptés : PDF, JPG, PNG, DOC, DOCX, WebP.`;
                    }

                    return null; // OK
                },

                async uploadDoc(app, docType, file, isComplementary) {
                    if (!file) return;

                    // Validation client-side avant envoi
                    const validationError = this.validateFile(file);
                    if (validationError) {
                        this.showToast('error', 'Fichier invalide', validationError);
                        return;
                    }

                    const key = app.id + '_' + docType;
                    this.uploading = { ...this.uploading, [key]: true };

                    const fd = new FormData();
                    fd.append('document_type', docType);
                    fd.append('file', file);
                    if (isComplementary) fd.append('is_complementary', '1');

                    try {
                        const res = await fetch(`/dossier/${app.upload_token}/upload`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd
                        });

                        // 413 = nginx/server body size limit exceeded
                        if (res.status === 413) {
                            this.showToast('error', 'Fichier trop lourd', 'Le serveur refuse le fichier (limite serveur dépassée). Contactez l\'administrateur.');
                            return;
                        }

                        // Try to parse JSON; fallback to text if server returned HTML (e.g. 500)
                        let data = {};
                        const ct = res.headers.get('content-type') || '';
                        if (ct.includes('application/json')) {
                            data = await res.json();
                        } else {
                            const txt = await res.text();
                            data = { error: `Erreur serveur (HTTP ${res.status})` };
                            console.error('Upload non-JSON response:', txt);
                        }

                        if (res.ok) {
                            const sizeStr = (file.size / 1024).toFixed(0) + ' Ko';
                            this.showToast('success', 'Document validé ✓', `${file.name} (${sizeStr}) — approuvé automatiquement.`);
                            await this.refreshApps();
                        } else {
                            this.showToast('error', 'Erreur upload', data.error || data.message || `Impossible d'uploader (HTTP ${res.status}).`);
                        }
                    } catch (err) {
                        console.error('Upload fetch error:', err);
                        this.showToast('error', 'Erreur réseau', 'La requête a échoué. Vérifiez votre connexion et réessayez.');
                    } finally {
                        this.uploading = { ...this.uploading, [key]: false };
                    }
                },

                async refreshApps() {
                    const token = localStorage.getItem('auth_token');
                    if (!token) return;
                    try {
                        const res  = await fetch('/api/my-dossier', {
                            headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + token }
                        });
                        const data = await res.json();
                        if (data.data) {
                            // Preserve current _tab state
                            const tabState = {};
                            this.applications.forEach(a => { tabState[a.id] = a._tab; });
                            this.applications = data.data.map(a => ({ ...a, _tab: tabState[a.id] || 'initial' }));
                        }
                    } catch {}
                }
            };
        }
    </script>
</body>
</html>

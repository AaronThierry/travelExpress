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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold:        #D4AF37;
            --gold-bright: #F0C85C;
            --gold-dark:   #9A7B1E;
            --gold-dim:    rgba(212,175,55,0.15);
            --gold-line:   rgba(212,175,55,0.22);
            --obsidian:    #080807;
            --card:        #0e0d0b;
            --card-2:      #131109;
            --text:        #F2ECD8;
            --text-muted:  rgba(242,236,216,0.45);
            --text-faint:  rgba(242,236,216,0.2);
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

        /* ── Background ───────────────────────────────────────── */
        .bg-scene {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
        }
        .bg-scene::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 15% -5%,  rgba(212,175,55,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 85% 105%, rgba(212,175,55,0.05) 0%, transparent 55%);
        }
        .bg-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(212,175,55,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212,175,55,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* ── Layout ───────────────────────────────────────────── */
        .page-wrap {
            position: relative; z-index: 1;
            max-width: 960px;
            margin: 0 auto;
            padding: 0 1.5rem 5rem;
        }

        /* ── Header ───────────────────────────────────────────── */
        .site-header {
            position: sticky; top: 0; z-index: 50;
            background: rgba(8,8,7,0.88);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--gold-line);
        }
        .header-inner {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .logo-mark {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text);
        }
        .logo-sub {
            font-size: 0.62rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
        }
        .btn-back {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.45rem 1rem;
            border: 1px solid var(--gold-line);
            color: var(--text-muted);
            font-size: 0.78rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { color: var(--gold); border-color: rgba(212,175,55,0.4); background: var(--gold-dim); }

        /* ── Page title ───────────────────────────────────────── */
        .page-title-block {
            padding: 2.5rem 0 2rem;
        }

        /* ── Cards ────────────────────────────────────────────── */
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
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: 0.45;
        }
        .lux-card:hover { border-color: rgba(212,175,55,0.38); }

        /* ── Label text ───────────────────────────────────────── */
        .label-text {
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* ── Avatar ───────────────────────────────────────────── */
        .avatar-ring {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem; font-weight: 700;
            color: var(--obsidian);
            position: relative;
            flex-shrink: 0;
            box-shadow: 0 0 0 1px var(--gold-dim), 0 6px 24px rgba(212,175,55,0.18);
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
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-bright), var(--gold-dark));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        /* ── Progress ─────────────────────────────────────────── */
        .prog-track {
            height: 3px;
            background: rgba(212,175,55,0.1);
            border-radius: 99px;
            overflow: visible;
            position: relative;
        }
        .prog-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-bright));
            position: relative;
            transition: width 0.8s cubic-bezier(0.4,0,0.2,1);
        }
        .prog-fill::after {
            content: '';
            position: absolute; top: -2.5px; right: -1px;
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--gold-bright);
            box-shadow: 0 0 10px var(--gold);
        }

        /* ── Status Pills ─────────────────────────────────────── */
        .pill {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.68rem; font-weight: 500;
            letter-spacing: 0.06em; text-transform: uppercase;
            border: 1px solid;
        }
        .pill-green  { color:#4ade80; border-color:rgba(74,222,128,0.3);  background:rgba(74,222,128,0.07); }
        .pill-red    { color:#f87171; border-color:rgba(248,113,113,0.3); background:rgba(248,113,113,0.07); }
        .pill-blue   { color:#60a5fa; border-color:rgba(96,165,250,0.3);  background:rgba(96,165,250,0.07); }
        .pill-yellow { color:#fbbf24; border-color:rgba(251,191,36,0.3);  background:rgba(251,191,36,0.07); }
        .pill-gray   { color:rgba(242,236,216,0.5); border-color:rgba(242,236,216,0.12); background:rgba(242,236,216,0.04); }
        .pill-gold   { color:var(--gold); border-color:var(--gold-line); background:var(--gold-dim); }

        /* ── Tabs ─────────────────────────────────────────────── */
        .tab-bar {
            display: flex;
            border-bottom: 1px solid var(--gold-line);
            overflow-x: auto; scrollbar-width: none;
        }
        .tab-bar::-webkit-scrollbar { display: none; }
        .tab-btn {
            padding: 0.9rem 1.5rem;
            font-size: 0.75rem; font-weight: 500;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            cursor: pointer; white-space: nowrap; flex-shrink: 0;
            transition: color 0.2s, border-color 0.2s;
            background: none;
            border-top: none; border-left: none; border-right: none;
        }
        .tab-btn:hover { color: var(--gold-bright); }
        .tab-btn.active { color: var(--gold); border-bottom-color: var(--gold); }

        /* ── Doc rows ─────────────────────────────────────────── */
        .doc-row {
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            padding: 1.25rem 1.5rem;
            background: rgba(255,255,255,0.012);
            border: 1px solid rgba(212,175,55,0.09);
            border-left: 3px solid rgba(212,175,55,0.15);
            border-radius: 0.75rem;
            transition: all 0.22s;
        }
        @media (min-width: 600px) {
            .doc-row { flex-direction: row; align-items: center; }
        }
        .doc-row:hover { background: rgba(212,175,55,0.04); border-left-color: var(--gold); border-color: rgba(212,175,55,0.22); }
        .doc-row.doc-done { border-left-color: rgba(74,222,128,0.5); border-color: rgba(74,222,128,0.13); }

        /* ── Doc status ───────────────────────────────────────── */
        .doc-status {
            display: inline-flex; align-items: center; gap: 0.25rem;
            padding: 0.15rem 0.55rem;
            border-radius: 99px;
            font-size: 0.63rem; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase;
        }
        .doc-status-approved { color:#4ade80; background:rgba(74,222,128,0.1);  border:1px solid rgba(74,222,128,0.25); }
        .doc-status-pending   { color:#fbbf24; background:rgba(251,191,36,0.08); border:1px solid rgba(251,191,36,0.2); }
        .doc-status-rejected  { color:#f87171; background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.25); }

        /* ── Buttons ──────────────────────────────────────────── */
        .btn-gold {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem;
            padding: 0.55rem 1.1rem;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: var(--obsidian);
            font-family: 'Outfit', sans-serif;
            font-size: 0.75rem; font-weight: 600;
            letter-spacing: 0.07em; text-transform: uppercase;
            border: none; border-radius: 0.5rem;
            cursor: pointer; transition: all 0.22s; white-space: nowrap;
        }
        .btn-gold:hover { background: linear-gradient(135deg, var(--gold), var(--gold-bright)); transform: translateY(-1px); box-shadow: 0 5px 20px rgba(212,175,55,0.25); }
        .btn-gold:disabled { opacity: 0.45; cursor: not-allowed; transform: none; }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.5rem 0.9rem;
            border: 1px solid var(--gold-line);
            color: var(--gold);
            font-size: 0.75rem; font-weight: 500; letter-spacing: 0.04em;
            border-radius: 0.5rem; cursor: pointer; background: none;
            transition: all 0.2s; white-space: nowrap; text-decoration: none;
        }
        .btn-ghost:hover { background: var(--gold-dim); border-color: rgba(212,175,55,0.4); }

        /* ── Section title ────────────────────────────────────── */
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem; font-weight: 600;
            color: var(--text); letter-spacing: 0.01em;
        }
        .section-icon {
            width: 34px; height: 34px;
            border-radius: 0.55rem;
            background: var(--gold-dim);
            border: 1px solid var(--gold-line);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ── Spinner ──────────────────────────────────────────── */
        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner {
            width: 40px; height: 40px;
            border: 3px solid rgba(212,175,55,0.12);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        /* ── Animations ───────────────────────────────────────── */
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fade-up 0.45s ease both; }
        .anim-1 { animation-delay: 0.06s; }
        .anim-2 { animation-delay: 0.12s; }
        .anim-3 { animation-delay: 0.18s; }

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
            border-radius: 0.875rem;
            padding: 0.875rem 1.125rem;
            display: flex; align-items: flex-start; gap: 0.75rem;
            box-shadow: 0 12px 40px rgba(0,0,0,0.6);
        }

        /* ── Footer ───────────────────────────────────────────── */
        .page-footer {
            margin-top: 3.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gold-line);
            text-align: center;
        }

        /* ── Upload progress bar ──────────────────────────────── */
        .upload-bar-wrap {
            display: none;
            height: 2px; background: rgba(212,175,55,0.1);
            border-radius: 99px; overflow: hidden; margin-top: 0.5rem;
        }
        .upload-bar-wrap.visible { display: block; }
        .upload-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-bright));
            width: 0%;
            transition: width 0.3s;
        }
    </style>
</head>
<body x-data="dossierApp()" x-init="init()">

    <div class="bg-scene">
        <div class="bg-grid"></div>
    </div>

    <!-- ── HEADER ──────────────────────────────────────────────── -->
    <header class="site-header">
        <div class="header-inner">
            <a href="/" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
                <div class="logo-mark">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;color:#080807">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="logo-name">Travel Express</div>
                    <div class="logo-sub">Mon Dossier</div>
                </div>
            </a>
            <a href="/" class="btn-back">
                <svg style="width:14px;height:14px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Retour au site
            </a>
        </div>
    </header>

    <div class="page-wrap">

        <!-- Page title -->
        <div class="page-title-block anim">
            <p class="label-text" style="margin-bottom:0.5rem;">Espace candidat</p>
            <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.25rem;font-weight:600;line-height:1.1;color:var(--text)">
                Mon <span class="shimmer-text">Dossier</span>
            </h1>
            <p style="margin-top:0.5rem;font-size:0.875rem;color:var(--text-muted)">
                Gérez vos documents et suivez l'avancement de votre candidature.
            </p>
        </div>

        <!-- ── LOADING ──────────────────────────────────────────── -->
        <div x-show="loading" class="anim" style="text-align:center;padding:5rem 0;">
            <div class="spinner" style="margin:0 auto 1.25rem;"></div>
            <p style="color:var(--text-muted);font-size:0.875rem;">Chargement de votre dossier…</p>
        </div>

        <!-- ── NOT LOGGED IN ────────────────────────────────────── -->
        <div x-show="!loading && !isLoggedIn" class="lux-card anim" style="padding:3rem;text-align:center;">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--gold-dim);border:1px solid var(--gold-line);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                <svg style="width:28px;height:28px;color:var(--gold)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:600;margin-bottom:0.75rem;">Connexion requise</h2>
            <p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:1.75rem;">Connectez-vous pour accéder à votre dossier de candidature.</p>
            <a href="/login" class="btn-gold" style="padding:0.75rem 2rem;font-size:0.85rem;">Se connecter</a>
        </div>

        <!-- ── NO DOSSIER ───────────────────────────────────────── -->
        <div x-show="!loading && isLoggedIn && applications.length === 0" class="lux-card anim" style="padding:3rem;text-align:center;">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--gold-dim);border:1px solid var(--gold-line);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                <svg style="width:28px;height:28px;color:var(--gold)" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:600;margin-bottom:0.75rem;">Aucun dossier trouvé</h2>
            <p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:0.5rem;">Aucun dossier n'est associé à votre adresse email.</p>
            <p class="label-text" x-text="userEmail" style="margin-top:0.25rem;"></p>
        </div>

        <!-- ── ERROR ────────────────────────────────────────────── -->
        <div x-show="error" class="lux-card anim" style="padding:2.5rem;text-align:center;border-color:rgba(248,113,113,0.25);">
            <p style="color:#f87171;font-size:0.875rem;" x-text="error"></p>
        </div>

        <!-- ── DOSSIERS ─────────────────────────────────────────── -->
        <template x-if="!loading && isLoggedIn && applications.length > 0">
            <div>
                <template x-for="(app, appIdx) in applications" :key="app.id">
                    <div style="margin-bottom:1.75rem;">

                        <!-- Identity card -->
                        <div class="lux-card anim" style="padding:2rem;margin-bottom:1.5rem;">
                            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                                <div style="display:flex;align-items:center;gap:1.25rem;flex:1;min-width:0;">
                                    <div class="avatar-ring" x-text="app.student_name ? app.student_name.charAt(0).toUpperCase() : '?'"></div>
                                    <div style="min-width:0;flex:1;">
                                        <p class="label-text" style="margin-bottom:0.25rem;">Candidat</p>
                                        <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" class="shimmer-text" x-text="app.student_name"></h2>
                                        <p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">
                                            <span x-text="app.student_email"></span>
                                            <span style="color:var(--gold-line);margin:0 0.4rem;">·</span>
                                            <span style="color:var(--gold);text-transform:capitalize;" x-text="app.program_type || 'N/A'"></span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Stats row -->
                                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:1rem;padding-top:1.25rem;border-top:1px solid var(--gold-line);">
                                    <div>
                                        <p class="label-text" style="margin-bottom:0.3rem;">Statut</p>
                                        <span class="pill"
                                            :class="{
                                                'pill-green':  app.status === 'approved',
                                                'pill-red':    app.status === 'rejected',
                                                'pill-blue':   app.status === 'complete',
                                                'pill-yellow': app.status === 'pending' || app.status === 'incomplete',
                                                'pill-gray':   !app.status
                                            }"
                                            x-text="app.status_info?.label || app.status">
                                        </span>
                                    </div>
                                    <div>
                                        <p class="label-text" style="margin-bottom:0.3rem;">Étape</p>
                                        <p style="font-family:'Cormorant Garamond',serif;font-size:1rem;font-weight:600;color:var(--text);" x-text="app.current_step_label || ('Étape ' + app.current_step)"></p>
                                    </div>
                                    <div x-show="app.university_name">
                                        <p class="label-text" style="margin-bottom:0.3rem;">Université</p>
                                        <p style="font-size:0.82rem;color:var(--text);" x-text="app.university_name"></p>
                                    </div>
                                    <div>
                                        <p class="label-text" style="margin-bottom:0.3rem;">Créé le</p>
                                        <p style="font-size:0.82rem;color:var(--text);" x-text="app.created_at"></p>
                                    </div>
                                </div>

                                <!-- Progress bar complémentaire uniquement -->
                                <div>
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
                                        <span class="label-text">Progression complémentaire</span>
                                        <span style="font-family:'Cormorant Garamond',serif;font-size:0.95rem;font-weight:600;color:var(--gold);" x-text="app.complementary_completion_percentage + '%'"></span>
                                    </div>
                                    <div class="prog-track">
                                        <div class="prog-fill" :style="'width:' + app.complementary_completion_percentage + '%'"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents card -->
                        <div class="lux-card anim anim-1" style="padding:2rem;">

                            <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.75rem;">
                                <div class="section-icon">
                                    <svg style="width:16px;height:16px;color:var(--gold)" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <h3 class="section-title">Dossier Complémentaire</h3>
                                <span class="pill pill-gold" style="margin-left:auto;font-size:0.65rem;" x-text="app.documents.filter(d=>d.is_complementary).length + '/' + Object.keys(app.complementary_documents).length + ' docs'"></span>
                            </div>

                            <!-- Complémentaire uniquement -->
                            <div style="display:flex;flex-direction:column;gap:0.75rem;">

                                <!-- Auto-validation badge -->
                                <div style="display:flex;align-items:center;gap:0.5rem;padding:0.75rem 1rem;background:rgba(74,222,128,0.05);border:1px solid rgba(74,222,128,0.2);border-radius:0.625rem;margin-bottom:0.5rem;">
                                    <svg style="width:14px;height:14px;color:#4ade80;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <span style="font-size:0.72rem;color:#4ade80;font-weight:500;letter-spacing:0.04em;">Auto-validation active — vos documents sont approuvés immédiatement</span>
                                </div>

                                <template x-for="(label, docType) in app.complementary_documents" :key="docType">
                                    <div class="doc-row" :class="{ 'doc-done': getDoc(app, docType) }">
                                        <div style="flex:1;min-width:0;">
                                            <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                                                <template x-if="getDoc(app, docType)">
                                                    <svg style="width:15px;height:15px;color:#4ade80;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                </template>
                                                <template x-if="!getDoc(app, docType)">
                                                    <svg style="width:15px;height:15px;color:var(--text-faint);flex-shrink:0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                </template>
                                                <span style="font-size:0.875rem;font-weight:500;color:var(--text);" x-text="label"></span>
                                            </div>
                                            <template x-if="getDoc(app, docType)">
                                                <div style="display:flex;align-items:center;gap:0.5rem;margin-top:0.35rem;margin-left:1.4rem;flex-wrap:wrap;">
                                                    <span style="font-size:0.75rem;color:var(--text-muted);" x-text="getDoc(app, docType).original_filename"></span>
                                                    <span class="doc-status doc-status-approved">
                                                        <svg style="width:8px;height:8px" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                                                        Validé
                                                    </span>
                                                </div>
                                            </template>
                                        </div>
                                        <div style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                                            <template x-if="getDoc(app, docType)">
                                                <a :href="'/document/' + getDoc(app, docType).id + '/download'" class="btn-ghost" target="_blank">
                                                    <svg style="width:13px;height:13px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    Télécharger
                                                </a>
                                            </template>
                                            <label class="btn-gold cursor-pointer" :style="uploading[app.id + '_' + docType] ? 'opacity:0.6;pointer-events:none' : ''">
                                                <input type="file" style="display:none" @change="uploadDoc(app, docType, $event.target.files[0])" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                <svg style="width:12px;height:12px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                <span x-text="uploading[app.id + '_' + docType] ? 'Upload…' : (getDoc(app, docType) ? 'Remplacer' : 'Uploader')"></span>
                                            </label>
                                        </div>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </div>
                </template>

                <!-- Footer -->
                <div class="page-footer">
                    <p style="font-family:'Cormorant Garamond',serif;font-size:1rem;font-style:italic;color:var(--text-muted);">
                        Travel Express &mdash; <span style="color:var(--gold);">Votre partenaire pour les études à l'étranger</span>
                    </p>
                </div>
            </div>
        </template>

    </div>

    <!-- ── TOAST ──────────────────────────────────────────────────── -->
    <div class="toast-wrap" :class="{ show: toast.show }">
        <div class="toast-inner">
            <div :style="toast.type === 'success' ? 'color:#4ade80' : 'color:#f87171'">
                <svg x-show="toast.type === 'success'" style="width:18px;height:18px;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <svg x-show="toast.type === 'error'" style="width:18px;height:18px;flex-shrink:0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p style="font-size:0.85rem;font-weight:500;color:var(--gold);" x-text="toast.title"></p>
                <p style="font-size:0.8rem;color:var(--text-muted);margin-top:0.15rem;" x-text="toast.message"></p>
            </div>
        </div>
    </div>

    <script>
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

                getDoc(app, docType) {
                    return app.documents.find(d => d.document_type === docType) || null;
                },

                async init() {
                    const token = localStorage.getItem('auth_token');
                    if (!token) {
                        this.loading   = false;
                        this.isLoggedIn = false;
                        return;
                    }

                    try {
                        const res = await fetch('/api/my-dossier', {
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + token
                            }
                        });

                        if (res.status === 401) {
                            this.loading    = false;
                            this.isLoggedIn = false;
                            return;
                        }

                        if (!res.ok) throw new Error('Erreur lors du chargement');

                        const data       = await res.json();
                        this.isLoggedIn  = true;
                        this.applications = data.data || [];

                        const userData = localStorage.getItem('user');
                        if (userData) this.userEmail = JSON.parse(userData).email || '';

                    } catch (err) {
                        this.error = err.message;
                    } finally {
                        this.loading = false;
                    }
                },

                async uploadDoc(app, docType, file) {
                    if (!file) return;
                    const key = app.id + '_' + docType;
                    this.uploading[key] = true;

                    const fd = new FormData();
                    fd.append('document_type', docType);
                    fd.append('file', file);

                    try {
                        const res = await fetch(`/dossier/${app.upload_token}/upload`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd
                        });
                        const data = await res.json();

                        if (res.ok) {
                            this.showToast('success', 'Document validé', data.message || 'Document uploadé et approuvé automatiquement.');
                            // Reload data to reflect new document
                            await this.refreshApp(app);
                        } else {
                            this.showToast('error', 'Erreur', data.error || 'Impossible d\'uploader le document.');
                        }
                    } catch {
                        this.showToast('error', 'Erreur', 'Une erreur est survenue.');
                    } finally {
                        this.uploading[key] = false;
                    }
                },

                async refreshApp(app) {
                    const token = localStorage.getItem('auth_token');
                    if (!token) return;
                    try {
                        const res  = await fetch('/api/my-dossier', {
                            headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + token }
                        });
                        const data = await res.json();
                        if (data.data) {
                            this.applications = data.data;
                        }
                    } catch {}
                }
            };
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/images/logo/logo_travel.png">
    <link rel="shortcut icon" type="image/png" href="/images/logo/logo_travel.png">
    <title>Mon Profil — Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Bebas+Neue&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            background: var(--dark-0);
            color: var(--dark-800);
            min-height: 100vh;
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

        /* Header */
        .lux-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            background: rgba(8,8,8,.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,168,76,.15);
        }

        .lux-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 70px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .lux-logo {
            display: flex; align-items: center;
            gap: 0.75rem; text-decoration: none;
        }

        .lux-logo-icon {
            width: 42px; height: 42px;
            background: var(--gold-gradient);
            border-radius: var(--r-lg);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: #000;
        }

        .lux-logo-text {
            font-family: var(--font-serif);
            font-size: 1.4rem; font-weight: 700;
            color: var(--dark-900); letter-spacing: 0.02em;
        }

        .lux-logo-sub {
            font-family: var(--font-body);
            font-size: 0.6rem; font-weight: 700;
            letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold-primary); display: block; margin-top: -2px;
        }

        .lux-nav-actions { display: flex; align-items: center; gap: 0.75rem; }

        .btn-gold {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.55rem 1.25rem;
            background: var(--gold-gradient);
            color: #000; border: none; border-radius: var(--r-md);
            font-family: var(--font-body);
            font-size: 0.82rem; font-weight: 700;
            letter-spacing: 0.08em; text-transform: uppercase;
            text-decoration: none; cursor: pointer;
            transition: box-shadow .3s, transform .15s;
        }
        .btn-gold:hover { box-shadow: var(--glow-gold-strong); transform: translateY(-1px); }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.55rem 1.25rem;
            background: transparent;
            color: var(--dark-700);
            border: 1px solid rgba(201,168,76,.25);
            border-radius: var(--r-md);
            font-family: var(--font-body);
            font-size: 0.82rem; font-weight: 500;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
        }
        .btn-ghost:hover { border-color: var(--gold-primary); color: var(--gold-primary); }

        /* Main layout */
        .lux-main { position: relative; z-index: 1; padding-top: 70px; }

        /* Hero banner */
        .profile-hero {
            position: relative;
            background: linear-gradient(180deg, var(--dark-100) 0%, var(--dark-0) 100%);
            border-bottom: 1px solid rgba(201,168,76,.15);
            overflow: hidden;
            padding: 3rem 2rem 0;
        }

        .profile-hero::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
        }

        .hero-bg-decor {
            position: absolute; top: -60px; right: -60px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,168,76,.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: flex-end;
            gap: 2.5rem; padding-bottom: 2.5rem;
        }

        /* Avatar ring */
        .avatar-ring { position: relative; flex-shrink: 0; }
        .avatar-ring::before {
            content: '';
            position: absolute; inset: -4px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-primary), transparent, var(--gold-primary));
            z-index: 0;
        }

        .avatar-inner {
            position: relative; z-index: 1;
            width: 120px; height: 120px; border-radius: 50%;
            overflow: hidden;
            background: var(--dark-300);
            border: 3px solid var(--dark-0);
            display: flex; align-items: center; justify-content: center;
        }

        .avatar-initials {
            font-family: var(--font-serif);
            font-size: 2.8rem; font-weight: 600;
            color: var(--gold-primary);
        }

        .avatar-status {
            position: absolute; bottom: 6px; right: 6px;
            width: 18px; height: 18px;
            background: var(--color-success);
            border-radius: 50%; border: 2px solid var(--dark-0); z-index: 2;
        }

        .hero-info { flex: 1; }

        .hero-title {
            font-family: var(--font-serif);
            font-size: clamp(1.8rem,4vw,2.8rem);
            font-weight: 600; color: var(--dark-900);
            letter-spacing: 0.01em; line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 0.85rem; color: var(--gold-primary);
            font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; margin-top: 0.4rem;
        }

        .hero-location {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.85rem; color: var(--dark-600); margin-top: 0.5rem;
        }

        .hero-stats { display: flex; gap: 1rem; flex-shrink: 0; }

        .stat-pill {
            text-align: center; padding: 0.75rem 1.25rem;
            background: rgba(201,168,76,.08);
            border: 1px solid rgba(201,168,76,.25);
            border-radius: var(--r-xl);
        }

        .stat-value {
            font-family: var(--font-serif);
            font-size: 1.8rem; font-weight: 700;
            color: var(--gold-primary); line-height: 1; display: block;
        }

        .stat-label {
            font-size: 0.65rem; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--dark-600); display: block; margin-top: 0.25rem;
        }

        /* Content layout */
        .content-wrap {
            max-width: 1200px; margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 1.75rem;
        }

        /* Cards */
        .lux-card {
            background: var(--dark-100);
            border: 1px solid rgba(201,168,76,.15);
            border-radius: var(--r-xl);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(201,168,76,.1);
            display: flex; align-items: center; gap: 0.75rem;
        }

        .card-icon {
            width: 34px; height: 34px; border-radius: var(--r-md);
            background: rgba(201,168,76,.1);
            border: 1px solid rgba(201,168,76,.25);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-primary); font-size: 0.82rem;
        }

        .card-title {
            font-family: var(--font-serif);
            font-size: 0.95rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            color: var(--dark-900);
        }

        .card-body { padding: 1.5rem; }

        /* Progress bar */
        .progress-track {
            height: 4px;
            background: rgba(255,255,255,.06);
            border-radius: 4px; overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--gold-gradient);
            border-radius: 4px;
            transition: width 1s cubic-bezier(0.4,0,0.2,1);
        }

        /* Info rows */
        .info-row {
            display: flex; align-items: center; gap: 1rem;
            padding: 0.9rem 0;
            border-bottom: 1px solid rgba(255,255,255,.03);
        }
        .info-row:last-child { border-bottom: none; }

        .info-icon {
            width: 36px; height: 36px; border-radius: var(--r-md);
            background: rgba(201,168,76,.07);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-primary); font-size: 0.8rem; flex-shrink: 0;
        }

        .info-label {
            font-size: 0.68rem; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--gold-deep);
        }

        .info-value {
            font-size: 0.88rem; font-weight: 400;
            color: var(--dark-900); word-break: break-word;
        }

        .info-value a { color: var(--gold-primary); text-decoration: none; }
        .info-value a:hover { text-decoration: underline; }

        /* Bio */
        .bio-text {
            font-size: 0.9rem; line-height: 1.8;
            color: var(--dark-700); font-weight: 300;
        }

        /* Tags */
        .tag {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            background: rgba(201,168,76,.07);
            border: 1px solid rgba(201,168,76,.2);
            border-radius: var(--r-full);
            font-size: 0.78rem; font-weight: 400;
            color: var(--dark-800); transition: all 0.2s;
        }
        .tag:hover { background: rgba(201,168,76,.18); color: var(--gold-primary); }

        /* Social buttons */
        .social-btn {
            width: 42px; height: 42px; border-radius: var(--r-lg);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; text-decoration: none; color: #fff;
            transition: transform 0.2s, opacity 0.2s;
        }
        .social-btn:hover { transform: translateY(-2px); opacity: 0.9; }

        /* Grid info */
        .info-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 1px; background: rgba(201,168,76,.1);
        }

        .info-cell {
            background: var(--dark-100);
            padding: 1.1rem 1.25rem;
        }

        .sidebar-stack { display: flex; flex-direction: column; gap: 1.25rem; }
        .main-stack { display: flex; flex-direction: column; gap: 1.25rem; }

        /* Gold divider */
        .gold-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            margin: 0;
        }

        /* Loading */
        .lux-spinner {
            width: 44px; height: 44px;
            border: 2px solid rgba(201,168,76,.2);
            border-top-color: var(--gold-primary);
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loading-wrap {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            min-height: 60vh; gap: 1rem;
        }

        .loading-text {
            font-family: var(--font-serif);
            font-size: 1.1rem; color: var(--dark-600); letter-spacing: 0.1em;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-0); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,.25); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,.5); }

        /* Responsive */
        @media (max-width: 900px) {
            .content-wrap { grid-template-columns: 1fr; }
            .hero-inner { flex-direction: column; align-items: flex-start; }
            .hero-stats { width: 100%; }
        }

        @media (max-width: 600px) {
            .lux-header-inner { padding: 0 1rem; }
            .profile-hero { padding: 2rem 1rem 0; }
            .content-wrap { padding: 1.5rem 1rem 3rem; }
            .hero-stats { gap: 0.6rem; }
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="lux-header">
        <div class="lux-header-inner">
            <a href="/" class="lux-logo">
                <div class="lux-logo-icon"><i class="fas fa-globe"></i></div>
                <div>
                    <span class="lux-logo-text">Travel Express</span>
                    <span class="lux-logo-sub">Study Abroad</span>
                </div>
            </a>

            <div class="lux-nav-actions">
                <a href="/" class="btn-ghost" style="display:none;align-items:center;gap:0.4rem;" id="btn-back">
                    <i class="fas fa-arrow-left" style="font-size:0.75rem;"></i> Retour
                </a>
                <a href="/profile/edit" class="btn-gold">
                    <i class="fas fa-pen-to-square" style="font-size:0.75rem;"></i> Modifier
                </a>
                <button onclick="doLogout()" class="btn-ghost">
                    <i class="fas fa-right-from-bracket" style="font-size:0.75rem;"></i>
                    <span class="hidden sm:inline">Déconnexion</span>
                </button>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="lux-main">
        <div id="loading-screen" class="loading-wrap">
            <div class="lux-spinner"></div>
            <p class="loading-text">Chargement du profil…</p>
        </div>

        <div id="profile-root" style="display:none;">
            <!-- Profile hero (populated by JS) -->
            <div id="profile-hero-wrap"></div>

            <!-- Content grid -->
            <div class="content-wrap">
                <div class="sidebar-stack" id="sidebar-col"></div>
                <div class="main-stack" id="main-col"></div>
            </div>
        </div>
    </main>

    <script>
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) window.location.href = '/login';

        document.getElementById('btn-back').style.display = 'inline-flex';

        function doLogout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/';
        }

        function esc(str) {
            if (!str) return '';
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        async function loadProfile() {
            try {
                const res = await fetch('/api/profile', {
                    headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
                });
                if (res.status === 401) {
                    localStorage.removeItem('auth_token');
                    window.location.href = '/login';
                    return;
                }
                const data = await res.json();
                if (data.data) render(data.data);
            } catch (e) {
                console.error(e);
            }
        }

        function render(u) {
            document.getElementById('loading-screen').style.display = 'none';
            document.getElementById('profile-root').style.display = 'block';

            const initials = u.name
                ? u.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2)
                : '?';

            const avatarHtml = u.avatar
                ? `<img src="${u.avatar.startsWith('http') ? u.avatar : '/storage/' + u.avatar}"
                         alt="${esc(u.name)}"
                         style="width:100%;height:100%;object-fit:cover;">`
                : `<span class="avatar-initials">${esc(initials)}</span>`;

            // Completion calc
            const fields = ['name','email','phone','bio','country','whatsapp','date_of_birth','gender','nationality','language','interests','linkedin','twitter','instagram','company','position','location','website'];
            const filled = fields.filter(f => u[f] && u[f] !== '').length;
            const pct = Math.round((filled / fields.length) * 100);

            const interests = u.interests ? u.interests.split(',').map(i => i.trim()).filter(i => i) : [];

            // ── HERO ──
            document.getElementById('profile-hero-wrap').innerHTML = `
                <div class="profile-hero">
                    <div class="hero-bg-decor"></div>
                    <div class="hero-inner">
                        <div class="avatar-ring">
                            <div class="avatar-inner">${avatarHtml}</div>
                            <div class="avatar-status"></div>
                        </div>

                        <div class="hero-info">
                            <h1 class="hero-title">${esc(u.name)}</h1>
                            ${u.position ? `<p class="hero-subtitle">${esc(u.position)}</p>` : ''}
                            ${u.location ? `<p class="hero-location"><i class="fas fa-location-dot" style="color:var(--gold-primary);font-size:0.7rem;"></i>${esc(u.location)}</p>` : ''}
                        </div>

                        <div class="hero-stats">
                            <div class="stat-pill">
                                <span class="stat-value">${filled}</span>
                                <span class="stat-label">Infos</span>
                            </div>
                            ${interests.length > 0 ? `
                            <div class="stat-pill">
                                <span class="stat-value">${interests.length}</span>
                                <span class="stat-label">Intérêts</span>
                            </div>` : ''}
                            <div class="stat-pill">
                                <span class="stat-value" style="color:${pct === 100 ? 'var(--color-success)' : 'var(--gold-primary)'};">${pct}%</span>
                                <span class="stat-label">Profil</span>
                            </div>
                        </div>
                    </div>
                    <div class="gold-line"></div>
                </div>
            `;

            // ── SIDEBAR ──
            let sidebar = '';

            // Completion card
            sidebar += `
                <div class="lux-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-chart-pie"></i></div>
                        <span class="card-title">Complétude</span>
                    </div>
                    <div class="card-body">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
                            <span style="font-size:0.82rem;color:var(--dark-600);">Profil rempli</span>
                            <span style="font-family:var(--font-serif);font-size:1.5rem;font-weight:700;color:var(--gold-primary);">${pct}%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" id="prog-bar" style="width:0%"></div>
                        </div>
                        ${pct < 100 ? `<p style="font-size:0.78rem;color:var(--dark-600);margin-top:0.75rem;">
                            <a href="/profile/edit" style="color:var(--gold-primary);text-decoration:none;font-weight:700;">Compléter le profil →</a>
                        </p>` : `<p style="font-size:0.78rem;color:var(--color-success);margin-top:0.75rem;display:flex;align-items:center;gap:0.4rem;"><i class="fas fa-check-circle"></i> Profil complet</p>`}
                    </div>
                </div>
            `;

            // Contact card
            sidebar += `
                <div class="lux-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-address-card"></i></div>
                        <span class="card-title">Contact</span>
                    </div>
                    <div class="card-body" style="padding-top:0.5rem;padding-bottom:0.5rem;">
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <div class="info-label">Email</div>
                                <div class="info-value"><a href="mailto:${esc(u.email)}">${esc(u.email)}</a></div>
                            </div>
                        </div>
                        ${u.phone ? `
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <div class="info-label">Téléphone</div>
                                <div class="info-value"><a href="tel:${esc(u.phone)}">${esc(u.phone)}</a></div>
                            </div>
                        </div>` : ''}
                        ${u.whatsapp ? `
                        <div class="info-row">
                            <div class="info-icon"><i class="fab fa-whatsapp" style="color:#25D366;"></i></div>
                            <div>
                                <div class="info-label">WhatsApp</div>
                                <div class="info-value"><a href="https://wa.me/${u.whatsapp.replace(/[^0-9]/g,'')}" target="_blank">${esc(u.whatsapp)}</a></div>
                            </div>
                        </div>` : ''}
                    </div>
                </div>
            `;

            // Social
            if (u.linkedin || u.twitter || u.instagram) {
                sidebar += `
                    <div class="lux-card">
                        <div class="card-header">
                            <div class="card-icon"><i class="fas fa-share-nodes"></i></div>
                            <span class="card-title">Réseaux</span>
                        </div>
                        <div class="card-body" style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                            ${u.linkedin ? `<a href="${esc(u.linkedin)}" target="_blank" class="social-btn" style="background:#0A66C2;"><i class="fab fa-linkedin-in"></i></a>` : ''}
                            ${u.twitter ? `<a href="${esc(u.twitter)}" target="_blank" class="social-btn" style="background:#1DA1F2;"><i class="fab fa-twitter"></i></a>` : ''}
                            ${u.instagram ? `<a href="${esc(u.instagram)}" target="_blank" class="social-btn" style="background:linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);"><i class="fab fa-instagram"></i></a>` : ''}
                        </div>
                    </div>
                `;
            }

            // ── MAIN COL ──
            let main = '';

            // Bio
            if (u.bio) {
                main += `
                    <div class="lux-card">
                        <div class="card-header">
                            <div class="card-icon"><i class="fas fa-feather-pointed"></i></div>
                            <span class="card-title">À propos</span>
                        </div>
                        <div class="card-body">
                            <p class="bio-text">${esc(u.bio)}</p>
                        </div>
                    </div>
                `;
            }

            // Interests
            if (interests.length > 0) {
                main += `
                    <div class="lux-card">
                        <div class="card-header">
                            <div class="card-icon"><i class="fas fa-sparkles" style="color:var(--gold-primary);"></i></div>
                            <span class="card-title">Centres d'intérêt</span>
                        </div>
                        <div class="card-body" style="display:flex;flex-wrap:wrap;gap:0.5rem;">
                            ${interests.map(i => `<span class="tag">${esc(i)}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            // Personal info
            const personalItems = [
                u.country         && { icon:'fa-globe',           label:'Pays',             val: u.country },
                u.nationality     && { icon:'fa-flag',            label:'Nationalité',      val: u.nationality },
                u.date_of_birth   && { icon:'fa-cake-candles',    label:'Date de naissance',val: new Date(u.date_of_birth).toLocaleDateString('fr-FR',{day:'numeric',month:'long',year:'numeric'}) },
                u.gender          && { icon:'fa-venus-mars',      label:'Genre',            val: u.gender==='male'?'Homme':u.gender==='female'?'Femme':'Autre' },
                u.language        && { icon:'fa-language',        label:'Langue',           val: u.language.toUpperCase() },
                u.passport_number && { icon:'fa-passport',        label:'Passeport',        val: u.passport_number },
            ].filter(Boolean);

            if (personalItems.length > 0) {
                main += `
                    <div class="lux-card">
                        <div class="card-header">
                            <div class="card-icon"><i class="fas fa-id-card"></i></div>
                            <span class="card-title">Informations personnelles</span>
                        </div>
                        <div class="info-grid">
                            ${personalItems.map(item => `
                            <div class="info-cell">
                                <div class="info-label" style="margin-bottom:0.3rem;">${esc(item.label)}</div>
                                <div class="info-value">${esc(item.val)}</div>
                            </div>`).join('')}
                        </div>
                    </div>
                `;
            }

            // Professional
            if (u.company || u.position || u.website) {
                const proItems = [
                    u.company  && { icon:'fa-building',  label:'Organisation', val: u.company },
                    u.position && { icon:'fa-user-tie',  label:'Poste',        val: u.position },
                    u.website  && { icon:'fa-link',      label:'Site web',     val: u.website, link: u.website },
                ].filter(Boolean);

                main += `
                    <div class="lux-card">
                        <div class="card-header">
                            <div class="card-icon"><i class="fas fa-briefcase"></i></div>
                            <span class="card-title">Informations professionnelles</span>
                        </div>
                        <div class="info-grid">
                            ${proItems.map(item => `
                            <div class="info-cell">
                                <div class="info-label" style="margin-bottom:0.3rem;">${esc(item.label)}</div>
                                <div class="info-value">${item.link ? `<a href="${esc(item.link)}" target="_blank">${esc(item.val)}</a>` : esc(item.val)}</div>
                            </div>`).join('')}
                        </div>
                    </div>
                `;
            }

            // Quick actions card
            main += `
                <div class="lux-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-bolt"></i></div>
                        <span class="card-title">Actions rapides</span>
                    </div>
                    <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                        <a href="/profile/edit" class="btn-gold" style="justify-content:center;padding:0.75rem;">
                            <i class="fas fa-pen-to-square"></i> Modifier le profil
                        </a>
                        <a href="/mon-dossier" class="btn-ghost" style="justify-content:center;padding:0.75rem;">
                            <i class="fas fa-folder-open"></i> Mon dossier
                        </a>
                        <a href="/" class="btn-ghost" style="justify-content:center;padding:0.75rem;">
                            <i class="fas fa-house"></i> Accueil
                        </a>
                        <button onclick="doLogout()" class="btn-ghost" style="justify-content:center;padding:0.75rem;">
                            <i class="fas fa-right-from-bracket"></i> Déconnexion
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('sidebar-col').innerHTML = sidebar;
            document.getElementById('main-col').innerHTML = main;

            // Animate progress bar
            setTimeout(() => {
                const bar = document.getElementById('prog-bar');
                if (bar) bar.style.width = pct + '%';
            }, 200);
        }

        loadProfile();
    </script>
</body>
</html>

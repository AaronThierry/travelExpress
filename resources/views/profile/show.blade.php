<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Profil — Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C85A;
            --gold-dim: #8B6914;
            --black: #0a0a0a;
            --surface: #111111;
            --surface2: #1a1a1a;
            --border: rgba(201,168,76,0.15);
            --border-strong: rgba(201,168,76,0.35);
            --text-primary: #f5f0e8;
            --text-muted: rgba(245,240,232,0.55);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--black);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Grain overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* Header */
        .lux-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            background: rgba(10,10,10,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-strong);
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
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .lux-logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dim));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #000;
        }

        .lux-logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: 0.02em;
        }

        .lux-logo-sub {
            font-family: 'Outfit', sans-serif;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            display: block;
            margin-top: -2px;
        }

        .lux-nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.25rem;
            background: linear-gradient(135deg, var(--gold), var(--gold-dim));
            color: #000;
            border: none;
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
        }

        .btn-gold:hover { opacity: 0.9; transform: translateY(-1px); }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.25rem;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-strong);
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* Main layout */
        .lux-main {
            position: relative;
            z-index: 1;
            padding-top: 70px;
        }

        /* Hero banner */
        .profile-hero {
            position: relative;
            background: linear-gradient(180deg, #111 0%, var(--black) 100%);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
            padding: 3rem 2rem 0;
        }

        .profile-hero::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .hero-bg-decor {
            position: absolute;
            top: -60px;
            right: -60px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(201,168,76,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: flex-end;
            gap: 2.5rem;
            padding-bottom: 2.5rem;
        }

        /* Avatar ring */
        .avatar-ring {
            position: relative;
            flex-shrink: 0;
        }

        .avatar-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), transparent, var(--gold));
            z-index: 0;
        }

        .avatar-inner {
            position: relative;
            z-index: 1;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--surface2);
            border: 3px solid var(--black);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-initials {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--gold);
        }

        .avatar-status {
            position: absolute;
            bottom: 6px;
            right: 6px;
            width: 18px;
            height: 18px;
            background: #22c55e;
            border-radius: 50%;
            border: 2px solid var(--black);
            z-index: 2;
        }

        .hero-info { flex: 1; }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: 0.01em;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 0.9rem;
            color: var(--gold);
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 0.4rem;
        }

        .hero-location {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
        }

        .hero-stats {
            display: flex;
            gap: 1rem;
            flex-shrink: 0;
        }

        .stat-pill {
            text-align: center;
            padding: 0.75rem 1.25rem;
            background: rgba(201,168,76,0.08);
            border: 1px solid var(--border-strong);
            border-radius: 12px;
        }

        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
            display: block;
        }

        .stat-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
            display: block;
            margin-top: 0.25rem;
        }

        /* Content layout */
        .content-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 1.75rem;
        }

        /* Cards */
        .lux-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(201,168,76,0.12);
            border: 1px solid var(--border-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 0.85rem;
        }

        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-primary);
        }

        .card-body { padding: 1.5rem; }

        /* Progress bar */
        .progress-track {
            height: 4px;
            background: rgba(255,255,255,0.07);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--gold-dim), var(--gold));
            border-radius: 4px;
            transition: width 1s cubic-bezier(0.4,0,0.2,1);
        }

        /* Info rows */
        .info-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }

        .info-row:last-child { border-bottom: none; }

        .info-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(201,168,76,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .info-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .info-value {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
            word-break: break-word;
        }

        .info-value a {
            color: var(--gold);
            text-decoration: none;
        }

        .info-value a:hover { text-decoration: underline; }

        /* Bio */
        .bio-text {
            font-size: 0.9rem;
            line-height: 1.8;
            color: rgba(245,240,232,0.75);
            font-weight: 300;
        }

        /* Tags */
        .tag {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            background: rgba(201,168,76,0.08);
            border: 1px solid var(--border-strong);
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-primary);
            transition: all 0.2s;
        }

        .tag:hover {
            background: rgba(201,168,76,0.2);
            color: var(--gold);
        }

        /* Social buttons */
        .social-btn {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            text-decoration: none;
            color: #fff;
            transition: transform 0.2s, opacity 0.2s;
        }

        .social-btn:hover { transform: translateY(-2px); opacity: 0.9; }

        /* Grid info */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            background: var(--border);
        }

        .info-cell {
            background: var(--surface);
            padding: 1.1rem 1.25rem;
        }

        .sidebar-stack { display: flex; flex-direction: column; gap: 1.25rem; }
        .main-stack { display: flex; flex-direction: column; gap: 1.25rem; }

        /* Gold divider */
        .gold-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 0;
        }

        /* Loading */
        .lux-spinner {
            width: 44px;
            height: 44px;
            border: 2px solid rgba(201,168,76,0.2);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loading-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            gap: 1rem;
        }

        .loading-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            color: var(--text-muted);
            letter-spacing: 0.1em;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .content-wrap {
                grid-template-columns: 1fr;
            }
            .hero-inner {
                flex-direction: column;
                align-items: flex-start;
            }
            .hero-stats {
                width: 100%;
            }
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
                            ${u.location ? `<p class="hero-location"><i class="fas fa-location-dot" style="color:var(--gold);font-size:0.7rem;"></i>${esc(u.location)}</p>` : ''}
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
                                <span class="stat-value" style="color:${pct === 100 ? '#22c55e' : 'var(--gold)'};">${pct}%</span>
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
                            <span style="font-size:0.82rem;color:var(--text-muted);">Profil rempli</span>
                            <span style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:700;color:var(--gold);">${pct}%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" id="prog-bar" style="width:0%"></div>
                        </div>
                        ${pct < 100 ? `<p style="font-size:0.78rem;color:var(--text-muted);margin-top:0.75rem;">
                            <a href="/profile/edit" style="color:var(--gold);text-decoration:none;font-weight:500;">Compléter le profil →</a>
                        </p>` : `<p style="font-size:0.78rem;color:#22c55e;margin-top:0.75rem;display:flex;align-items:center;gap:0.4rem;"><i class="fas fa-check-circle"></i> Profil complet</p>`}
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
                            <div class="card-icon"><i class="fas fa-sparkles" style="color:var(--gold);"></i></div>
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
                    u.company  && { icon:'fa-building',     label:'Organisation', val: u.company },
                    u.position && { icon:'fa-user-tie',     label:'Poste',        val: u.position },
                    u.website  && { icon:'fa-link',         label:'Site web',     val: u.website, link: u.website },
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

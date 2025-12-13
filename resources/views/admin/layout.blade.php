<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Travel Express Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Typographie élégante */
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }

        h1, h2, h3, .font-heading {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.02em;
        }

        /* Sidebar élégant */
        .sidebar {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        }

        /* Navigation élégante */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #94a3b8;
            border-radius: 0.625rem;
            margin: 0.25rem 0;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #e2e8f0;
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.1));
            color: white;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 3px;
            background: linear-gradient(180deg, #818cf8, #6366f1);
            border-radius: 0 3px 3px 0;
        }

        /* Header glass effect */
        .header-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Cards élégantes - Style premium */
        .elegant-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 1.25rem;
            border: 1px solid rgba(226, 232, 240, 0.6);
            box-shadow:
                0 1px 2px rgba(0, 0, 0, 0.02),
                0 4px 12px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .elegant-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .elegant-card:hover {
            box-shadow:
                0 4px 6px rgba(0, 0, 0, 0.02),
                0 12px 40px rgba(99, 102, 241, 0.08),
                0 0 0 1px rgba(99, 102, 241, 0.1);
            transform: translateY(-4px);
        }

        .elegant-card:hover::before {
            opacity: 1;
        }

        /* Stats card avec accent coloré */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color, #6366f1), var(--accent-end, #818cf8));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover::after {
            transform: scaleX(1);
        }

        /* Decorative glow effect */
        .stat-card .glow {
            position: absolute;
            top: -50%;
            right: -20%;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, var(--accent-color, #6366f1) 0%, transparent 70%);
            opacity: 0.04;
            border-radius: 50%;
            transition: opacity 0.4s ease;
        }

        .stat-card:hover .glow {
            opacity: 0.08;
        }

        .stat-card.accent-blue { --accent-color: #3b82f6; --accent-end: #60a5fa; }
        .stat-card.accent-green { --accent-color: #10b981; --accent-end: #34d399; }
        .stat-card.accent-amber { --accent-color: #f59e0b; --accent-end: #fbbf24; }
        .stat-card.accent-violet { --accent-color: #8b5cf6; --accent-end: #a78bfa; }

        /* Icon containers avec effet moderne */
        .icon-container {
            position: relative;
            transition: transform 0.3s ease;
        }

        .stat-card:hover .icon-container {
            transform: scale(1.1);
        }

        .icon-container::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 14px;
            background: inherit;
            opacity: 0.25;
            filter: blur(10px);
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover .icon-container::after {
            opacity: 0.4;
        }

        /* Stat value animation */
        .stat-value {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Section headers */
        .section-header {
            position: relative;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 1.25rem;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, transparent);
        }

        /* Scrollbar élégant */
        .elegant-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .elegant-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .elegant-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }

        .elegant-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        @media (max-width: 1023px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar-mobile.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">
    <div class="min-h-screen flex">
        <!-- Overlay mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-mobile lg:translate-x-0 w-64 sidebar fixed h-full z-40 flex flex-col">
            <!-- Logo -->
            <div class="p-5 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white font-semibold">Travel Express</h1>
                        <p class="text-slate-400 text-xs">Administration</p>
                    </div>
                    <button onclick="toggleSidebar()" class="lg:hidden ml-auto p-1.5 text-slate-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-wider mb-3 px-1">Menu</p>

                <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                    </svg>
                    Tableau de bord
                </a>

                <a href="/admin/users" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Utilisateurs
                </a>

                <a href="/admin/testimonials" class="nav-link {{ request()->is('admin/testimonials') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Témoignages
                    <span id="pending-badge" class="ml-auto bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full hidden">0</span>
                </a>

                <a href="/admin/contact-requests" class="nav-link {{ request()->is('admin/contact-requests') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Demandes
                    <span id="requests-badge" class="ml-auto bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full hidden">0</span>
                </a>
            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-slate-700/50">
                <a href="/" target="_blank" class="nav-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Voir le site
                </a>
                <button onclick="logout()" class="nav-link w-full text-red-400 hover:text-red-300 hover:bg-red-500/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Déconnexion
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="header-glass border-b border-slate-200/80 sticky top-0 z-20">
                <div class="px-4 sm:px-6 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <h1 class="text-lg font-semibold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span id="notif-dot" class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full hidden"></span>
                            </button>

                            <div class="flex items-center gap-2">
                                <div class="hidden sm:block text-right">
                                    <p class="text-sm font-medium text-slate-900" id="user-name">Admin</p>
                                    <p class="text-xs text-slate-500">Administrateur</p>
                                </div>
                                <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm" id="user-initial">A</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 sm:p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        function closeMobile() {
            if (window.innerWidth < 1024) {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebar-overlay').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        let authToken = localStorage.getItem('auth_token');
        const tokenExpiresAt = localStorage.getItem('token_expires_at');

        function isTokenExpired() {
            if (!tokenExpiresAt) return true;
            return new Date(tokenExpiresAt) < new Date();
        }

        function clearAuthData() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            localStorage.removeItem('token_expires_at');
            localStorage.removeItem('is_admin');
        }

        if (!authToken || isTokenExpired()) {
            clearAuthData();
            window.location.href = '/login';
        }

        async function loadUserInfo() {
            try {
                const response = await fetch('/api/verify', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Non authentifié');

                const data = await response.json();
                const user = data.data.user;

                document.getElementById('user-name').textContent = user.name;
                document.getElementById('user-initial').textContent = user.name.charAt(0).toUpperCase();

                if (!data.data.is_admin) {
                    alert('Accès non autorisé');
                    clearAuthData();
                    window.location.href = '/';
                }
            } catch (error) {
                clearAuthData();
                window.location.href = '/login';
            }
        }

        async function loadPendingCount() {
            try {
                const response = await fetch('/api/admin/testimonials/pending', {
                    headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
                });
                if (response.ok) {
                    const result = await response.json();
                    const count = result.data.length;
                    const badge = document.getElementById('pending-badge');
                    if (count > 0) {
                        badge.textContent = count;
                        badge.classList.remove('hidden');
                        document.getElementById('notif-dot').classList.remove('hidden');
                    }
                }
            } catch (e) {}
        }

        async function loadNewRequestsCount() {
            try {
                const response = await fetch('/api/admin/contact-requests/stats', {
                    headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
                });
                if (response.ok) {
                    const result = await response.json();
                    const count = result.data.by_status.new;
                    const badge = document.getElementById('requests-badge');
                    if (count > 0) {
                        badge.textContent = count;
                        badge.classList.remove('hidden');
                        document.getElementById('notif-dot').classList.remove('hidden');
                    }
                }
            } catch (e) {}
        }

        async function logout() {
            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
                });
            } catch (e) {}
            clearAuthData();
            window.location.href = '/login';
        }

        loadUserInfo();
        loadPendingCount();
        loadNewRequestsCount();
    </script>

    @yield('scripts')
</body>
</html>

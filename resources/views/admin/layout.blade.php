<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Travel Express Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Modern Typography */
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, .font-heading {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.03em;
        }

        /* Premium Sidebar with Gradient */
        .sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.12);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: radial-gradient(circle at top center, rgba(99, 102, 241, 0.15), transparent);
            pointer-events: none;
        }

        /* Modern Navigation Links */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1rem;
            color: #94a3b8;
            border-radius: 0.75rem;
            margin: 0.25rem 0;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.05));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
            transform: translateX(4px);
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            right: 1rem;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
        }

        /* Glass Header Effect */
        .header-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }

        /* Ultra-Premium Cards */
        .elegant-card {
            background: linear-gradient(145deg, #ffffff 0%, #fafbfc 100%);
            border-radius: 1.5rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.02),
                0 8px 16px rgba(0, 0, 0, 0.04),
                0 16px 32px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .elegant-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.04) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .elegant-card:hover {
            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.03),
                0 12px 24px rgba(99, 102, 241, 0.12),
                0 0 0 1px rgba(99, 102, 241, 0.15);
            transform: translateY(-6px);
        }

        .elegant-card:hover::before {
            opacity: 1;
        }

        /* Stat Cards with Enhanced Gradient */
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
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover::after {
            transform: scaleX(1);
        }

        .stat-card .glow {
            position: absolute;
            top: -50%;
            right: -20%;
            width: 140px;
            height: 140px;
            background: radial-gradient(circle, var(--accent-color, #6366f1) 0%, transparent 70%);
            opacity: 0.05;
            border-radius: 50%;
            transition: opacity 0.4s ease;
        }

        .stat-card:hover .glow {
            opacity: 0.12;
        }

        .stat-card.accent-blue { --accent-color: #3b82f6; --accent-end: #60a5fa; }
        .stat-card.accent-green { --accent-color: #10b981; --accent-end: #34d399; }
        .stat-card.accent-amber { --accent-color: #f59e0b; --accent-end: #fbbf24; }
        .stat-card.accent-violet { --accent-color: #8b5cf6; --accent-end: #a78bfa; }
        .stat-card.accent-rose { --accent-color: #f43f5e; --accent-end: #fb7185; }
        .stat-card.accent-emerald { --accent-color: #059669; --accent-end: #10b981; }

        /* Premium Icon Containers */
        .icon-container {
            position: relative;
            z-index: 1;
        }

        /* Animated Stat Values */
        .stat-value {
            font-variant-numeric: tabular-nums;
            transition: all 0.3s ease;
        }

        /* Section Headers */
        .section-header {
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.8) 0%, transparent 100%);
        }

        /* Elegant Scroll */
        .elegant-scroll::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .elegant-scroll::-webkit-scrollbar-track {
            background: rgba(241, 245, 249, 0.5);
            border-radius: 4px;
        }

        .elegant-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #cbd5e1, #94a3b8);
            border-radius: 4px;
            transition: background 0.3s;
        }

        .elegant-scroll::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #94a3b8, #64748b);
        }

        /* Badge Animations */
        @keyframes pulse-badge {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .nav-link span[id$="-badge"]:not(.hidden) {
            animation: pulse-badge 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Mobile Sidebar Animation */
        @media (max-width: 1023px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar-mobile.open {
                transform: translateX(0);
            }
        }

        /* Page Background Pattern */
        body {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 40% 20%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(139, 92, 246, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(236, 72, 153, 0.03) 0px, transparent 50%);
        }

        /* Notification Dot Animation */
        @keyframes ping-dot {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        #notif-dot::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: inherit;
            animation: ping-dot 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* Logo Glow Effect */
        .logo-glow {
            position: relative;
        }

        .logo-glow::before {
            content: '';
            position: absolute;
            inset: -4px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: inherit;
            opacity: 0.3;
            blur: 12px;
            z-index: -1;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="min-h-screen flex">
        <!-- Overlay mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-30 lg:hidden hidden backdrop-blur-sm" onclick="toggleSidebar()"></div>

        <!-- Premium Sidebar -->
        <aside id="sidebar" class="sidebar-mobile lg:translate-x-0 w-72 sidebar fixed h-full z-40 flex flex-col">
            <!-- Logo Section -->
            <div class="p-6 border-b border-slate-700/40">
                <div class="flex items-center gap-3">
                    <div class="logo-glow w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-white font-bold text-lg">Travel Express</h1>
                        <p class="text-slate-400 text-xs font-medium">Admin Dashboard</p>
                    </div>
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 overflow-y-auto elegant-scroll">
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-4 px-2">Navigation</p>

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
                    <span id="pending-badge" class="ml-auto bg-amber-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-lg hidden">0</span>
                </a>

                <a href="/admin/contact-requests" class="nav-link {{ request()->is('admin/contact-requests') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Demandes
                    <span id="requests-badge" class="ml-auto bg-emerald-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-lg hidden">0</span>
                </a>

                <a href="/admin/evaluations" class="nav-link {{ request()->is('admin/evaluations') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Évaluations
                    <span id="evaluations-badge" class="ml-auto bg-teal-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-lg hidden">0</span>
                </a>

                <a href="/admin/student-applications" class="nav-link {{ request()->is('admin/student-applications') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Dossiers étudiants
                    <span id="applications-badge" class="ml-auto bg-purple-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-lg hidden">0</span>
                </a>
            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-slate-700/40 space-y-2">
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
        <main class="flex-1 lg:ml-72 min-h-screen">
            <!-- Premium Header -->
            <header class="header-glass sticky top-0 z-20 shadow-sm">
                <div class="px-4 sm:px-8 py-5">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <button onclick="toggleSidebar()" class="lg:hidden p-2.5 text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h1 class="text-2xl font-bold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                                <p class="text-sm text-slate-500 mt-0.5">Bienvenue dans votre espace d'administration</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="relative p-2.5 text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span id="notif-dot" class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full hidden"></span>
                            </button>

                            <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                                <div class="hidden sm:block text-right">
                                    <p class="text-sm font-bold text-slate-900" id="user-name">Administrateur</p>
                                    <p class="text-xs text-slate-500 font-medium">Admin</p>
                                </div>
                                <div class="w-11 h-11 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-sm" id="user-initial">A</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 sm:p-8">
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

        // Make authToken globally accessible
        window.authToken = localStorage.getItem('auth_token');
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

        if (!window.authToken || isTokenExpired()) {
            clearAuthData();
            window.location.href = '/login';
        }

        // Load user info
        const user = JSON.parse(localStorage.getItem('user') || '{}');
        if (user.name) {
            document.getElementById('user-name').textContent = user.name;
            document.getElementById('user-initial').textContent = user.name.charAt(0).toUpperCase();
        }

        // Logout function
        async function logout() {
            if (!confirm('Êtes-vous sûr de vouloir vous déconnecter?')) return;

            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${window.authToken}`,
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.error('Logout error:', error);
            } finally {
                clearAuthData();
                window.location.href = '/login';
            }
        }

        // Auto-refresh token before expiry
        function scheduleTokenRefresh() {
            if (!tokenExpiresAt) return;

            const expiryTime = new Date(tokenExpiresAt).getTime();
            const currentTime = new Date().getTime();
            const timeUntilExpiry = expiryTime - currentTime;
            const refreshTime = timeUntilExpiry - (5 * 60 * 1000); // 5 minutes before expiry

            if (refreshTime > 0) {
                setTimeout(async () => {
                    try {
                        const response = await fetch('/api/refresh', {
                            method: 'POST',
                            headers: {
                                'Authorization': `Bearer ${window.authToken}`,
                                'Accept': 'application/json'
                            }
                        });

                        if (response.ok) {
                            const data = await response.json();
                            localStorage.setItem('auth_token', data.access_token);
                            window.authToken = data.access_token;
                            const newExpiry = new Date(new Date().getTime() + (60 * 60 * 1000));
                            localStorage.setItem('token_expires_at', newExpiry.toISOString());
                            scheduleTokenRefresh();
                        }
                    } catch (error) {
                        console.error('Token refresh error:', error);
                    }
                }, refreshTime);
            }
        }

        scheduleTokenRefresh();
    </script>

    @yield('scripts')
</body>
</html>

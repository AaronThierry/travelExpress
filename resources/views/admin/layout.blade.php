<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Travel Express Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', system-ui, sans-serif; }

        .sidebar {
            background: #0f172a;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #94a3b8;
            border-radius: 0.5rem;
            margin: 0.25rem 0;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #f1f5f9;
        }

        .nav-link.active {
            background: rgba(99, 102, 241, 0.15);
            color: white;
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

                <div class="my-4 border-t border-slate-700/50"></div>

                <a href="/admin/settings" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}" onclick="closeMobile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Paramètres
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
            <header class="bg-white border-b border-slate-200 sticky top-0 z-20">
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

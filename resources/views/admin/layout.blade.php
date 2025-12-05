<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Travel Express</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }

        .sidebar-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1.25rem;
            color: #94a3b8;
            transition: all 0.2s ease;
            border-radius: 0.75rem;
            margin: 0.25rem 0.75rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #f1f5f9;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .nav-item.active svg {
            color: white;
        }

        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-slate-50">
    <div class="min-h-screen flex">
        <!-- Sidebar - Professional Dark Theme -->
        <aside class="w-72 sidebar-gradient fixed h-full shadow-2xl z-20 flex flex-col">
            <!-- Logo Section -->
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Travel Express</h1>
                        <p class="text-xs text-slate-400">Administration</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 mt-2 px-2 overflow-y-auto scrollbar-thin">
                <p class="px-4 py-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu principal</p>

                <a href="/admin/dashboard" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                    </svg>
                    <span>Tableau de bord</span>
                </a>

                <a href="/admin/users" class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Utilisateurs</span>
                </a>

                <a href="/admin/testimonials" class="nav-item {{ request()->is('admin/testimonials') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Témoignages</span>
                    <span id="pending-badge" class="ml-auto bg-amber-500 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">0</span>
                </a>

                <p class="px-4 py-2 mt-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Configuration</p>

                <a href="/admin/settings" class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Paramètres</span>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-slate-700/50">
                <a href="/" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-colors mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="text-sm font-medium">Voir le site</span>
                </a>

                <button onclick="logout()" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="text-sm font-medium">Déconnexion</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72">
            <!-- Top Header -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-10">
                <div class="px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                                <a href="/admin/dashboard" class="hover:text-indigo-600">Admin</a>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span class="text-slate-700 font-medium">@yield('title')</span>
                            </div>
                            <h1 class="text-2xl font-bold text-slate-900">@yield('page-title')</h1>
                        </div>

                        <div class="flex items-center gap-6">
                            <!-- Notifications -->
                            <button class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span id="notif-badge" class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full pulse-dot hidden"></span>
                            </button>

                            <!-- User Profile -->
                            <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-slate-900" id="user-name">Admin</p>
                                    <p class="text-xs text-slate-500">Administrateur</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-sm" id="user-initial">A</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="px-8 py-4 border-t border-slate-200 bg-white">
                <div class="flex items-center justify-between text-sm text-slate-500">
                    <p>&copy; {{ date('Y') }} Travel Express. Tous droits réservés.</p>
                    <p>Version 1.0.0</p>
                </div>
            </footer>
        </main>
    </div>

    <script>
        let authToken = localStorage.getItem('auth_token');

        // Check authentication
        if (!authToken) {
            window.location.href = '/login';
        }

        // Load user info
        async function loadUserInfo() {
            try {
                const response = await fetch('/api/user', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Non authentifié');
                }

                const data = await response.json();
                const user = data.data;

                document.getElementById('user-name').textContent = user.name;
                document.getElementById('user-initial').textContent = user.name.charAt(0).toUpperCase();

                // Check if user is admin
                if (!user.is_admin) {
                    alert('Accès non autorisé. Droits administrateur requis.');
                    setTimeout(() => window.location.href = '/', 3000);
                }
            } catch (error) {
                console.error('Error:', error);
                window.location.href = '/login';
            }
        }

        // Load pending testimonials count
        async function loadPendingCount() {
            try {
                const response = await fetch('/api/admin/testimonials/pending', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    const count = result.data.length;
                    const badge = document.getElementById('pending-badge');
                    const notifBadge = document.getElementById('notif-badge');

                    if (badge) {
                        badge.textContent = count;
                        if (count === 0) {
                            badge.classList.add('hidden');
                        } else {
                            badge.classList.remove('hidden');
                        }
                    }

                    if (notifBadge && count > 0) {
                        notifBadge.classList.remove('hidden');
                    }
                }
            } catch (error) {
                console.error('Error loading pending count:', error);
            }
        }

        // Logout
        function logout() {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        }

        // Initialize
        loadUserInfo();
        loadPendingCount();
    </script>

    @yield('scripts')
</body>
</html>

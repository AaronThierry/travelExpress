<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Travel Express</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg fixed h-full">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-primary-600">Travel Express</h1>
                <p class="text-sm text-gray-600 mt-1">Dashboard Admin</p>
            </div>

            <nav class="mt-6">
                <a href="/admin/dashboard" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Tableau de bord</span>
                </a>

                <a href="/admin/users" class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Utilisateurs</span>
                </a>

                <a href="/admin/testimonials" class="nav-item {{ request()->is('admin/testimonials') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <span>Témoignages</span>
                    <span id="pending-badge" class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded-full">0</span>
                </a>

                <div class="px-6 py-2 mt-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Paramètres</p>
                </div>

                <a href="/admin/settings" class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Paramètres</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 p-6 border-t border-gray-200">
                <a href="/" target="_blank" class="flex items-center gap-2 text-sm text-gray-600 hover:text-primary-600 transition-colors mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span>Voir le site</span>
                </a>
                <button onclick="logout()" class="flex items-center gap-2 text-sm text-red-600 hover:text-red-700 transition-colors w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title')</h1>
                            <p class="text-sm text-gray-600 mt-1">@yield('page-description')</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900" id="user-name"></p>
                                <p class="text-xs text-gray-600">Administrateur</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-primary-600 font-bold text-lg" id="user-initial">A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <style>
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: #6B7280;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background-color: #F3F4F6;
            color: #111827;
        }

        .nav-item.active {
            background-color: #EEF2FF;
            color: #4F46E5;
            border-left-color: #4F46E5;
            font-weight: 500;
        }
    </style>

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
                    if (badge) {
                        badge.textContent = count;
                        if (count === 0) {
                            badge.classList.add('hidden');
                        } else {
                            badge.classList.remove('hidden');
                        }
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

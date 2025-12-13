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

        /* Premium Sidebar Design */
        .sidebar-premium {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            position: relative;
        }

        .sidebar-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Navigation Items */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1.25rem;
            color: #94a3b8;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0.875rem;
            margin: 0.25rem 0.75rem;
            font-weight: 500;
            font-size: 0.875rem;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #6366f1, #8b5cf6);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 3px 3px 0;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #f1f5f9;
            transform: translateX(4px);
        }

        .nav-item:hover::before {
            transform: scaleY(1);
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.2) 100%);
            color: white;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }

        .nav-item.active svg {
            color: #a5b4fc;
        }

        /* Stat Cards Premium */
        .stat-card-premium {
            background: white;
            border-radius: 1.25rem;
            padding: 1.5rem;
            box-shadow:
                0 1px 3px rgba(0, 0, 0, 0.05),
                0 10px 30px -10px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            overflow: hidden;
        }

        .stat-card-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--card-accent, #6366f1), var(--card-accent-end, #8b5cf6));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card-premium:hover {
            transform: translateY(-6px);
            box-shadow:
                0 4px 6px rgba(0, 0, 0, 0.05),
                0 20px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .stat-card-premium:hover::before {
            opacity: 1;
        }

        /* Glass Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Badge Pulse */
        .badge-pulse {
            position: relative;
        }

        .badge-pulse::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            background: inherit;
            opacity: 0.4;
            animation: badge-ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes badge-ping {
            75%, 100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        /* Icon Container Premium */
        .icon-premium {
            position: relative;
        }

        .icon-premium::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: inherit;
            background: inherit;
            opacity: 0.3;
            filter: blur(8px);
            z-index: -1;
        }

        /* Progress Bar Animated */
        .progress-bar-animated {
            position: relative;
            overflow: hidden;
        }

        .progress-bar-animated::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Scrollbar Custom */
        .scrollbar-premium::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-premium::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-premium::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #475569, #334155);
            border-radius: 3px;
        }

        .scrollbar-premium::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #64748b, #475569);
        }

        /* Mobile Sidebar */
        .sidebar-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 1023px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar-mobile.active {
                transform: translateX(0);
            }
        }

        @media (min-width: 1024px) {
            .sidebar-mobile {
                transform: translateX(0);
            }
        }

        /* Header Premium */
        .header-premium {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Notification Dot */
        .notif-dot {
            animation: pulse-dot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.2); }
        }

        /* Card Hover Glow */
        .card-glow:hover {
            box-shadow: 0 0 40px -10px var(--glow-color, rgba(99, 102, 241, 0.4));
        }

        /* Animated Background */
        .animated-bg {
            position: relative;
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: bg-scroll 60s linear infinite;
        }

        @keyframes bg-scroll {
            0% { transform: translate(0, 0); }
            100% { transform: translate(30px, 30px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen">
    <div class="min-h-screen flex">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar - Premium Dark Theme -->
        <aside id="sidebar" class="sidebar-mobile lg:translate-x-0 w-72 lg:w-80 sidebar-premium fixed h-full shadow-2xl z-40 flex flex-col">
            <!-- Logo Section -->
            <div class="p-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/30 icon-premium">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl font-bold text-white tracking-tight">Travel Express</h1>
                        <p class="text-xs text-indigo-300/80 font-medium">Administration</p>
                    </div>
                    <!-- Close button mobile -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 mt-2 px-3 overflow-y-auto scrollbar-premium relative z-10">
                <p class="px-4 py-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Menu principal</p>

                <a href="/admin/dashboard" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}" onclick="closeSidebarMobile()">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500/20 to-indigo-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Tableau de bord</span>
                </a>

                <a href="/admin/users" class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}" onclick="closeSidebarMobile()">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500/20 to-teal-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Utilisateurs</span>
                </a>

                <a href="/admin/testimonials" class="nav-item {{ request()->is('admin/testimonials') ? 'active' : '' }}" onclick="closeSidebarMobile()">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500/20 to-orange-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium flex-1">Témoignages</span>
                    <span id="pending-badge" class="badge-pulse bg-gradient-to-r from-amber-500 to-orange-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-lg shadow-amber-500/30">0</span>
                </a>

                <a href="/admin/contact-requests" class="nav-item {{ request()->is('admin/contact-requests') ? 'active' : '' }}" onclick="closeSidebarMobile()">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium flex-1">Demandes</span>
                    <span id="requests-badge" class="badge-pulse bg-gradient-to-r from-green-500 to-emerald-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-lg shadow-green-500/30">0</span>
                </a>

                <div class="my-6 mx-4 h-px bg-gradient-to-r from-transparent via-slate-600/50 to-transparent"></div>

                <p class="px-4 py-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Configuration</p>

                <a href="/admin/settings" class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}" onclick="closeSidebarMobile()">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-500/20 to-slate-600/20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Paramètres</span>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-slate-700/30 relative z-10">
                <a href="/" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all group mb-2">
                    <div class="w-9 h-9 rounded-lg bg-slate-700/50 flex items-center justify-center group-hover:bg-indigo-500/20 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium">Voir le site</span>
                    <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>

                <button onclick="logout()" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition-all group">
                    <div class="w-9 h-9 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium">Déconnexion</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-80">
            <!-- Top Header -->
            <header class="header-premium sticky top-0 z-20">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <!-- Mobile menu button + Title -->
                        <div class="flex items-center gap-4 min-w-0">
                            <!-- Burger menu mobile -->
                            <button onclick="toggleSidebar()" class="lg:hidden p-2.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div class="min-w-0">
                                <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500 mb-1">
                                    <a href="/admin/dashboard" class="hover:text-indigo-600 transition-colors">Admin</a>
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <span class="text-slate-900 font-medium">@yield('title')</span>
                                </div>
                                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 truncate">@yield('page-title')</h1>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 sm:gap-4">
                            <!-- Search (Desktop) -->
                            <div class="hidden lg:flex items-center gap-2 px-4 py-2.5 bg-slate-100 rounded-xl w-64 focus-within:ring-2 focus-within:ring-indigo-500/50 focus-within:bg-white transition-all">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" placeholder="Rechercher..." class="bg-transparent border-none outline-none text-sm text-slate-700 placeholder-slate-400 w-full">
                            </div>

                            <!-- Notifications -->
                            <button class="relative p-2.5 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span id="notif-badge" class="notif-dot absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full hidden ring-2 ring-white"></span>
                            </button>

                            <!-- Divider -->
                            <div class="w-px h-8 bg-slate-200 hidden sm:block"></div>

                            <!-- User Profile -->
                            <div class="flex items-center gap-3">
                                <div class="hidden sm:block text-right">
                                    <p class="text-sm font-semibold text-slate-900" id="user-name">Admin</p>
                                    <p class="text-xs text-slate-500">Administrateur</p>
                                </div>
                                <div class="relative">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-indigo-500/30 ring-2 ring-white">
                                        <span class="text-white font-bold text-sm" id="user-initial">A</span>
                                    </div>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 sm:p-6 lg:p-8 animated-bg">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="px-4 sm:px-6 lg:px-8 py-4 border-t border-slate-200 bg-white/50 backdrop-blur-sm">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-slate-500">
                    <p>&copy; {{ date('Y') }} Travel Express. Tous droits réservés.</p>
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            Système opérationnel
                        </span>
                        <span>v2.0.0</span>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <script>
        // Mobile sidebar functions
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
        }

        function closeSidebarMobile() {
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Close sidebar on window resize if desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });

        let authToken = localStorage.getItem('auth_token');
        const tokenExpiresAt = localStorage.getItem('token_expires_at');

        // Check authentication and token expiration
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

        // Refresh token if expiring soon (less than 1 day remaining)
        async function checkAndRefreshToken() {
            if (!tokenExpiresAt) return;

            const expiresAt = new Date(tokenExpiresAt);
            const now = new Date();
            const hoursRemaining = (expiresAt - now) / (1000 * 60 * 60);

            if (hoursRemaining < 6 && hoursRemaining > 0) {
                try {
                    const response = await fetch('/api/refresh', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${authToken}`,
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        authToken = data.data.access_token;
                        localStorage.setItem('auth_token', data.data.access_token);
                        localStorage.setItem('token_expires_at', data.data.expires_at);
                        localStorage.setItem('user', JSON.stringify(data.data.user));
                    }
                } catch (error) {
                    console.error('Token refresh error:', error);
                }
            }
        }

        // Load user info
        async function loadUserInfo() {
            try {
                const response = await fetch('/api/verify', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Non authentifié');
                }

                const data = await response.json();
                const user = data.data.user;

                document.getElementById('user-name').textContent = user.name;
                document.getElementById('user-initial').textContent = user.name.charAt(0).toUpperCase();

                if (!data.data.is_admin) {
                    alert('Accès non autorisé. Droits administrateur requis.');
                    clearAuthData();
                    setTimeout(() => window.location.href = '/', 2000);
                }

                await checkAndRefreshToken();
            } catch (error) {
                console.error('Error:', error);
                clearAuthData();
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

        // Load new contact requests count
        async function loadNewRequestsCount() {
            try {
                const response = await fetch('/api/admin/contact-requests/stats', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    const count = result.data.by_status.new;
                    const badge = document.getElementById('requests-badge');
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
                console.error('Error loading requests count:', error);
            }
        }

        // Logout
        async function logout() {
            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
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

        // Initialize
        loadUserInfo();
        loadPendingCount();
        loadNewRequestsCount();
    </script>

    @yield('scripts')
</body>
</html>

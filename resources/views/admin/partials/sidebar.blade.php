<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 ease-out -translate-x-full lg:translate-x-0 sidebar-width">
    <!-- Glass Background -->
    <div class="absolute inset-0 bg-white/95 dark:bg-slate-900/98 backdrop-blur-xl border-r border-slate-200/80 dark:border-slate-700/50"></div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-indigo-500/10 via-purple-500/5 to-transparent pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-tr from-slate-100/50 dark:from-slate-800/50 to-transparent pointer-events-none"></div>

    <div class="relative h-full flex flex-col">
        <!-- Logo Section -->
        <div class="p-5 border-b border-slate-200/80 dark:border-slate-700/50">
            <div class="flex items-center justify-between gap-3">
                <a href="/" class="flex items-center gap-3 min-w-0 group">
                    <div class="relative flex-shrink-0">
                        <!-- Animated glow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl blur-lg opacity-40 group-hover:opacity-60 transition-opacity duration-500"></div>
                        <!-- Logo icon -->
                        <div class="relative w-11 h-11 bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/25 group-hover:shadow-indigo-500/40 transition-all duration-300 group-hover:scale-105">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="sidebar-text overflow-hidden transition-all duration-300">
                        <h1 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight truncate">Travel Express</h1>
                        <p class="text-[11px] font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider truncate">Admin Panel</p>
                    </div>
                </a>
                <button onclick="toggleSidebarCollapse()" class="hidden lg:flex p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-slate-800 rounded-lg transition-all duration-200 flex-shrink-0" title="Replier le menu">
                    <svg class="w-5 h-5 sidebar-collapse-icon transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Label -->
        <div class="px-5 pt-6 pb-2 sidebar-text">
            <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Navigation</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 pb-4 space-y-1 overflow-y-auto custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="nav-link group {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Tableau de bord">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Tableau de bord</span>
                <span class="nav-indicator"></span>
            </a>

            <a href="{{ route('admin.student-applications') }}" class="nav-link group {{ request()->routeIs('admin.student-applications') ? 'active' : '' }}" title="Dossiers Etudiants">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Dossiers Etudiants</span>
                <span class="nav-indicator"></span>
            </a>

            <a href="{{ route('admin.evaluations') }}" class="nav-link group {{ request()->routeIs('admin.evaluations') ? 'active' : '' }}" title="Evaluations">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Evaluations</span>
                <span class="nav-indicator"></span>
            </a>

            <a href="{{ route('admin.testimonials') }}" class="nav-link group {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}" title="Temoignages">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Temoignages</span>
                <span class="nav-indicator"></span>
            </a>

            <a href="{{ route('admin.contact-requests') }}" class="nav-link group {{ request()->routeIs('admin.contact-requests') ? 'active' : '' }}" title="Demandes de contact">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Demandes de contact</span>
                <span class="nav-indicator"></span>
            </a>

            <a href="{{ route('admin.users') }}" class="nav-link group {{ request()->routeIs('admin.users') ? 'active' : '' }}" title="Utilisateurs">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Utilisateurs</span>
                <span class="nav-indicator"></span>
            </a>
        </nav>

        <!-- User Profile Section -->
        <div class="p-3 border-t border-slate-200/80 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-800/30">
            <div class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-white dark:hover:bg-slate-800 transition-all duration-200 cursor-pointer group">
                <div class="relative flex-shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-500/20 ring-2 ring-white dark:ring-slate-700">
                        @auth
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @else
                            A
                        @endauth
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-emerald-500 rounded-full border-2 border-white dark:border-slate-800"></div>
                </div>
                <div class="sidebar-text flex-1 min-w-0 transition-all duration-300">
                    <p class="text-sm font-semibold text-slate-800 dark:text-white truncate">
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Admin
                        @endauth
                    </p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                        @auth
                            {{ auth()->user()->email }}
                        @else
                            admin@example.com
                        @endauth
                    </p>
                </div>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="sidebar-text">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all duration-200" title="Deconnexion">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 lg:hidden hidden transition-opacity duration-300" onclick="toggleSidebar()"></div>

<style>
    .sidebar-width {
        width: 17rem;
    }

    .sidebar-collapsed {
        width: 4.5rem;
    }

    .sidebar-collapsed .sidebar-text {
        opacity: 0;
        width: 0;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .sidebar-collapsed .sidebar-collapse-icon {
        transform: rotate(180deg);
    }

    /* Navigation Link Styles */
    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.625rem 0.875rem;
        margin: 0.125rem 0;
        border-radius: 0.75rem;
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
        position: relative;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 0.625rem;
        background: transparent;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .nav-icon {
        width: 1.25rem;
        height: 1.25rem;
        transition: all 0.2s ease;
    }

    .nav-text {
        transition: all 0.2s ease;
    }

    .nav-indicator {
        position: absolute;
        right: 0.75rem;
        width: 0.375rem;
        height: 0.375rem;
        border-radius: 50%;
        background: transparent;
        transition: all 0.2s ease;
        opacity: 0;
    }

    .nav-link:hover {
        color: #6366f1;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.05) 100%);
    }

    .nav-link:hover .nav-icon-wrapper {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
    }

    .nav-link:hover .nav-icon {
        transform: scale(1.1);
    }

    .nav-link.active {
        color: #ffffff;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        box-shadow: 0 4px 15px -3px rgba(99, 102, 241, 0.4), 0 2px 6px -2px rgba(99, 102, 241, 0.2);
    }

    .nav-link.active .nav-icon-wrapper {
        background: rgba(255, 255, 255, 0.2);
    }

    .nav-link.active .nav-icon {
        color: white;
    }

    .nav-link.active .nav-indicator {
        background: white;
        opacity: 1;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
    }

    /* Collapsed state */
    .sidebar-collapsed .nav-link {
        justify-content: center;
        padding: 0.625rem;
    }

    .sidebar-collapsed .nav-icon-wrapper {
        width: 2.5rem;
        height: 2.5rem;
    }

    .sidebar-collapsed .nav-indicator {
        display: none;
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #4f46e5 0%, #7c3aed 100%);
    }

    /* Main content transition */
    .main-content {
        transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Dark mode adjustments */
    @media (prefers-color-scheme: dark) {
        .nav-link:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
        }
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    function toggleSidebarCollapse() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');

        sidebar.classList.toggle('sidebar-collapsed');

        const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);

        if (mainContent) {
            mainContent.style.marginLeft = isCollapsed ? '4.5rem' : '17rem';
        }
    }

    // Restore sidebar state on page load
    document.addEventListener('DOMContentLoaded', () => {
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');

        if (isCollapsed && sidebar) {
            sidebar.classList.add('sidebar-collapsed');
            if (mainContent) {
                mainContent.style.marginLeft = '4.5rem';
            }
        }
    });
</script>

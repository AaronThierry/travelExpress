<!-- Sidebar - Luxury Black & Gold Theme -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 ease-out -translate-x-full lg:translate-x-0 sidebar-width">
    <!-- Dark Background -->
    <div class="absolute inset-0 bg-[#0a0a0a]"></div>

    <!-- Subtle Gold Accent Line -->
    <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-[#d4af37]/30 to-transparent"></div>

    <div class="relative h-full flex flex-col">
        <!-- Logo Section -->
        <div class="p-5 border-b border-[#d4af37]/10">
            <div class="flex items-center justify-between gap-3">
                <a href="/" class="flex items-center gap-3 min-w-0 group">
                    <div class="relative flex-shrink-0">
                        <!-- Gold glow on hover -->
                        <div class="absolute inset-0 bg-[#d4af37] rounded-xl blur-lg opacity-0 group-hover:opacity-40 transition-opacity duration-500"></div>
                        <!-- Logo icon -->
                        <div class="relative w-11 h-11 bg-gradient-to-br from-[#d4af37] to-[#b8960c] rounded-xl flex items-center justify-center shadow-lg shadow-[#d4af37]/20 group-hover:shadow-[#d4af37]/40 transition-all duration-300 group-hover:scale-105">
                            <svg class="w-6 h-6 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="sidebar-text overflow-hidden transition-all duration-300">
                        <h1 class="text-lg font-bold text-white tracking-tight truncate">Travel Express</h1>
                        <p class="text-[11px] font-semibold text-[#d4af37] uppercase tracking-wider truncate">Admin Panel</p>
                    </div>
                </a>
                <button onclick="toggleSidebarCollapse()" class="hidden lg:flex p-2 text-gray-500 hover:text-[#d4af37] hover:bg-[#d4af37]/10 rounded-lg transition-all duration-200 flex-shrink-0" title="Replier le menu">
                    <svg class="w-5 h-5 sidebar-collapse-icon transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Label -->
        <div class="px-5 pt-6 pb-2 sidebar-text">
            <p class="text-[10px] font-bold text-gray-600 uppercase tracking-widest">Navigation</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 pb-4 space-y-1 overflow-y-auto custom-scrollbar">
            @if(auth()->check() && auth()->user()->hasPermission('dashboard-view'))
            <a href="{{ route('admin.dashboard') }}" class="nav-link group {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Tableau de bord">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Tableau de bord</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->hasPermission('applications-view'))
            <a href="{{ route('admin.student-applications') }}" class="nav-link group {{ request()->routeIs('admin.student-applications') ? 'active' : '' }}" title="Dossiers Etudiants">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Dossiers Etudiants</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->hasPermission('evaluations-view'))
            <a href="{{ route('admin.evaluations') }}" class="nav-link group {{ request()->routeIs('admin.evaluations') ? 'active' : '' }}" title="Evaluations">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Evaluations</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->hasPermission('testimonials-view'))
            <a href="{{ route('admin.testimonials') }}" class="nav-link group {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}" title="Temoignages">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Temoignages</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->hasPermission('contacts-view'))
            <a href="{{ route('admin.contact-requests') }}" class="nav-link group {{ request()->routeIs('admin.contact-requests') ? 'active' : '' }}" title="Demandes de contact">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Demandes de contact</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->hasPermission('users-view'))
            <a href="{{ route('admin.users') }}" class="nav-link group {{ request()->routeIs('admin.users') ? 'active' : '' }}" title="Utilisateurs">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Utilisateurs</span>
            </a>
            @endif

            @if(auth()->check() && auth()->user()->hasPermission('roles-view'))
            <a href="{{ route('admin.roles') }}" class="nav-link group {{ request()->routeIs('admin.roles') ? 'active' : '' }}" title="Roles & Permissions">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <span class="sidebar-text nav-text">Roles & Permissions</span>
            </a>
            @endif
        </nav>

        <!-- User Profile Section -->
        <div class="p-3 border-t border-[#d4af37]/10 bg-[#0a0a0a]">
            <div class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-[#d4af37]/5 transition-all duration-200 cursor-pointer group">
                <div class="relative flex-shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#d4af37] to-[#b8960c] rounded-xl flex items-center justify-center text-[#0a0a0a] font-bold text-sm shadow-md shadow-[#d4af37]/20">
                        @auth
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @else
                            A
                        @endauth
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 rounded-full border-2 border-[#0a0a0a]"></div>
                </div>
                <div class="sidebar-text flex-1 min-w-0 transition-all duration-300">
                    <p class="text-sm font-semibold text-white truncate">
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Admin
                        @endauth
                    </p>
                    <p class="text-xs text-gray-500 truncate">
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
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-all duration-200" title="Deconnexion">
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
<div id="sidebar-overlay" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-30 lg:hidden hidden transition-opacity duration-300" onclick="toggleSidebar()"></div>

<style>
    .sidebar-width { width: 16rem; }
    .sidebar-collapsed { width: 4.5rem; }

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

    /* Navigation Link Styles - Gold Theme */
    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        margin: 0.25rem 0;
        border-radius: 0.75rem;
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 500;
        position: relative;
        transition: all 0.2s ease;
        border: 1px solid transparent;
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

    .nav-link:hover {
        color: #d4af37;
        background: rgba(212, 175, 55, 0.05);
        border-color: rgba(212, 175, 55, 0.1);
    }

    .nav-link:hover .nav-icon-wrapper {
        background: rgba(212, 175, 55, 0.1);
    }

    .nav-link:hover .nav-icon {
        color: #d4af37;
    }

    .nav-link.active {
        color: #0a0a0a;
        background: linear-gradient(135deg, #d4af37 0%, #b8960c 100%);
        border-color: transparent;
        box-shadow: 0 4px 20px -4px rgba(212, 175, 55, 0.5);
    }

    .nav-link.active .nav-icon-wrapper {
        background: rgba(10, 10, 10, 0.15);
    }

    .nav-link.active .nav-icon {
        color: #0a0a0a;
    }

    .nav-link.active .nav-text {
        font-weight: 600;
    }

    /* Collapsed state */
    .sidebar-collapsed .nav-link {
        justify-content: center;
        padding: 0.75rem;
    }

    .sidebar-collapsed .nav-icon-wrapper {
        width: 2.5rem;
        height: 2.5rem;
    }

    /* Gold Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #d4af37 0%, #b8960c 100%);
        border-radius: 10px;
    }

    /* Main content transition */
    .main-content {
        transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            mainContent.style.marginLeft = isCollapsed ? '4.5rem' : '16rem';
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

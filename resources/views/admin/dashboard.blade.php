@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@push('styles')
<style>
    /* Premium Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
        50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.5); }
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    @keyframes countUp {
        from { opacity: 0; transform: scale(0.5); }
        to { opacity: 1; transform: scale(1); }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.6s ease-out forwards;
    }

    .animate-count-up {
        animation: countUp 0.5s ease-out forwards;
    }

    /* Premium Card Styles */
    .stat-card {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 1.25rem;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .stat-card .stat-icon {
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    /* Gradient Backgrounds */
    .gradient-blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .gradient-orange {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .gradient-purple {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .gradient-pink {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    /* Progress Bar Animation */
    .progress-bar {
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Activity Pulse */
    .activity-dot {
        animation: pulse-dot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Custom Scrollbar */
    .elegant-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .elegant-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .elegant-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #6366f1, #8b5cf6);
        border-radius: 3px;
    }

    /* Skeleton Loading */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 8px;
    }

    /* Glass Effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
@endpush

@section('content')
<!-- Loading State with Premium Design -->
<div id="loading" class="flex flex-col items-center justify-center py-24">
    <div class="relative mb-8">
        <div class="w-20 h-20 border-4 border-slate-100 rounded-full"></div>
        <div class="w-20 h-20 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin absolute top-0"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full animate-pulse"></div>
        </div>
    </div>
    <p class="text-slate-600 font-semibold text-lg">Chargement du tableau de bord...</p>
    <p class="text-slate-400 text-sm mt-2">Veuillez patienter</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden space-y-8">

    <!-- Welcome Hero Section -->
    <div class="relative rounded-2xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        <div class="relative p-8 md:p-10">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium">
                            Dashboard v2.0
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                        Bienvenue, @auth {{ explode(' ', auth()->user()->name)[0] }} @else Admin @endauth !
                    </h1>
                    <p class="text-indigo-100 text-lg max-w-xl">
                        Voici un apercu complet de votre activite. Gerez vos utilisateurs, temoignages et demandes en un seul endroit.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-5 text-center min-w-[120px]">
                        <p class="text-indigo-200 text-xs font-medium uppercase tracking-wider mb-1">Date</p>
                        <p class="text-white text-2xl font-bold" id="current-date">--</p>
                    </div>
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-5 text-center min-w-[120px]">
                        <p class="text-indigo-200 text-xs font-medium uppercase tracking-wider mb-1">Heure</p>
                        <p class="text-white text-2xl font-bold" id="current-time">--:--</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users Card -->
        <div class="stat-card bg-white p-6 shadow-lg shadow-blue-500/10 border border-blue-100/50">
            <div class="flex items-start justify-between mb-6">
                <div class="stat-icon p-4 gradient-blue rounded-2xl shadow-lg shadow-blue-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <span id="users-growth" class="hidden text-xs font-bold px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-700">
                    +0%
                </span>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium mb-2">Total Utilisateurs</p>
                <p class="text-4xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent" id="total-users">0</p>
                <div class="flex items-center gap-2 mt-3">
                    <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-slate-600" id="new-users-text">+0 ce mois</span>
                </div>
            </div>
        </div>

        <!-- Testimonials Card -->
        <div class="stat-card bg-white p-6 shadow-lg shadow-emerald-500/10 border border-emerald-100/50">
            <div class="flex items-start justify-between mb-6">
                <div class="stat-icon p-4 gradient-green rounded-2xl shadow-lg shadow-emerald-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 rounded-full">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span id="avg-rating" class="text-sm font-bold text-amber-700">0</span>
                </div>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium mb-2">Temoignages</p>
                <p class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent" id="total-testimonials">0</p>
                <div class="flex items-center gap-2 mt-3">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    <span class="text-sm text-slate-600" id="approved-text">0 approuves</span>
                </div>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="stat-card bg-white p-6 shadow-lg shadow-amber-500/10 border border-amber-100/50">
            <div class="flex items-start justify-between mb-6">
                <div class="stat-icon p-4 gradient-orange rounded-2xl shadow-lg shadow-pink-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="activity-dot w-3 h-3 bg-amber-500 rounded-full"></div>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium mb-2">En attente</p>
                <p class="text-4xl font-black bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent" id="pending-testimonials">0</p>
                <a href="/admin/testimonials" class="inline-flex items-center gap-2 mt-3 text-sm text-amber-600 hover:text-amber-700 font-medium group transition-colors">
                    Moderer maintenant
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- This Month Card -->
        <div class="stat-card bg-white p-6 shadow-lg shadow-violet-500/10 border border-violet-100/50">
            <div class="flex items-start justify-between mb-6">
                <div class="stat-icon p-4 gradient-purple rounded-2xl shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium mb-2">Ce mois-ci</p>
                <p class="text-4xl font-black bg-gradient-to-r from-violet-600 to-purple-600 bg-clip-text text-transparent" id="new-testimonials-month">0</p>
                <p class="text-sm text-slate-600 mt-3">Nouveaux temoignages</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Geographic Distribution -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-lg shadow-slate-200/50 overflow-hidden border border-slate-100">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Repartition geographique</h3>
                        <p class="text-sm text-slate-500 mt-1">Vos utilisateurs dans le monde</p>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-xl">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div id="country-chart" class="p-6 space-y-5 min-h-[300px]">
                <!-- Dynamic content -->
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 overflow-hidden border border-slate-100">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Activite recente</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                            </span>
                            <span class="text-xs text-emerald-600 font-semibold">En direct</span>
                        </div>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-xl">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div id="activity-feed" class="divide-y divide-slate-100 max-h-[350px] overflow-y-auto elegant-scroll">
                <!-- Dynamic content -->
            </div>
        </div>
    </div>

    <!-- Recent Lists Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Testimonials -->
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 overflow-hidden border border-slate-100">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-indigo-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Derniers temoignages</h3>
                        <p class="text-sm text-slate-500 mt-1">Recemment ajoutes</p>
                    </div>
                    <a href="/admin/testimonials" class="px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 inline-flex items-center gap-2">
                        Voir tout
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="recent-testimonials" class="divide-y divide-slate-100 max-h-[450px] overflow-y-auto elegant-scroll">
                <!-- Dynamic content -->
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 overflow-hidden border border-slate-100">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-blue-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Nouveaux utilisateurs</h3>
                        <p class="text-sm text-slate-500 mt-1">Dernieres inscriptions</p>
                    </div>
                    <a href="/admin/users" class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 inline-flex items-center gap-2">
                        Voir tout
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="recent-users" class="divide-y divide-slate-100 max-h-[450px] overflow-y-auto elegant-scroll">
                <!-- Dynamic content -->
            </div>
        </div>
    </div>

</div>

<!-- Error State -->
<div id="error-state" class="hidden">
    <div class="text-center py-20">
        <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Erreur de chargement</h3>
        <p class="text-slate-500 mb-6" id="error-message">Impossible de charger les donnees du tableau de bord.</p>
        <button onclick="loadDashboardStats()" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-indigo-500/25">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Reessayer
            </span>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Update time
    function updateTime() {
        const now = new Date();
        const dateEl = document.getElementById('current-date');
        const timeEl = document.getElementById('current-time');

        if (dateEl) {
            dateEl.textContent = now.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: 'short'
            });
        }
        if (timeEl) {
            timeEl.textContent = now.toLocaleTimeString('fr-FR', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }
    setInterval(updateTime, 1000);
    updateTime();

    async function loadDashboardStats() {
        const loadingEl = document.getElementById('loading');
        const contentEl = document.getElementById('dashboard-content');
        const errorEl = document.getElementById('error-state');

        // Reset state
        loadingEl.classList.remove('hidden');
        contentEl.classList.add('hidden');
        errorEl.classList.add('hidden');

        try {
            // Use web route instead of API route (no token required)
            const response = await fetch('/admin/api/stats', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const result = await response.json();
            const data = result.data;

            // Show content
            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');

            // Animate numbers
            animateValue('total-users', 0, data.users.total, 1200);
            animateValue('total-testimonials', 0, data.testimonials.total, 1200);
            animateValue('pending-testimonials', 0, data.testimonials.pending, 1200);
            animateValue('new-testimonials-month', 0, data.testimonials.new_this_month, 1200);

            // Update text
            document.getElementById('new-users-text').textContent = `+${data.users.new_this_month} ce mois`;
            document.getElementById('approved-text').textContent = `${data.testimonials.approved} approuves`;
            document.getElementById('avg-rating').textContent = data.testimonials.average_rating || '0';

            // Growth badge
            const growthEl = document.getElementById('users-growth');
            if (data.users.growth_percentage !== 0) {
                growthEl.textContent = (data.users.growth_percentage >= 0 ? '+' : '') + data.users.growth_percentage + '%';
                growthEl.className = `text-xs font-bold px-3 py-1.5 rounded-full ${data.users.growth_percentage >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'}`;
                growthEl.classList.remove('hidden');
            }

            // Render sections
            renderCountryChart(data.users_by_country);
            renderActivityFeed(data.recent_testimonials, data.recent_users);
            renderRecentTestimonials(data.recent_testimonials);
            renderRecentUsers(data.recent_users);

        } catch (error) {
            console.error('Dashboard Error:', error);
            loadingEl.classList.add('hidden');
            errorEl.classList.remove('hidden');
            document.getElementById('error-message').textContent = `Erreur: ${error.message}. Verifiez votre connexion.`;
        }
    }

    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        if (!obj) return;

        end = Math.max(0, end);
        if (end === 0) {
            obj.textContent = '0';
            return;
        }

        const range = end - start;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3); // Ease out cubic
            const current = Math.round(start + range * easeProgress);
            obj.textContent = current.toLocaleString('fr-FR');

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }

    function renderCountryChart(countries) {
        const container = document.getElementById('country-chart');

        if (!countries || countries.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Aucune donnee geographique</p>
                    <p class="text-slate-400 text-sm mt-1">Les donnees apparaitront ici</p>
                </div>
            `;
            return;
        }

        const maxTotal = Math.max(...countries.map(c => c.total));
        const gradients = [
            'from-indigo-500 to-purple-600',
            'from-emerald-500 to-teal-600',
            'from-amber-500 to-orange-600',
            'from-rose-500 to-pink-600',
            'from-cyan-500 to-blue-600'
        ];

        container.innerHTML = countries.slice(0, 5).map((country, i) => {
            const pct = Math.round((country.total / maxTotal) * 100);
            return `
                <div class="group animate-fade-in-up" style="animation-delay: ${i * 100}ms">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl">${getCountryFlag(country.country)}</span>
                            <div>
                                <span class="text-sm font-semibold text-slate-800">${country.country || 'Non specifie'}</span>
                                <span class="text-xs text-slate-400 ml-2">${pct}%</span>
                            </div>
                        </div>
                        <span class="text-xl font-bold text-slate-900">${country.total}</span>
                    </div>
                    <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="progress-bar h-full bg-gradient-to-r ${gradients[i % gradients.length]} rounded-full" style="width: 0%" data-width="${pct}%"></div>
                    </div>
                </div>
            `;
        }).join('');

        // Animate progress bars
        setTimeout(() => {
            container.querySelectorAll('.progress-bar').forEach(bar => {
                bar.style.width = bar.getAttribute('data-width');
            });
        }, 200);
    }

    function renderActivityFeed(testimonials, users) {
        const container = document.getElementById('activity-feed');

        const activities = [
            ...testimonials.slice(0, 4).map(t => ({
                type: 'testimonial',
                name: t.user_name,
                status: t.is_approved,
                time: t.created_at
            })),
            ...users.slice(0, 4).map(u => ({
                type: 'user',
                name: u.name,
                country: u.country,
                time: u.created_at
            }))
        ].slice(0, 8);

        if (activities.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-12">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Aucune activite</p>
                </div>
            `;
            return;
        }

        container.innerHTML = activities.map((a, i) => {
            if (a.type === 'testimonial') {
                return `
                    <div class="p-4 hover:bg-gradient-to-r hover:from-slate-50 hover:to-transparent transition-all duration-300 animate-fade-in-up" style="animation-delay: ${i * 80}ms">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-amber-500/30">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">${a.name}</p>
                                <p class="text-xs text-slate-500">Nouveau temoignage</p>
                            </div>
                            <span class="text-xs px-3 py-1.5 rounded-full font-semibold ${a.status ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">${a.status ? 'Approuve' : 'En attente'}</span>
                        </div>
                    </div>
                `;
            } else {
                return `
                    <div class="p-4 hover:bg-gradient-to-r hover:from-slate-50 hover:to-transparent transition-all duration-300 animate-fade-in-up" style="animation-delay: ${i * 80}ms">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-blue-500/30">
                                <span class="text-white font-bold">${a.name.charAt(0).toUpperCase()}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">${a.name}</p>
                                <p class="text-xs text-slate-500">Nouvel utilisateur</p>
                            </div>
                            <span class="text-2xl">${getCountryFlag(a.country)}</span>
                        </div>
                    </div>
                `;
            }
        }).join('');
    }

    function renderRecentTestimonials(testimonials) {
        const container = document.getElementById('recent-testimonials');

        if (!testimonials || testimonials.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Aucun temoignage</p>
                    <p class="text-slate-400 text-sm mt-1">Les temoignages apparaitront ici</p>
                </div>
            `;
            return;
        }

        container.innerHTML = testimonials.slice(0, 5).map((t, i) => {
            const avatarHtml = t.user_avatar
                ? `<img src="/storage/${t.user_avatar}" alt="${t.user_name}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 shadow-md ring-2 ring-white">`
                : `<div class="w-14 h-14 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md ring-2 ring-white">
                        <span class="text-white font-bold text-lg">${t.user_name.charAt(0).toUpperCase()}</span>
                   </div>`;

            return `
            <div class="p-5 hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-transparent transition-all duration-300 animate-slide-in-right" style="animation-delay: ${i * 100}ms">
                <div class="flex items-start gap-4">
                    ${avatarHtml}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <p class="text-sm font-bold text-slate-900">${t.user_name}</p>
                            <div class="flex gap-0.5">
                                ${[1,2,3,4,5].map(star => `<svg class="w-4 h-4 ${star <= t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`).join('')}
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-lg">${getCountryFlag(t.user_country)}</span>
                            <span class="text-xs text-slate-500">${t.user_country || 'N/A'}</span>
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                            <span class="text-lg">${getCountryFlag(t.destination)}</span>
                            <span class="text-xs font-semibold text-indigo-600">${t.destination || 'N/A'}</span>
                        </div>
                        <p class="text-sm text-slate-600 line-clamp-2 mb-3">${t.content}</p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold ${t.is_approved ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">${t.is_approved ? 'Approuve' : 'En attente'}</span>
                            <span class="text-xs text-slate-400">${t.created_at}</span>
                        </div>
                    </div>
                </div>
            </div>
        `}).join('');
    }

    function renderRecentUsers(users) {
        const container = document.getElementById('recent-users');

        if (!users || users.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Aucun utilisateur recent</p>
                    <p class="text-slate-400 text-sm mt-1">Les inscriptions apparaitront ici</p>
                </div>
            `;
            return;
        }

        container.innerHTML = users.slice(0, 5).map((u, i) => `
            <div class="p-5 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-transparent transition-all duration-300 animate-slide-in-right" style="animation-delay: ${i * 100}ms">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-blue-500/30 ring-2 ring-white">
                        <span class="text-white font-bold text-lg">${u.name.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-900 truncate">${u.name}</p>
                        <p class="text-xs text-slate-500 truncate">${u.email}</p>
                        <p class="text-xs text-slate-400 mt-1">${new Date(u.created_at).toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' })}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span class="text-2xl">${getCountryFlag(u.country)}</span>
                        <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-semibold">Actif</span>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function getCountryFlag(country) {
        const flags = {
            'France': '🇫🇷', 'Cameroun': '🇨🇲', 'Senegal': '🇸🇳', 'Cote d\'Ivoire': '🇨🇮',
            'Mali': '🇲🇱', 'Guinee': '🇬🇳', 'Benin': '🇧🇯', 'Togo': '🇹🇬',
            'Burkina Faso': '🇧🇫', 'burkina': '🇧🇫', 'Niger': '🇳🇪', 'Congo': '🇨🇬',
            'Gabon': '🇬🇦', 'Maroc': '🇲🇦', 'Algerie': '🇩🇿', 'Tunisie': '🇹🇳',
            'Chine': '🇨🇳', 'Espagne': '🇪🇸', 'Allemagne': '🇩🇪', 'Canada': '🇨🇦',
            'Belgique': '🇧🇪', 'Suisse': '🇨🇭', 'Italie': '🇮🇹', 'Royaume-Uni': '🇬🇧'
        };
        return flags[country] || '🌍';
    }

    // Load dashboard on page load
    document.addEventListener('DOMContentLoaded', loadDashboardStats);
</script>
@endpush

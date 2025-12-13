@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Vue d\'ensemble de votre plateforme Travel Express')

@section('content')
<style>
    /* Stat Card Premium */
    .stat-card {
        background: white;
        border-radius: 1.25rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 10px 30px -10px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--accent-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 20px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    /* Counter Animation */
    .counter-value {
        display: inline-block;
    }

    /* Activity Pulse */
    .activity-pulse {
        animation: activity-pulse 2s ease-in-out infinite;
    }

    @keyframes activity-pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Chart Container */
    .chart-bar {
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: bottom;
    }

    .chart-bar:hover {
        filter: brightness(1.1);
    }

    /* Glass Effect */
    .glass-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    /* Shimmer Effect */
    .shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Smooth Appear */
    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
</style>

<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-20">
    <div class="relative">
        <div class="w-16 h-16 border-4 border-indigo-100 rounded-full"></div>
        <div class="absolute top-0 left-0 w-16 h-16 border-4 border-indigo-600 rounded-full animate-spin border-t-transparent"></div>
    </div>
    <p class="mt-4 text-slate-600 font-medium">Chargement des données...</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden space-y-6 lg:space-y-8 relative z-10">

    <!-- Welcome Banner Premium -->
    <div class="fade-in-up relative overflow-hidden rounded-2xl lg:rounded-3xl bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-800 p-6 sm:p-8 lg:p-10 text-white shadow-2xl shadow-indigo-500/25">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.1)_0%,transparent_70%)]"></div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-medium text-white/90">Système actif</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">Bienvenue sur votre Dashboard</h2>
                <p class="text-indigo-100 text-sm sm:text-base max-w-xl">Gérez votre plateforme Travel Express et suivez les performances en temps réel.</p>
            </div>

            <!-- Quick Stats -->
            <div class="flex items-center gap-4">
                <div class="text-center px-6 py-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                    <p class="text-3xl sm:text-4xl font-bold" id="banner-users">0</p>
                    <p class="text-xs text-indigo-200 mt-1">Utilisateurs</p>
                </div>
                <div class="text-center px-6 py-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                    <p class="text-3xl sm:text-4xl font-bold" id="banner-testimonials">0</p>
                    <p class="text-xs text-indigo-200 mt-1">Témoignages</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <!-- Total Users -->
        <div class="stat-card fade-in-up delay-100" style="--accent-gradient: linear-gradient(135deg, #3b82f6, #6366f1);">
            <div class="flex items-start justify-between">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span id="users-growth" class="text-xs font-bold px-2.5 py-1 rounded-full hidden sm:inline-block"></span>
            </div>
            <div class="mt-4">
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Total Utilisateurs</p>
                <p id="total-users" class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1 counter-value">0</p>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p id="new-users" class="text-sm text-slate-500 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span></span>
                </p>
            </div>
        </div>

        <!-- Total Testimonials -->
        <div class="stat-card fade-in-up delay-200" style="--accent-gradient: linear-gradient(135deg, #10b981, #059669);">
            <div class="flex items-start justify-between">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-1.5 bg-amber-50 px-2.5 py-1 rounded-full">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span id="avg-rating" class="text-xs font-bold text-amber-700">0</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Témoignages</p>
                <p id="total-testimonials" class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1 counter-value">0</p>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p id="approved-testimonials" class="text-sm text-emerald-600 font-medium"></p>
            </div>
        </div>

        <!-- Pending Testimonials -->
        <div class="stat-card fade-in-up delay-300" style="--accent-gradient: linear-gradient(135deg, #f59e0b, #d97706);">
            <div class="flex items-start justify-between">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">En attente</p>
                <p id="pending-testimonials" class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1 counter-value">0</p>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100">
                <a href="/admin/testimonials" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center gap-2 group">
                    <span>Modérer</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- This Month -->
        <div class="stat-card fade-in-up delay-400" style="--accent-gradient: linear-gradient(135deg, #8b5cf6, #7c3aed);">
            <div class="flex items-start justify-between">
                <div class="w-14 h-14 bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Ce mois-ci</p>
                <p id="new-testimonials-month" class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1 counter-value">0</p>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-sm text-slate-500">Nouveaux témoignages</p>
            </div>
        </div>
    </div>

    <!-- Charts and Activity -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Users by Country Chart -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 fade-in-up delay-400">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Répartition géographique</h3>
                    <p class="text-sm text-slate-500">Distribution des utilisateurs par pays</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-indigo-500"></span>
                    <span class="text-xs text-slate-500">Utilisateurs</span>
                </div>
            </div>

            <!-- Visual Chart -->
            <div id="country-chart" class="space-y-4">
                <!-- Will be populated dynamically -->
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 fade-in-up delay-500">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-900">Activité récente</h3>
                <span class="flex items-center gap-1.5 text-xs text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 activity-pulse"></span>
                    En direct
                </span>
            </div>

            <div id="activity-feed" class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                <!-- Will be populated dynamically -->
            </div>
        </div>
    </div>

    <!-- Recent Testimonials & Users -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Testimonials -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden fade-in-up delay-400">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Derniers témoignages</h3>
                        <p class="text-sm text-slate-500">Avis récemment soumis</p>
                    </div>
                    <a href="/admin/testimonials" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center gap-1 group">
                        <span>Tout voir</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="recent-testimonials" class="divide-y divide-slate-100">
                <!-- Will be populated dynamically -->
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden fade-in-up delay-500">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Nouveaux utilisateurs</h3>
                        <p class="text-sm text-slate-500">Inscriptions récentes</p>
                    </div>
                    <a href="/admin/users" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center gap-1 group">
                        <span>Tout voir</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="recent-users" class="divide-y divide-slate-100">
                <!-- Will be populated dynamically -->
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Counter Animation
    function animateCounter(element, target, duration = 1000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }

    async function loadDashboardStats() {
        const loadingEl = document.getElementById('loading');
        const contentEl = document.getElementById('dashboard-content');

        try {
            const response = await fetch('/api/admin/stats', {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors du chargement des statistiques');
            }

            const result = await response.json();
            const data = result.data;

            // Hide loading, show content
            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');

            // Animate counters
            setTimeout(() => {
                animateCounter(document.getElementById('total-users'), data.users.total);
                animateCounter(document.getElementById('banner-users'), data.users.total);
                animateCounter(document.getElementById('total-testimonials'), data.testimonials.total);
                animateCounter(document.getElementById('banner-testimonials'), data.testimonials.total);
                animateCounter(document.getElementById('pending-testimonials'), data.testimonials.pending);
                animateCounter(document.getElementById('new-testimonials-month'), data.testimonials.new_this_month);
            }, 300);

            // Update text stats
            document.getElementById('new-users').querySelector('span').textContent = `+${data.users.new_this_month} ce mois-ci`;
            document.getElementById('approved-testimonials').textContent = `${data.testimonials.approved} approuvés`;
            document.getElementById('avg-rating').textContent = data.testimonials.average_rating || '0';

            // Growth badge
            const growthEl = document.getElementById('users-growth');
            if (data.users.growth_percentage >= 0) {
                growthEl.textContent = `+${data.users.growth_percentage}%`;
                growthEl.className = 'text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700';
            } else {
                growthEl.textContent = `${data.users.growth_percentage}%`;
                growthEl.className = 'text-xs font-bold px-2.5 py-1 rounded-full bg-red-100 text-red-700';
            }
            growthEl.classList.remove('hidden');

            // Render country chart
            renderCountryChart(data.users_by_country);

            // Render activity feed
            renderActivityFeed(data.recent_testimonials, data.recent_users);

            // Render recent testimonials
            renderRecentTestimonials(data.recent_testimonials);

            // Render recent users
            renderRecentUsers(data.recent_users);

        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `
                <div class="bg-red-50 border border-red-200 rounded-2xl p-8 text-center max-w-md mx-auto">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-red-800 mb-2">Erreur de chargement</h3>
                    <p class="text-red-600 text-sm mb-4">Impossible de récupérer les statistiques</p>
                    <button onclick="loadDashboardStats()" class="px-4 py-2 bg-red-600 text-white rounded-xl font-semibold text-sm hover:bg-red-700 transition-colors">
                        Réessayer
                    </button>
                </div>
            `;
        }
    }

    function renderCountryChart(countries) {
        const container = document.getElementById('country-chart');

        if (!countries || countries.length === 0) {
            container.innerHTML = `
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500">Aucune donnée géographique disponible</p>
                </div>
            `;
            return;
        }

        const maxTotal = Math.max(...countries.map(c => c.total));
        const colors = [
            { bg: 'bg-indigo-500', light: 'bg-indigo-100' },
            { bg: 'bg-emerald-500', light: 'bg-emerald-100' },
            { bg: 'bg-amber-500', light: 'bg-amber-100' },
            { bg: 'bg-rose-500', light: 'bg-rose-100' },
            { bg: 'bg-violet-500', light: 'bg-violet-100' }
        ];

        container.innerHTML = countries.slice(0, 5).map((country, index) => {
            const percentage = Math.round((country.total / maxTotal) * 100);
            const color = colors[index % colors.length];
            return `
                <div class="group">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">${getCountryFlag(country.country)}</span>
                            <span class="text-sm font-medium text-slate-700">${country.country || 'Non spécifié'}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-slate-900">${country.total}</span>
                            <span class="text-xs text-slate-400">(${percentage}%)</span>
                        </div>
                    </div>
                    <div class="h-3 ${color.light} rounded-full overflow-hidden">
                        <div class="chart-bar h-full ${color.bg} rounded-full" style="width: 0%; transition-delay: ${index * 100}ms;" data-width="${percentage}%"></div>
                    </div>
                </div>
            `;
        }).join('');

        // Animate bars
        setTimeout(() => {
            document.querySelectorAll('.chart-bar').forEach(bar => {
                bar.style.width = bar.dataset.width;
            });
        }, 100);
    }

    function renderActivityFeed(testimonials, users) {
        const container = document.getElementById('activity-feed');

        // Combine and sort by date
        const activities = [
            ...testimonials.map(t => ({
                type: 'testimonial',
                name: t.user_name,
                date: t.created_at,
                status: t.is_approved ? 'approved' : 'pending'
            })),
            ...users.map(u => ({
                type: 'user',
                name: u.name,
                date: new Date(u.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' }),
                country: u.country
            }))
        ].slice(0, 8);

        if (activities.length === 0) {
            container.innerHTML = `
                <div class="text-center py-8">
                    <p class="text-slate-500 text-sm">Aucune activité récente</p>
                </div>
            `;
            return;
        }

        container.innerHTML = activities.map(activity => {
            if (activity.type === 'testimonial') {
                return `
                    <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900 font-medium">${activity.name}</p>
                            <p class="text-xs text-slate-500">Nouveau témoignage</p>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full ${activity.status === 'approved' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">
                            ${activity.status === 'approved' ? 'Approuvé' : 'En attente'}
                        </span>
                    </div>
                `;
            } else {
                return `
                    <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">${activity.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900 font-medium">${activity.name}</p>
                            <p class="text-xs text-slate-500">Nouvel utilisateur</p>
                        </div>
                        <span class="text-lg">${getCountryFlag(activity.country)}</span>
                    </div>
                `;
            }
        }).join('');
    }

    function renderRecentTestimonials(testimonials) {
        const container = document.getElementById('recent-testimonials');

        if (!testimonials || testimonials.length === 0) {
            container.innerHTML = `
                <div class="p-8 text-center">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm">Aucun témoignage récent</p>
                </div>
            `;
            return;
        }

        container.innerHTML = testimonials.slice(0, 4).map(t => `
            <div class="p-4 hover:bg-slate-50 transition-colors">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xs">${t.user_name.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <p class="text-sm font-semibold text-slate-900 truncate">${t.user_name}</p>
                            <div class="flex items-center gap-0.5">
                                ${Array(5).fill(0).map((_, i) => `
                                    <svg class="w-3.5 h-3.5 ${i < t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                `).join('')}
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 line-clamp-2">${t.content}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-medium ${t.is_approved ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">
                                ${t.is_approved ? '✓ Approuvé' : '⏳ En attente'}
                            </span>
                            <span class="text-[10px] text-slate-400">${t.created_at}</span>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function renderRecentUsers(users) {
        const container = document.getElementById('recent-users');

        if (!users || users.length === 0) {
            container.innerHTML = `
                <div class="p-8 text-center">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm">Aucun nouvel utilisateur</p>
                </div>
            `;
            return;
        }

        container.innerHTML = users.slice(0, 4).map(user => `
            <div class="p-4 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center flex-shrink-0 shadow-md">
                        <span class="text-white font-bold text-sm">${user.name.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">${user.name}</p>
                        <p class="text-xs text-slate-500 truncate">${user.email}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-lg">${getCountryFlag(user.country)}</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-medium">Actif</span>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function getCountryFlag(country) {
        const flags = {
            'France': '🇫🇷',
            'Cameroun': '🇨🇲',
            'Sénégal': '🇸🇳',
            'Côte d\'Ivoire': '🇨🇮',
            'Mali': '🇲🇱',
            'Guinée': '🇬🇳',
            'Bénin': '🇧🇯',
            'Togo': '🇹🇬',
            'Burkina Faso': '🇧🇫',
            'Niger': '🇳🇪',
            'Congo': '🇨🇬',
            'Gabon': '🇬🇦',
            'Maroc': '🇲🇦',
            'Algérie': '🇩🇿',
            'Tunisie': '🇹🇳',
            'Chine': '🇨🇳',
            'Espagne': '🇪🇸',
            'Allemagne': '🇩🇪',
        };
        return flags[country] || '🌍';
    }

    // Load stats on page load
    loadDashboardStats();
</script>
@endsection

@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-20">
    <div class="w-10 h-10 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
    <p class="mt-4 text-slate-500 text-sm">Chargement...</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Utilisateurs -->
        <div class="elegant-card stat-card accent-blue p-5">
            <div class="glow"></div>
            <div class="flex items-center justify-between mb-3 relative z-10">
                <div class="icon-container w-11 h-11 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <span id="users-growth" class="text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200 hidden">+0%</span>
            </div>
            <p class="text-3xl font-bold stat-value relative z-10" id="total-users">0</p>
            <p class="text-sm text-slate-500 mt-1 font-medium relative z-10">Utilisateurs</p>
            <p class="text-xs text-blue-500 mt-2 font-medium relative z-10" id="new-users-text">+0 ce mois</p>
        </div>

        <!-- Témoignages -->
        <div class="elegant-card stat-card accent-green p-5">
            <div class="glow"></div>
            <div class="flex items-center justify-between mb-3 relative z-10">
                <div class="icon-container w-11 h-11 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-1.5 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span id="avg-rating" class="text-xs font-semibold text-amber-600">0</span>
                </div>
            </div>
            <p class="text-3xl font-bold stat-value relative z-10" id="total-testimonials">0</p>
            <p class="text-sm text-slate-500 mt-1 font-medium relative z-10">Témoignages</p>
            <p class="text-xs text-emerald-500 mt-2 font-medium relative z-10" id="approved-text">0 approuvés</p>
        </div>

        <!-- En attente -->
        <div class="elegant-card stat-card accent-amber p-5">
            <div class="glow"></div>
            <div class="flex items-center justify-between mb-3 relative z-10">
                <div class="icon-container w-11 h-11 bg-gradient-to-br from-amber-100 to-amber-50 rounded-xl flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold stat-value relative z-10" id="pending-testimonials">0</p>
            <p class="text-sm text-slate-500 mt-1 font-medium relative z-10">En attente</p>
            <a href="/admin/testimonials" class="relative z-10 text-xs text-indigo-600 hover:text-indigo-700 font-medium mt-2 inline-flex items-center gap-1 group">
                Modérer
                <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <!-- Ce mois -->
        <div class="elegant-card stat-card accent-violet p-5">
            <div class="glow"></div>
            <div class="flex items-center justify-between mb-3 relative z-10">
                <div class="icon-container w-11 h-11 bg-gradient-to-br from-violet-100 to-violet-50 rounded-xl flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold stat-value relative z-10" id="new-testimonials-month">0</p>
            <p class="text-sm text-slate-500 mt-1 font-medium relative z-10">Ce mois-ci</p>
            <p class="text-xs text-violet-500 mt-2 font-medium relative z-10">Nouveaux témoignages</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Répartition géographique -->
        <div class="lg:col-span-2 elegant-card">
            <div class="section-header p-5 border-b border-slate-100">
                <h3 class="font-semibold text-slate-900">Répartition géographique</h3>
                <p class="text-sm text-slate-500">Utilisateurs par pays</p>
            </div>
            <div id="country-chart" class="p-5 space-y-4">
                <!-- Chargé dynamiquement -->
            </div>
        </div>

        <!-- Activité récente -->
        <div class="elegant-card">
            <div class="section-header p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-900">Activité récente</h3>
                <span class="flex items-center gap-1.5 text-xs text-emerald-600">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    En direct
                </span>
            </div>
            <div id="activity-feed" class="divide-y divide-slate-100 max-h-80 overflow-y-auto elegant-scroll">
                <!-- Chargé dynamiquement -->
            </div>
        </div>
    </div>

    <!-- Listes récentes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Derniers témoignages -->
        <div class="elegant-card">
            <div class="section-header p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-900">Derniers témoignages</h3>
                <a href="/admin/testimonials" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium transition-colors">Tout voir</a>
            </div>
            <div id="recent-testimonials" class="divide-y divide-slate-100 elegant-scroll">
                <!-- Chargé dynamiquement -->
            </div>
        </div>

        <!-- Nouveaux utilisateurs -->
        <div class="elegant-card">
            <div class="section-header p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-900">Nouveaux utilisateurs</h3>
                <a href="/admin/users" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium transition-colors">Tout voir</a>
            </div>
            <div id="recent-users" class="divide-y divide-slate-100 elegant-scroll">
                <!-- Chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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

            if (!response.ok) throw new Error('Erreur');

            const result = await response.json();
            const data = result.data;

            // Afficher le contenu
            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');

            // Mettre à jour les stats
            document.getElementById('total-users').textContent = data.users.total;
            document.getElementById('new-users-text').textContent = `+${data.users.new_this_month} ce mois`;
            document.getElementById('total-testimonials').textContent = data.testimonials.total;
            document.getElementById('approved-text').textContent = `${data.testimonials.approved} approuvés`;
            document.getElementById('pending-testimonials').textContent = data.testimonials.pending;
            document.getElementById('new-testimonials-month').textContent = data.testimonials.new_this_month;
            document.getElementById('avg-rating').textContent = data.testimonials.average_rating || '0';

            // Badge croissance
            const growthEl = document.getElementById('users-growth');
            if (data.users.growth_percentage !== 0) {
                growthEl.textContent = (data.users.growth_percentage >= 0 ? '+' : '') + data.users.growth_percentage + '%';
                growthEl.className = `text-xs font-medium px-2 py-1 rounded-full ${data.users.growth_percentage >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'}`;
                growthEl.classList.remove('hidden');
            }

            // Graphique pays
            renderCountryChart(data.users_by_country);

            // Activité
            renderActivityFeed(data.recent_testimonials, data.recent_users);

            // Témoignages récents
            renderRecentTestimonials(data.recent_testimonials);

            // Utilisateurs récents
            renderRecentUsers(data.recent_users);

        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `
                <div class="text-center">
                    <p class="text-red-500 mb-4">Erreur de chargement</p>
                    <button onclick="loadDashboardStats()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Réessayer</button>
                </div>
            `;
        }
    }

    function renderCountryChart(countries) {
        const container = document.getElementById('country-chart');

        if (!countries || countries.length === 0) {
            container.innerHTML = '<p class="text-slate-400 text-sm text-center py-8">Aucune donnée disponible</p>';
            return;
        }

        const maxTotal = Math.max(...countries.map(c => c.total));
        const colors = ['bg-indigo-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-violet-500'];

        container.innerHTML = countries.slice(0, 5).map((country, i) => {
            const pct = Math.round((country.total / maxTotal) * 100);
            return `
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="text-base">${getCountryFlag(country.country)}</span>
                            <span class="text-sm text-slate-700">${country.country || 'Non spécifié'}</span>
                        </div>
                        <span class="text-sm font-medium text-slate-900">${country.total} <span class="text-slate-400 text-xs">(${pct}%)</span></span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full ${colors[i % colors.length]} rounded-full transition-all duration-500" style="width: ${pct}%"></div>
                    </div>
                </div>
            `;
        }).join('');
    }

    function renderActivityFeed(testimonials, users) {
        const container = document.getElementById('activity-feed');

        const activities = [
            ...testimonials.slice(0, 3).map(t => ({ type: 'testimonial', name: t.user_name, status: t.is_approved })),
            ...users.slice(0, 3).map(u => ({ type: 'user', name: u.name, country: u.country }))
        ];

        if (activities.length === 0) {
            container.innerHTML = '<p class="text-slate-400 text-sm text-center py-8">Aucune activité</p>';
            return;
        }

        container.innerHTML = activities.map(a => {
            if (a.type === 'testimonial') {
                return `
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-900 truncate">${a.name}</p>
                            <p class="text-xs text-slate-500">Nouveau témoignage</p>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full ${a.status ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">${a.status ? 'Approuvé' : 'En attente'}</span>
                    </div>
                `;
            } else {
                return `
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-indigo-600 font-semibold text-xs">${a.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-900 truncate">${a.name}</p>
                            <p class="text-xs text-slate-500">Nouvel utilisateur</p>
                        </div>
                        <span class="text-base">${getCountryFlag(a.country)}</span>
                    </div>
                `;
            }
        }).join('');
    }

    function renderRecentTestimonials(testimonials) {
        const container = document.getElementById('recent-testimonials');

        if (!testimonials || testimonials.length === 0) {
            container.innerHTML = '<p class="text-slate-400 text-sm text-center py-8">Aucun témoignage</p>';
            return;
        }

        container.innerHTML = testimonials.slice(0, 4).map(t => `
            <div class="p-4 flex items-start gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-semibold text-xs">${t.user_name.charAt(0).toUpperCase()}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-sm font-medium text-slate-900 truncate">${t.user_name}</p>
                        <div class="flex gap-0.5">
                            ${[1,2,3,4,5].map(i => `<svg class="w-3 h-3 ${i <= t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`).join('')}
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 line-clamp-1 mt-1">${t.content}</p>
                    <div class="flex items-center gap-2 mt-1.5">
                        <span class="text-[10px] px-1.5 py-0.5 rounded ${t.is_approved ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">${t.is_approved ? 'Approuvé' : 'En attente'}</span>
                        <span class="text-[10px] text-slate-400">${t.created_at}</span>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function renderRecentUsers(users) {
        const container = document.getElementById('recent-users');

        if (!users || users.length === 0) {
            container.innerHTML = '<p class="text-slate-400 text-sm text-center py-8">Aucun utilisateur</p>';
            return;
        }

        container.innerHTML = users.slice(0, 4).map(u => `
            <div class="p-4 flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-semibold text-xs">${u.name.charAt(0).toUpperCase()}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 truncate">${u.name}</p>
                    <p class="text-xs text-slate-500 truncate">${u.email}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-base">${getCountryFlag(u.country)}</span>
                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-700">Actif</span>
                </div>
            </div>
        `).join('');
    }

    function getCountryFlag(country) {
        const flags = {
            'France': '🇫🇷', 'Cameroun': '🇨🇲', 'Sénégal': '🇸🇳', 'Côte d\'Ivoire': '🇨🇮',
            'Mali': '🇲🇱', 'Guinée': '🇬🇳', 'Bénin': '🇧🇯', 'Togo': '🇹🇬',
            'Burkina Faso': '🇧🇫', 'burkina': '🇧🇫', 'Niger': '🇳🇪', 'Congo': '🇨🇬',
            'Gabon': '🇬🇦', 'Maroc': '🇲🇦', 'Algérie': '🇩🇿', 'Tunisie': '🇹🇳',
            'Chine': '🇨🇳', 'Espagne': '🇪🇸', 'Allemagne': '🇩🇪'
        };
        return flags[country] || '🌍';
    }

    loadDashboardStats();
</script>
@endsection

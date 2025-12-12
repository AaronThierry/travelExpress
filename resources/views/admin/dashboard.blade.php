@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Vue d\'ensemble de votre plateforme Travel Express')

@section('content')
<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-20">
    <div class="relative">
        <div class="w-16 h-16 border-4 border-indigo-200 rounded-full"></div>
        <div class="absolute top-0 left-0 w-16 h-16 border-4 border-indigo-600 rounded-full animate-spin border-t-transparent"></div>
    </div>
    <p class="mt-4 text-slate-600 font-medium">Chargement des statistiques...</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden space-y-4 sm:space-y-6 lg:space-y-8">

    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-xl lg:rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 p-4 sm:p-6 lg:p-8 text-white">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 lg:w-64 h-48 lg:h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 lg:w-48 h-32 lg:h-48 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold mb-1 sm:mb-2">Bienvenue sur votre Dashboard</h2>
            <p class="text-indigo-100 text-sm sm:text-base max-w-xl">Gérez votre plateforme Travel Express et modérez les témoignages.</p>
        </div>
        <div class="absolute bottom-4 right-4 lg:bottom-6 lg:right-8 hidden md:block">
            <svg class="w-20 lg:w-32 h-20 lg:h-32 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
        <!-- Total Users -->
        <div class="stat-card group">
            <div class="flex items-start justify-between gap-2">
                <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span id="users-growth" class="text-[10px] sm:text-xs lg:text-sm font-semibold px-1.5 sm:px-2 lg:px-3 py-0.5 sm:py-1 rounded-full hidden sm:inline-block"></span>
            </div>
            <div class="mt-3 sm:mt-4">
                <p class="text-slate-500 text-[11px] sm:text-xs lg:text-sm font-medium">Utilisateurs</p>
                <p id="total-users" class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-0.5 sm:mt-1">0</p>
            </div>
            <div class="mt-2 sm:mt-3 pt-2 sm:pt-3 border-t border-slate-100 hidden sm:block">
                <p id="new-users" class="text-xs sm:text-sm text-slate-500 flex items-center gap-1">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="truncate"></span>
                </p>
            </div>
        </div>

        <!-- Total Testimonials -->
        <div class="stat-card group">
            <div class="flex items-start justify-between gap-2">
                <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div class="hidden sm:flex items-center gap-1 bg-amber-50 px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-lg">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span id="avg-rating" class="text-[10px] sm:text-xs lg:text-sm font-semibold text-amber-700">0</span>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <p class="text-slate-500 text-[11px] sm:text-xs lg:text-sm font-medium">Témoignages</p>
                <p id="total-testimonials" class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-0.5 sm:mt-1">0</p>
            </div>
            <div class="mt-2 sm:mt-3 pt-2 sm:pt-3 border-t border-slate-100 hidden sm:block">
                <p id="approved-testimonials" class="text-xs sm:text-sm text-emerald-600 font-medium truncate"></p>
            </div>
        </div>

        <!-- Pending Testimonials -->
        <div class="stat-card group">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <p class="text-slate-500 text-[11px] sm:text-xs lg:text-sm font-medium">En attente</p>
                <p id="pending-testimonials" class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-0.5 sm:mt-1">0</p>
            </div>
            <div class="mt-2 sm:mt-3 pt-2 sm:pt-3 border-t border-slate-100 hidden sm:block">
                <a href="/admin/testimonials" class="text-[11px] sm:text-xs lg:text-sm text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center gap-1 group/link">
                    <span class="truncate">Gérer</span>
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 group-hover/link:translate-x-1 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- This Month -->
        <div class="stat-card group">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/30 group-hover:scale-110 transition-transform flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <p class="text-slate-500 text-[11px] sm:text-xs lg:text-sm font-medium">Ce mois</p>
                <p id="new-testimonials-month" class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 mt-0.5 sm:mt-1">0</p>
            </div>
            <div class="mt-2 sm:mt-3 pt-2 sm:pt-3 border-t border-slate-100 hidden sm:block">
                <p class="text-[11px] sm:text-xs lg:text-sm text-slate-500 truncate">Nouveaux témoignages</p>
            </div>
        </div>
    </div>

    <!-- Charts and Lists -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        <!-- Users by Country -->
        <div class="bg-white rounded-xl lg:rounded-2xl shadow-sm border border-slate-200 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <div class="min-w-0">
                    <h3 class="text-sm sm:text-base lg:text-lg font-bold text-slate-900">Répartition géographique</h3>
                    <p class="text-xs sm:text-sm text-slate-500 hidden sm:block">Utilisateurs par pays</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-slate-100 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div id="users-by-country" class="space-y-3 sm:space-y-4">
                <!-- Will be populated dynamically -->
            </div>
        </div>

        <!-- Recent Testimonials -->
        <div class="bg-white rounded-xl lg:rounded-2xl shadow-sm border border-slate-200 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <div class="min-w-0">
                    <h3 class="text-sm sm:text-base lg:text-lg font-bold text-slate-900">Témoignages récents</h3>
                    <p class="text-xs sm:text-sm text-slate-500 hidden sm:block">Derniers avis reçus</p>
                </div>
                <a href="/admin/testimonials" class="text-xs sm:text-sm text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center gap-1 group flex-shrink-0">
                    <span class="hidden sm:inline">Voir tout</span>
                    <span class="sm:hidden">Tout</span>
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            <div id="recent-testimonials" class="space-y-3 sm:space-y-4">
                <!-- Will be populated dynamically -->
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div class="bg-white rounded-xl lg:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-slate-200">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="min-w-0">
                    <h3 class="text-sm sm:text-base lg:text-lg font-bold text-slate-900">Nouveaux utilisateurs</h3>
                    <p class="text-xs sm:text-sm text-slate-500">Inscriptions récentes</p>
                </div>
                <a href="/admin/users" class="px-3 sm:px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg font-semibold text-xs sm:text-sm hover:bg-indigo-100 transition-colors inline-flex items-center gap-2 justify-center sm:justify-start flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="hidden sm:inline">Gérer les utilisateurs</span>
                    <span class="sm:hidden">Gérer</span>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Pays</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Date</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody id="recent-users" class="divide-y divide-slate-100">
                    <!-- Will be populated dynamically -->
                </tbody>
            </table>
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

            if (!response.ok) {
                throw new Error('Erreur lors du chargement des statistiques');
            }

            const result = await response.json();
            const data = result.data;

            // Update stats cards
            document.getElementById('total-users').textContent = data.users.total.toLocaleString();
            document.getElementById('new-users').querySelector('span').textContent = `+${data.users.new_this_month} ce mois-ci`;

            const growthEl = document.getElementById('users-growth');
            if (data.users.growth_percentage >= 0) {
                growthEl.textContent = `+${data.users.growth_percentage}%`;
                growthEl.className = 'text-sm font-semibold px-3 py-1 rounded-full bg-emerald-100 text-emerald-700';
            } else {
                growthEl.textContent = `${data.users.growth_percentage}%`;
                growthEl.className = 'text-sm font-semibold px-3 py-1 rounded-full bg-red-100 text-red-700';
            }

            document.getElementById('total-testimonials').textContent = data.testimonials.total.toLocaleString();
            document.getElementById('approved-testimonials').textContent = `${data.testimonials.approved} approuvés`;
            document.getElementById('pending-testimonials').textContent = data.testimonials.pending.toLocaleString();
            document.getElementById('new-testimonials-month').textContent = data.testimonials.new_this_month.toLocaleString();
            document.getElementById('avg-rating').textContent = data.testimonials.average_rating || '0';

            // Users by country
            const countryEl = document.getElementById('users-by-country');
            if (data.users_by_country.length === 0) {
                countryEl.innerHTML = `
                    <div class="text-center py-6 sm:py-8">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-slate-300 mx-auto mb-2 sm:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-slate-500 text-xs sm:text-sm">Aucune donnée géographique disponible</p>
                    </div>
                `;
            } else {
                const maxTotal = Math.max(...data.users_by_country.map(c => c.total));
                const colors = ['bg-indigo-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-violet-500'];
                countryEl.innerHTML = data.users_by_country.map((country, index) => `
                    <div class="group">
                        <div class="flex items-center justify-between mb-1.5 sm:mb-2">
                            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-md sm:rounded-lg ${colors[index % colors.length]} bg-opacity-20 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm sm:text-lg">${getCountryFlag(country.country)}</span>
                                </div>
                                <span class="text-xs sm:text-sm font-medium text-slate-700 truncate">${country.country || 'Non spécifié'}</span>
                            </div>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 flex-shrink-0 ml-2">${country.total}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 sm:h-2 overflow-hidden">
                            <div class="${colors[index % colors.length]} h-1.5 sm:h-2 rounded-full transition-all duration-500" style="width: ${(country.total / maxTotal) * 100}%"></div>
                        </div>
                    </div>
                `).join('');
            }

            // Recent testimonials
            const testimonialsEl = document.getElementById('recent-testimonials');
            if (data.recent_testimonials.length === 0) {
                testimonialsEl.innerHTML = `
                    <div class="text-center py-6 sm:py-8">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-slate-300 mx-auto mb-2 sm:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-slate-500 text-xs sm:text-sm">Aucun témoignage récent</p>
                    </div>
                `;
            } else {
                testimonialsEl.innerHTML = data.recent_testimonials.map(t => `
                    <div class="p-3 sm:p-4 rounded-lg sm:rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1.5 sm:mb-2">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-[10px] sm:text-xs font-bold">${t.user_name.charAt(0).toUpperCase()}</span>
                                    </div>
                                    <p class="text-xs sm:text-sm font-semibold text-slate-900 truncate">${t.user_name}</p>
                                    <div class="flex items-center gap-0.5 sm:hidden ml-auto flex-shrink-0">
                                        ${Array(5).fill(0).map((_, i) => `
                                            <svg class="w-3 h-3 ${i < t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        `).join('')}
                                    </div>
                                </div>
                                <p class="text-xs sm:text-sm text-slate-600 line-clamp-2">${t.content}</p>
                                <div class="flex items-center gap-2 sm:gap-3 mt-2 sm:mt-3">
                                    <span class="text-[10px] sm:text-xs px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full font-medium ${t.is_approved ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">
                                        ${t.is_approved ? '✓ Approuvé' : '⏳ En attente'}
                                    </span>
                                    <span class="text-[10px] sm:text-xs text-slate-400">${t.created_at}</span>
                                </div>
                            </div>
                            <div class="hidden sm:flex items-center gap-0.5 flex-shrink-0">
                                ${Array(5).fill(0).map((_, i) => `
                                    <svg class="w-4 h-4 ${i < t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                `).join('')}
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            // Recent users
            const usersEl = document.getElementById('recent-users');
            if (data.recent_users.length === 0) {
                usersEl.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-3 sm:px-6 py-8 sm:py-12 text-center">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-slate-300 mx-auto mb-2 sm:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-slate-500 text-xs sm:text-sm">Aucun nouvel utilisateur cette semaine</p>
                        </td>
                    </tr>
                `;
            } else {
                usersEl.innerHTML = data.recent_users.map(user => `
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-3 sm:px-6 py-3 sm:py-4">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-md flex-shrink-0">
                                    <span class="text-white font-bold text-xs sm:text-sm">${user.name.charAt(0).toUpperCase()}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs sm:text-sm font-semibold text-slate-900 truncate">${user.name}</p>
                                    <p class="text-[10px] sm:text-xs text-slate-500">ID: ${user.id}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 sm:px-6 py-3 sm:py-4 hidden sm:table-cell">
                            <p class="text-xs sm:text-sm text-slate-600 truncate max-w-[150px] lg:max-w-none">${user.email}</p>
                        </td>
                        <td class="px-3 sm:px-6 py-3 sm:py-4">
                            <span class="inline-flex items-center gap-1 sm:gap-1.5 text-xs sm:text-sm text-slate-600">
                                <span class="text-sm sm:text-base">${getCountryFlag(user.country)}</span>
                                <span class="hidden sm:inline">${user.country || '-'}</span>
                            </span>
                        </td>
                        <td class="px-3 sm:px-6 py-3 sm:py-4 hidden md:table-cell">
                            <p class="text-xs sm:text-sm text-slate-600">${new Date(user.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })}</p>
                        </td>
                        <td class="px-3 sm:px-6 py-3 sm:py-4">
                            <span class="px-2 sm:px-3 py-0.5 sm:py-1 text-[10px] sm:text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">Actif</span>
                        </td>
                    </tr>
                `).join('');
            }

            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `
                <div class="bg-red-50 border border-red-200 rounded-xl sm:rounded-2xl p-4 sm:p-8 text-center max-w-md mx-auto">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-red-400 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-base sm:text-lg font-bold text-red-800 mb-1.5 sm:mb-2">Erreur de chargement</h3>
                    <p class="text-red-600 text-xs sm:text-sm mb-3 sm:mb-4">Impossible de récupérer les statistiques</p>
                    <button onclick="loadDashboardStats()" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-red-600 text-white rounded-lg font-semibold text-xs sm:text-sm hover:bg-red-700 transition-colors">
                        Réessayer
                    </button>
                </div>
            `;
        }
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

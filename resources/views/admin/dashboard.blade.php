@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Vue d\'ensemble de votre plateforme Travel Express')

@section('content')
<!-- Loading State -->
<div id="loading" class="text-center py-12">
    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
    <p class="mt-2 text-gray-600">Chargement des statistiques...</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span id="users-growth" class="text-sm font-medium px-2 py-1 rounded-full"></span>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">Utilisateurs</p>
            <p id="total-users" class="text-3xl font-bold text-gray-900">0</p>
            <p id="new-users" class="text-xs text-gray-500 mt-2"></p>
        </div>

        <!-- Total Testimonials -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span id="avg-rating" class="text-sm font-medium text-gray-700">0</span>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">Témoignages</p>
            <p id="total-testimonials" class="text-3xl font-bold text-gray-900">0</p>
            <p id="approved-testimonials" class="text-xs text-gray-500 mt-2"></p>
        </div>

        <!-- Pending Testimonials -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">En attente</p>
            <p id="pending-testimonials" class="text-3xl font-bold text-gray-900">0</p>
            <a href="/admin/testimonials" class="text-xs text-primary-600 hover:text-primary-700 mt-2 inline-block font-medium">
                Gérer les témoignages →
            </a>
        </div>

        <!-- This Month -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">Ce mois-ci</p>
            <p id="new-testimonials-month" class="text-3xl font-bold text-gray-900">0</p>
            <p class="text-xs text-gray-500 mt-2">Nouveaux témoignages</p>
        </div>
    </div>

    <!-- Charts and Lists -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Users by Country -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Utilisateurs par pays</h3>
            <div id="users-by-country" class="space-y-3">
                <!-- Will be populated dynamically -->
            </div>
        </div>

        <!-- Recent Testimonials -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Témoignages récents</h3>
                <a href="/admin/testimonials" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    Voir tout →
                </a>
            </div>
            <div id="recent-testimonials" class="space-y-3">
                <!-- Will be populated dynamically -->
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Nouveaux utilisateurs (7 derniers jours)</h3>
            <a href="/admin/users" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                Voir tout →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pays</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                    </tr>
                </thead>
                <tbody id="recent-users" class="bg-white divide-y divide-gray-200">
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
            document.getElementById('new-users').textContent = `+${data.users.new_this_month} ce mois-ci`;

            const growthEl = document.getElementById('users-growth');
            if (data.users.growth_percentage >= 0) {
                growthEl.textContent = `+${data.users.growth_percentage}%`;
                growthEl.className = 'text-sm font-medium px-2 py-1 rounded-full bg-green-100 text-green-800';
            } else {
                growthEl.textContent = `${data.users.growth_percentage}%`;
                growthEl.className = 'text-sm font-medium px-2 py-1 rounded-full bg-red-100 text-red-800';
            }

            document.getElementById('total-testimonials').textContent = data.testimonials.total.toLocaleString();
            document.getElementById('approved-testimonials').textContent = `${data.testimonials.approved} approuvés`;
            document.getElementById('pending-testimonials').textContent = data.testimonials.pending.toLocaleString();
            document.getElementById('new-testimonials-month').textContent = data.testimonials.new_this_month.toLocaleString();
            document.getElementById('avg-rating').textContent = data.testimonials.average_rating || '0';

            // Users by country
            const countryEl = document.getElementById('users-by-country');
            if (data.users_by_country.length === 0) {
                countryEl.innerHTML = '<p class="text-gray-500 text-sm">Aucune donnée disponible</p>';
            } else {
                countryEl.innerHTML = data.users_by_country.map(country => `
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">${country.country || 'Non spécifié'}</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-600 h-2 rounded-full" style="width: ${(country.total / data.users.total) * 100}%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900 w-8 text-right">${country.total}</span>
                        </div>
                    </div>
                `).join('');
            }

            // Recent testimonials
            const testimonialsEl = document.getElementById('recent-testimonials');
            if (data.recent_testimonials.length === 0) {
                testimonialsEl.innerHTML = '<p class="text-gray-500 text-sm">Aucun témoignage récent</p>';
            } else {
                testimonialsEl.innerHTML = data.recent_testimonials.map(t => `
                    <div class="border-l-4 ${t.is_approved ? 'border-green-500' : 'border-yellow-500'} pl-3 py-2">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-gray-900">${t.user_name}</p>
                            <div class="flex items-center gap-1">
                                ${Array(5).fill(0).map((_, i) => `
                                    <svg class="w-3 h-3 ${i < t.rating ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                `).join('')}
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 line-clamp-2">${t.content}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs px-2 py-0.5 rounded-full ${t.is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${t.is_approved ? 'Approuvé' : 'En attente'}
                            </span>
                            <span class="text-xs text-gray-500">${t.created_at}</span>
                        </div>
                    </div>
                `).join('');
            }

            // Recent users
            const usersEl = document.getElementById('recent-users');
            if (data.recent_users.length === 0) {
                usersEl.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center text-gray-500 text-sm">Aucun nouvel utilisateur</td></tr>';
            } else {
                usersEl.innerHTML = data.recent_users.map(user => `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                                    <span class="text-primary-600 font-bold text-sm">${user.name.charAt(0).toUpperCase()}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">${user.name}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.email}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.country || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${new Date(user.created_at).toLocaleDateString('fr-FR')}</td>
                    </tr>
                `).join('');
            }

            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <p>Erreur lors du chargement des statistiques</p>
                </div>
            `;
        }
    }

    // Load stats on page load
    loadDashboardStats();
</script>
@endsection

@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<style>
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

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }
        50% {
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.6s ease-out forwards;
    }

    .stat-card-modern {
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card-modern::before {
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

    .stat-card-modern:hover::before {
        opacity: 1;
    }

    .stat-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .stat-number {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .progress-ring {
        transform: rotate(-90deg);
        transform-origin: center;
    }

    .progress-ring-circle {
        transition: stroke-dashoffset 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .shimmer {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .activity-dot {
        animation: pulse-dot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse-dot {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.5;
            transform: scale(1.2);
        }
    }
</style>

<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-20">
    <div class="relative">
        <div class="w-16 h-16 border-4 border-indigo-100 rounded-full"></div>
        <div class="w-16 h-16 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin absolute top-0"></div>
    </div>
    <p class="mt-6 text-slate-600 text-sm font-medium">Chargement du tableau de bord...</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden space-y-6">

    <!-- Welcome Header -->
    <div class="elegant-card p-8 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Bienvenue sur votre tableau de bord</h1>
                    <p class="text-indigo-100">Voici un aperçu de votre activité récente</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 bg-white/20 backdrop-blur rounded-lg">
                        <p class="text-xs text-indigo-100">Aujourd'hui</p>
                        <p class="text-lg font-bold" id="current-date">-</p>
                    </div>
                    <div class="px-4 py-2 bg-white/20 backdrop-blur rounded-lg">
                        <p class="text-xs text-indigo-100">Heure</p>
                        <p class="text-lg font-bold" id="current-time">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards - Premium Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Utilisateurs Card -->
        <div class="stat-card-modern elegant-card p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border-blue-100">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span id="users-growth" class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 hidden">+0%</span>
            </div>
            <div>
                <h3 class="text-sm font-medium text-slate-600 mb-2">Total Utilisateurs</h3>
                <p class="text-4xl font-black text-blue-600 mb-1" id="total-users">0</p>
                <p class="text-sm text-blue-500 font-medium" id="new-users-text">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                        </svg>
                        +0 ce mois
                    </span>
                </p>
            </div>
        </div>

        <!-- Témoignages Card -->
        <div class="stat-card-modern elegant-card p-6 bg-gradient-to-br from-emerald-50 to-teal-50 border-emerald-100">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1 bg-amber-100 rounded-full">
                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span id="avg-rating" class="text-xs font-bold text-amber-700">0</span>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-medium text-slate-600 mb-2">Témoignages</h3>
                <p class="text-4xl font-black text-emerald-600 mb-1" id="total-testimonials">0</p>
                <p class="text-sm text-emerald-500 font-medium" id="approved-text">0 approuvés</p>
            </div>
        </div>

        <!-- En attente Card -->
        <div class="stat-card-modern elegant-card p-6 bg-gradient-to-br from-amber-50 to-orange-50 border-amber-100">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="activity-dot w-3 h-3 bg-amber-500 rounded-full"></div>
            </div>
            <div>
                <h3 class="text-sm font-medium text-slate-600 mb-2">En attente</h3>
                <p class="text-4xl font-black text-amber-600 mb-1" id="pending-testimonials">0</p>
                <a href="/admin/testimonials" class="text-sm text-amber-600 hover:text-amber-700 font-medium inline-flex items-center gap-1 group">
                    Modérer maintenant
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Ce mois Card -->
        <div class="stat-card-modern elegant-card p-6 bg-gradient-to-br from-violet-50 to-purple-50 border-violet-100">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-medium text-slate-600 mb-2">Ce mois-ci</h3>
                <p class="text-4xl font-black text-violet-600 mb-1" id="new-testimonials-month">0</p>
                <p class="text-sm text-violet-500 font-medium">Nouveaux témoignages</p>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Répartition géographique -->
        <div class="lg:col-span-2 elegant-card overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-transparent">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Répartition géographique</h3>
                        <p class="text-sm text-slate-500 mt-1">Vos utilisateurs dans le monde</p>
                    </div>
                    <div class="p-3 bg-indigo-100 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div id="country-chart" class="p-6 space-y-4">
                <!-- Chargé dynamiquement -->
            </div>
        </div>

        <!-- Activité récente -->
        <div class="elegant-card overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-transparent">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Activité récente</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-xs text-emerald-600 font-medium">En direct</span>
                        </div>
                    </div>
                    <div class="p-3 bg-emerald-100 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div id="activity-feed" class="divide-y divide-slate-100 max-h-80 overflow-y-auto elegant-scroll">
                <!-- Chargé dynamiquement -->
            </div>
        </div>
    </div>

    <!-- Listes récentes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Derniers témoignages -->
        <div class="elegant-card overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-indigo-50 to-transparent">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Derniers témoignages</h3>
                        <p class="text-sm text-slate-500 mt-1">Récemment ajoutés</p>
                    </div>
                    <a href="/admin/testimonials" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors inline-flex items-center gap-2">
                        Voir tout
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="recent-testimonials" class="divide-y divide-slate-100 max-h-96 overflow-y-auto elegant-scroll">
                <!-- Chargé dynamiquement -->
            </div>
        </div>

        <!-- Nouveaux utilisateurs -->
        <div class="elegant-card overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-blue-50 to-transparent">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Nouveaux utilisateurs</h3>
                        <p class="text-sm text-slate-500 mt-1">Dernières inscriptions</p>
                    </div>
                    <a href="/admin/users" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors inline-flex items-center gap-2">
                        Voir tout
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="recent-users" class="divide-y divide-slate-100 max-h-96 overflow-y-auto elegant-scroll">
                <!-- Chargé dynamiquement -->
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Update time
    function updateTime() {
        const now = new Date();
        document.getElementById('current-date').textContent = now.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: 'short'
        });
        document.getElementById('current-time').textContent = now.toLocaleTimeString('fr-FR', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }
    setInterval(updateTime, 1000);
    updateTime();

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

            // Afficher le contenu avec animation
            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');

            // Animer les chiffres
            animateValue('total-users', 0, data.users.total, 1000);
            animateValue('total-testimonials', 0, data.testimonials.total, 1000);
            animateValue('pending-testimonials', 0, data.testimonials.pending, 1000);
            animateValue('new-testimonials-month', 0, data.testimonials.new_this_month, 1000);

            document.getElementById('new-users-text').innerHTML = `
                <span class="inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                    </svg>
                    +${data.users.new_this_month} ce mois
                </span>
            `;
            document.getElementById('approved-text').textContent = `${data.testimonials.approved} approuvés`;
            document.getElementById('avg-rating').textContent = data.testimonials.average_rating || '0';

            // Badge croissance
            const growthEl = document.getElementById('users-growth');
            if (data.users.growth_percentage !== 0) {
                growthEl.textContent = (data.users.growth_percentage >= 0 ? '+' : '') + data.users.growth_percentage + '%';
                growthEl.className = `text-xs font-bold px-3 py-1 rounded-full ${data.users.growth_percentage >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'}`;
                growthEl.classList.remove('hidden');
            }

            // Charger les sections
            renderCountryChart(data.users_by_country);
            renderActivityFeed(data.recent_testimonials, data.recent_users);
            renderRecentTestimonials(data.recent_testimonials);
            renderRecentUsers(data.recent_users);

        } catch (error) {
            console.error('Error:', error);
            loadingEl.innerHTML = `
                <div class="text-center">
                    <svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-600 font-medium mb-4">Erreur de chargement des données</p>
                    <button onclick="loadDashboardStats()" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">
                        Réessayer
                    </button>
                </div>
            `;
        }
    }

    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        if (!obj) return;

        // Ensure positive values
        end = Math.max(0, end);
        const range = end - start;
        if (range === 0) {
            obj.textContent = end;
            return;
        }

        const increment = end > start ? 1 : -1;
        const stepTime = Math.abs(Math.floor(duration / range));
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            obj.textContent = current;
            if (current === end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    function renderCountryChart(countries) {
        const container = document.getElementById('country-chart');

        if (!countries || countries.length === 0) {
            container.innerHTML = `
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-slate-400 text-sm">Aucune donnée disponible</p>
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
            'from-violet-500 to-purple-600'
        ];

        container.innerHTML = countries.slice(0, 5).map((country, i) => {
            const pct = Math.round((country.total / maxTotal) * 100);
            return `
                <div class="group">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">${getCountryFlag(country.country)}</span>
                            <span class="text-sm font-medium text-slate-700">${country.country || 'Non spécifié'}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-slate-900">${country.total}</span>
                            <span class="text-xs text-slate-400 font-medium">${pct}%</span>
                        </div>
                    </div>
                    <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r ${gradients[i % gradients.length]} rounded-full transition-all duration-1000 ease-out" style="width: 0%" data-width="${pct}%"></div>
                    </div>
                </div>
            `;
        }).join('');

        // Animate bars
        setTimeout(() => {
            container.querySelectorAll('[data-width]').forEach(bar => {
                bar.style.width = bar.getAttribute('data-width');
            });
        }, 100);
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
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <p class="text-slate-400 text-sm">Aucune activité récente</p>
                </div>
            `;
            return;
        }

        container.innerHTML = activities.map((a, i) => {
            const delay = i * 100;
            if (a.type === 'testimonial') {
                return `
                    <div class="p-4 hover:bg-slate-50 transition-colors animate-fade-in-up" style="animation-delay: ${delay}ms">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900 truncate">${a.name}</p>
                                <p class="text-xs text-slate-500">Nouveau témoignage</p>
                            </div>
                            <span class="text-xs px-2.5 py-1 rounded-full font-medium ${a.status ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">${a.status ? 'Approuvé' : 'En attente'}</span>
                        </div>
                    </div>
                `;
            } else {
                return `
                    <div class="p-4 hover:bg-slate-50 transition-colors animate-fade-in-up" style="animation-delay: ${delay}ms">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <span class="text-white font-bold text-sm">${a.name.charAt(0).toUpperCase()}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900 truncate">${a.name}</p>
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
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <p class="text-slate-400 text-sm">Aucun témoignage</p>
                </div>
            `;
            return;
        }

        container.innerHTML = testimonials.slice(0, 5).map((t, i) => {
            const avatarHtml = t.user_avatar
                ? `<img src="/storage/${t.user_avatar}" alt="${t.user_name}" class="w-12 h-12 rounded-xl object-cover flex-shrink-0 shadow-md ring-2 ring-white">`
                : `<div class="w-12 h-12 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md ring-2 ring-white">
                        <span class="text-white font-bold">${t.user_name.charAt(0).toUpperCase()}</span>
                   </div>`;

            return `
            <div class="p-4 hover:bg-gradient-to-r hover:from-slate-50 hover:to-transparent transition-all duration-300 animate-slide-in-right" style="animation-delay: ${i * 100}ms">
                <div class="flex items-start gap-4">
                    ${avatarHtml}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <p class="text-sm font-bold text-slate-900">${t.user_name}</p>
                            <div class="flex gap-0.5">
                                ${[1,2,3,4,5].map(i => `<svg class="w-3.5 h-3.5 ${i <= t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`).join('')}
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-base">${getCountryFlag(t.user_country)}</span>
                            <span class="text-xs text-slate-500">${t.user_country || 'N/A'}</span>
                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            <span class="text-base">${getCountryFlag(t.destination)}</span>
                            <span class="text-xs font-medium text-indigo-600">${t.destination || 'N/A'}</span>
                        </div>
                        <p class="text-xs text-slate-600 line-clamp-2 mb-2">${t.content}</p>
                        <div class="flex items-center gap-2">
                            <span class="text-xs px-2 py-1 rounded-full font-medium ${t.is_approved ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'}">${t.is_approved ? 'Approuvé' : 'En attente'}</span>
                            <span class="text-[10px] text-slate-400">${new Date(t.created_at).toLocaleDateString('fr-FR')}</span>
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
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <p class="text-slate-400 text-sm">Aucun utilisateur</p>
                </div>
            `;
            return;
        }

        container.innerHTML = users.slice(0, 5).map((u, i) => `
            <div class="p-4 hover:bg-gradient-to-r hover:from-slate-50 hover:to-transparent transition-all duration-300 animate-slide-in-right" style="animation-delay: ${i * 100}ms">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md ring-2 ring-white">
                        <span class="text-white font-bold">${u.name.charAt(0).toUpperCase()}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-900 truncate">${u.name}</p>
                        <p class="text-xs text-slate-500 truncate">${u.email}</p>
                        <p class="text-[10px] text-slate-400 mt-1">${new Date(u.created_at).toLocaleDateString('fr-FR')}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">${getCountryFlag(u.country)}</span>
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full font-medium">Actif</span>
                    </div>
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

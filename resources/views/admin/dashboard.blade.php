@extends('admin.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --gold: #d4af37;
        --gold-light: #f4e4bc;
        --gold-dark: #b8960c;
        --noir: #0a0a0a;
        --noir-light: #1a1a1a;
        --noir-medium: #2a2a2a;
    }

    .font-display { font-family: 'Playfair Display', serif; }
    .font-body { font-family: 'Outfit', sans-serif; }

    /* Luxurious Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes shimmerGold {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(212, 175, 55, 0.3); }
        50% { box-shadow: 0 0 40px rgba(212, 175, 55, 0.6); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    @keyframes borderGlow {
        0%, 100% { border-color: rgba(212, 175, 55, 0.3); }
        50% { border-color: rgba(212, 175, 55, 0.8); }
    }

    .animate-fade-in { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-pulse-glow { animation: pulseGlow 3s ease-in-out infinite; }

    /* Gold Shimmer Text */
    .gold-shimmer {
        background: linear-gradient(90deg, var(--gold-dark) 0%, var(--gold) 25%, var(--gold-light) 50%, var(--gold) 75%, var(--gold-dark) 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmerGold 4s linear infinite;
    }

    /* Premium Card Styles */
    .luxury-card {
        background: linear-gradient(145deg, var(--noir-light) 0%, var(--noir) 100%);
        border: 1px solid rgba(212, 175, 55, 0.15);
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .luxury-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
        opacity: 0;
        transition: opacity 0.5s;
    }

    .luxury-card:hover {
        transform: translateY(-8px);
        border-color: rgba(212, 175, 55, 0.4);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(212, 175, 55, 0.1);
    }

    .luxury-card:hover::before {
        opacity: 1;
    }

    /* Stat Card with Gold Accent */
    .stat-card {
        background: linear-gradient(145deg, var(--noir-light) 0%, var(--noir) 100%);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
        opacity: 0;
        transition: all 0.5s;
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: rgba(212, 175, 55, 0.5);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), 0 0 50px rgba(212, 175, 55, 0.15);
    }

    .stat-card:hover::after {
        opacity: 1;
        width: 80%;
    }

    /* Gold Icon Container */
    .gold-icon {
        background: linear-gradient(145deg, var(--gold) 0%, var(--gold-dark) 100%);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-card:hover .gold-icon {
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.5);
    }

    /* Progress Bar */
    .progress-track {
        background: rgba(212, 175, 55, 0.1);
        border-radius: 9999px;
        overflow: hidden;
    }

    .progress-fill {
        background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
        border-radius: 9999px;
        transition: width 1.5s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }

    .progress-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmerGold 2s infinite;
    }

    /* Elegant Scrollbar */
    .elegant-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .elegant-scroll::-webkit-scrollbar-track {
        background: var(--noir-medium);
        border-radius: 3px;
    }

    .elegant-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, var(--gold), var(--gold-dark));
        border-radius: 3px;
    }

    /* Decorative Elements */
    .corner-decoration {
        position: absolute;
        width: 60px;
        height: 60px;
        border: 2px solid var(--gold);
        opacity: 0.3;
    }

    .corner-decoration.top-left {
        top: -1px;
        left: -1px;
        border-right: none;
        border-bottom: none;
    }

    .corner-decoration.bottom-right {
        bottom: -1px;
        right: -1px;
        border-left: none;
        border-top: none;
    }

    /* Diamond Pattern Background */
    .diamond-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 0L40 20L20 40L0 20z' fill='%23d4af37' fill-opacity='0.03'/%3E%3C/svg%3E");
    }

    /* List Item Hover */
    .list-item {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .list-item:hover {
        background: linear-gradient(90deg, rgba(212, 175, 55, 0.1) 0%, transparent 100%);
        border-left-color: var(--gold);
    }

    /* Status Badge */
    .badge-gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
        color: var(--noir);
        font-weight: 600;
    }

    .badge-pending {
        background: rgba(212, 175, 55, 0.2);
        color: var(--gold);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }

    /* Loading Spinner */
    .luxury-spinner {
        border: 3px solid rgba(212, 175, 55, 0.1);
        border-top-color: var(--gold);
    }
</style>
@endpush

@section('content')
<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-32">
    <div class="relative mb-8">
        <div class="w-20 h-20 rounded-full luxury-spinner animate-spin"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-8 h-8 bg-gradient-to-br from-[#d4af37] to-[#b8960c] rounded-full animate-pulse"></div>
        </div>
    </div>
    <p class="font-display text-2xl text-[#d4af37] mb-2">Chargement</p>
    <p class="font-body text-gray-500 text-sm tracking-widest uppercase">Veuillez patienter</p>
</div>

<!-- Dashboard Content -->
<div id="dashboard-content" class="hidden space-y-8">

    <!-- Hero Welcome Section -->
    <div class="relative rounded-3xl overflow-hidden luxury-card p-8 md:p-10 diamond-pattern">
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration bottom-right"></div>

        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-radial from-[#d4af37]/10 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-6">
                    <div class="gold-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <span class="px-4 py-2 bg-[#d4af37]/10 border border-[#d4af37]/30 rounded-full text-[#d4af37] text-sm font-body font-medium tracking-wide">
                        Travel Express Admin
                    </span>
                </div>
                <h1 class="font-display text-4xl md:text-5xl text-white mb-4">
                    Bienvenue, <span class="gold-shimmer">@auth {{ explode(' ', auth()->user()->name)[0] }} @else Admin @endauth</span>
                </h1>
                <p class="font-body text-gray-400 text-lg max-w-xl leading-relaxed">
                    Gerez votre agence de voyage avec elegance. Suivez vos statistiques, temoignages et demandes en temps reel.
                </p>
            </div>

            <!-- Date & Time Cards -->
            <div class="flex items-center gap-4">
                <div class="luxury-card rounded-2xl p-6 text-center min-w-[130px]">
                    <p class="font-body text-[#d4af37]/60 text-xs font-medium uppercase tracking-widest mb-2">Date</p>
                    <p class="font-display text-white text-3xl" id="current-date">--</p>
                </div>
                <div class="luxury-card rounded-2xl p-6 text-center min-w-[130px] animate-pulse-glow">
                    <p class="font-body text-[#d4af37]/60 text-xs font-medium uppercase tracking-widest mb-2">Heure</p>
                    <p class="font-display text-[#d4af37] text-3xl" id="current-time">--:--</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- Users -->
        <div class="stat-card p-6 animate-fade-in" style="animation-delay: 0.1s">
            <div class="flex items-start justify-between mb-6">
                <div class="gold-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <p class="font-body text-gray-500 text-sm font-medium tracking-wide uppercase mb-2">Utilisateurs</p>
            <p class="font-display text-5xl text-white mb-3" id="total-users">0</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-[#d4af37] rounded-full"></span>
                <span class="font-body text-sm text-gray-400" id="new-users-text">+0 ce mois</span>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="stat-card p-6 animate-fade-in" style="animation-delay: 0.2s">
            <div class="flex items-start justify-between mb-6">
                <div class="gold-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="flex items-center gap-1 px-3 py-1.5 bg-[#d4af37]/10 rounded-full border border-[#d4af37]/20">
                    <svg class="w-4 h-4 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span id="avg-rating" class="font-body text-sm font-bold text-[#d4af37]">0</span>
                </div>
            </div>
            <p class="font-body text-gray-500 text-sm font-medium tracking-wide uppercase mb-2">Temoignages</p>
            <p class="font-display text-5xl text-white mb-3" id="total-testimonials">0</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                <span class="font-body text-sm text-gray-400" id="approved-text">0 approuves</span>
            </div>
        </div>

        <!-- Evaluations -->
        <div class="stat-card p-6 animate-fade-in" style="animation-delay: 0.3s">
            <div class="flex items-start justify-between mb-6">
                <div class="gold-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="font-body text-gray-500 text-sm font-medium tracking-wide uppercase mb-2">Evaluations</p>
            <p class="font-display text-5xl text-white mb-3" id="total-evaluations">0</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                <span class="font-body text-sm text-gray-400" id="verified-eval-text">0 verifiees</span>
            </div>
        </div>

        <!-- Contact Requests -->
        <div class="stat-card p-6 animate-fade-in" style="animation-delay: 0.4s">
            <div class="flex items-start justify-between mb-6">
                <div class="gold-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="relative">
                    <span class="flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#d4af37] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-[#d4af37]"></span>
                    </span>
                </div>
            </div>
            <p class="font-body text-gray-500 text-sm font-medium tracking-wide uppercase mb-2">Demandes</p>
            <p class="font-display text-5xl text-white mb-3" id="total-contacts">0</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                <span class="font-body text-sm text-[#d4af37]" id="new-contacts-text">0 nouvelles</span>
            </div>
        </div>

        <!-- Student Applications -->
        <div class="stat-card p-6 animate-fade-in" style="animation-delay: 0.5s">
            <div class="flex items-start justify-between mb-6">
                <div class="gold-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
            </div>
            <p class="font-body text-gray-500 text-sm font-medium tracking-wide uppercase mb-2">Dossiers</p>
            <p class="font-display text-5xl text-white mb-3" id="total-applications">0</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                <span class="font-body text-sm text-gray-400" id="pending-apps-text">0 en cours</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Geographic Distribution -->
        <div class="xl:col-span-2 luxury-card rounded-3xl overflow-hidden">
            <div class="p-6 border-b border-[#d4af37]/10 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-xl text-white mb-1">Repartition Geographique</h3>
                    <p class="font-body text-gray-500 text-sm">Vos utilisateurs dans le monde</p>
                </div>
                <div class="gold-icon w-12 h-12 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div id="country-chart" class="p-6 space-y-5 min-h-[320px]">
                <!-- Dynamic content -->
            </div>
        </div>

        <!-- Quick Actions & Activity -->
        <div class="luxury-card rounded-3xl overflow-hidden">
            <div class="p-6 border-b border-[#d4af37]/10 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-xl text-white mb-1">Actions Rapides</h3>
                    <p class="font-body text-gray-500 text-sm">Acces direct aux fonctionnalites</p>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <a href="/admin/contact-requests" class="group flex items-center gap-4 p-4 rounded-2xl bg-[#d4af37]/5 border border-[#d4af37]/20 hover:bg-[#d4af37]/10 hover:border-[#d4af37]/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#d4af37] to-[#b8960c] flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#0a0a0a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-body font-semibold text-white group-hover:text-[#d4af37] transition-colors">Demandes de contact</p>
                        <p class="font-body text-sm text-gray-500">Gerer les nouvelles demandes</p>
                    </div>
                    <svg class="w-5 h-5 text-[#d4af37] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="/admin/evaluations" class="group flex items-center gap-4 p-4 rounded-2xl bg-[#d4af37]/5 border border-[#d4af37]/20 hover:bg-[#d4af37]/10 hover:border-[#d4af37]/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-body font-semibold text-white group-hover:text-[#d4af37] transition-colors">Evaluations</p>
                        <p class="font-body text-sm text-gray-500">Verifier les evaluations</p>
                    </div>
                    <svg class="w-5 h-5 text-[#d4af37] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="/admin/student-applications" class="group flex items-center gap-4 p-4 rounded-2xl bg-[#d4af37]/5 border border-[#d4af37]/20 hover:bg-[#d4af37]/10 hover:border-[#d4af37]/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-body font-semibold text-white group-hover:text-[#d4af37] transition-colors">Dossiers etudiants</p>
                        <p class="font-body text-sm text-gray-500">Suivre les candidatures</p>
                    </div>
                    <svg class="w-5 h-5 text-[#d4af37] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="/admin/testimonials" class="group flex items-center gap-4 p-4 rounded-2xl bg-[#d4af37]/5 border border-[#d4af37]/20 hover:bg-[#d4af37]/10 hover:border-[#d4af37]/40 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-body font-semibold text-white group-hover:text-[#d4af37] transition-colors">Temoignages</p>
                        <p class="font-body text-sm text-gray-500">Moderer les avis clients</p>
                    </div>
                    <svg class="w-5 h-5 text-[#d4af37] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Lists Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Testimonials -->
        <div class="luxury-card rounded-3xl overflow-hidden">
            <div class="p-6 border-b border-[#d4af37]/10 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-xl text-white mb-1">Derniers Temoignages</h3>
                    <p class="font-body text-gray-500 text-sm">Recemment ajoutes</p>
                </div>
                <a href="/admin/testimonials" class="px-5 py-2.5 bg-gradient-to-r from-[#d4af37] to-[#b8960c] text-[#0a0a0a] font-body font-semibold text-sm rounded-xl hover:shadow-lg hover:shadow-[#d4af37]/25 transition-all duration-300 flex items-center gap-2">
                    Voir tout
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div id="recent-testimonials" class="max-h-[400px] overflow-y-auto elegant-scroll">
                <!-- Dynamic content -->
            </div>
        </div>

        <!-- Recent Users -->
        <div class="luxury-card rounded-3xl overflow-hidden">
            <div class="p-6 border-b border-[#d4af37]/10 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-xl text-white mb-1">Nouveaux Utilisateurs</h3>
                    <p class="font-body text-gray-500 text-sm">Dernieres inscriptions</p>
                </div>
                <a href="/admin/users" class="px-5 py-2.5 bg-gradient-to-r from-[#d4af37] to-[#b8960c] text-[#0a0a0a] font-body font-semibold text-sm rounded-xl hover:shadow-lg hover:shadow-[#d4af37]/25 transition-all duration-300 flex items-center gap-2">
                    Voir tout
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div id="recent-users" class="max-h-[400px] overflow-y-auto elegant-scroll">
                <!-- Dynamic content -->
            </div>
        </div>
    </div>

</div>

<!-- Error State -->
<div id="error-state" class="hidden">
    <div class="text-center py-24">
        <div class="w-24 h-24 bg-red-900/30 border border-red-500/30 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="font-display text-2xl text-white mb-3">Erreur de chargement</h3>
        <p class="font-body text-gray-500 mb-8" id="error-message">Impossible de charger les donnees.</p>
        <button onclick="loadDashboardStats()" class="px-8 py-4 bg-gradient-to-r from-[#d4af37] to-[#b8960c] text-[#0a0a0a] font-body font-bold rounded-xl hover:shadow-lg hover:shadow-[#d4af37]/30 transition-all duration-300 flex items-center gap-3 mx-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Reessayer
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
            }).toUpperCase();
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

        loadingEl.classList.remove('hidden');
        contentEl.classList.add('hidden');
        errorEl.classList.add('hidden');

        try {
            const response = await apiCall('/admin/api/stats');
            const data = response.data;

            loadingEl.classList.add('hidden');
            contentEl.classList.remove('hidden');

            // Animate numbers
            animateValue('total-users', 0, data.users?.total || 0, 1200);
            animateValue('total-testimonials', 0, data.testimonials?.total || 0, 1200);
            animateValue('total-evaluations', 0, data.evaluations?.total || 0, 1200);
            animateValue('total-contacts', 0, data.contact_requests?.total || 0, 1200);
            animateValue('total-applications', 0, data.student_applications?.total || 0, 1200);

            // Update texts
            document.getElementById('new-users-text').textContent = `+${data.users?.new_this_month || 0} ce mois`;
            document.getElementById('approved-text').textContent = `${data.testimonials?.approved || 0} approuves`;
            document.getElementById('avg-rating').textContent = data.testimonials?.average_rating || '0';
            document.getElementById('verified-eval-text').textContent = `${data.evaluations?.verified || 0} verifiees`;
            document.getElementById('new-contacts-text').textContent = `${data.contact_requests?.new || 0} nouvelles`;
            document.getElementById('pending-apps-text').textContent = `${data.student_applications?.in_progress || 0} en cours`;

            // Render sections
            renderCountryChart(data.users_by_country || []);
            renderRecentTestimonials(data.recent_testimonials || []);
            renderRecentUsers(data.recent_users || []);

        } catch (error) {
            console.error('Dashboard Error:', error);
            loadingEl.classList.add('hidden');
            errorEl.classList.remove('hidden');
            document.getElementById('error-message').textContent = `Erreur: ${error.message}`;
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
            const easeProgress = 1 - Math.pow(1 - progress, 3);
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
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 rounded-full bg-[#d4af37]/10 border border-[#d4af37]/20 flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-[#d4af37]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="font-body text-gray-400">Aucune donnee geographique</p>
                </div>
            `;
            return;
        }

        const maxTotal = Math.max(...countries.map(c => c.total));

        container.innerHTML = countries.slice(0, 5).map((country, i) => {
            const pct = Math.round((country.total / maxTotal) * 100);
            return `
                <div class="animate-fade-in" style="animation-delay: ${i * 100}ms">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl">${getCountryFlag(country.country)}</span>
                            <div>
                                <span class="font-body font-semibold text-white">${country.country || 'Non specifie'}</span>
                                <span class="font-body text-xs text-[#d4af37] ml-2">${pct}%</span>
                            </div>
                        </div>
                        <span class="font-display text-2xl text-[#d4af37]">${country.total}</span>
                    </div>
                    <div class="progress-track h-2">
                        <div class="progress-fill h-full" style="width: 0%" data-width="${pct}%"></div>
                    </div>
                </div>
            `;
        }).join('');

        setTimeout(() => {
            container.querySelectorAll('.progress-fill').forEach(bar => {
                bar.style.width = bar.getAttribute('data-width');
            });
        }, 200);
    }

    function renderRecentTestimonials(testimonials) {
        const container = document.getElementById('recent-testimonials');

        if (!testimonials || testimonials.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-16 h-16 rounded-full bg-[#d4af37]/10 border border-[#d4af37]/20 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#d4af37]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <p class="font-body text-gray-400">Aucun temoignage</p>
                </div>
            `;
            return;
        }

        container.innerHTML = testimonials.slice(0, 5).map((t, i) => `
            <div class="list-item p-5 animate-fade-in" style="animation-delay: ${i * 80}ms">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#d4af37] to-[#b8960c] flex items-center justify-center flex-shrink-0">
                        <span class="text-[#0a0a0a] font-bold text-lg">${t.user_name?.charAt(0).toUpperCase() || '?'}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <p class="font-body font-semibold text-white truncate">${t.user_name || 'Anonyme'}</p>
                            <div class="flex gap-0.5">
                                ${[1,2,3,4,5].map(star => `<svg class="w-4 h-4 ${star <= t.rating ? 'text-[#d4af37]' : 'text-gray-700'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`).join('')}
                            </div>
                        </div>
                        <p class="font-body text-sm text-gray-400 line-clamp-2 mb-3">${t.content || ''}</p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs px-2.5 py-1 rounded-full font-body font-medium ${t.is_approved ? 'bg-emerald-900/50 text-emerald-400 border border-emerald-500/30' : 'badge-pending'}">${t.is_approved ? 'Approuve' : 'En attente'}</span>
                            <span class="font-body text-xs text-gray-500">${t.created_at || ''}</span>
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
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-16 h-16 rounded-full bg-[#d4af37]/10 border border-[#d4af37]/20 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#d4af37]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <p class="font-body text-gray-400">Aucun utilisateur recent</p>
                </div>
            `;
            return;
        }

        container.innerHTML = users.slice(0, 5).map((u, i) => `
            <div class="list-item p-5 animate-fade-in" style="animation-delay: ${i * 80}ms">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#1a1a1a] to-[#2a2a2a] border border-[#d4af37]/30 flex items-center justify-center flex-shrink-0">
                        <span class="text-[#d4af37] font-bold text-lg">${u.name?.charAt(0).toUpperCase() || '?'}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-body font-semibold text-white truncate">${u.name || 'Inconnu'}</p>
                        <p class="font-body text-sm text-gray-500 truncate">${u.email || ''}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span class="text-2xl">${getCountryFlag(u.country)}</span>
                        <span class="font-body text-xs text-gray-500">${u.created_at ? new Date(u.created_at).toLocaleDateString('fr-FR', { day: '2-digit', month: 'short' }) : ''}</span>
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

    document.addEventListener('DOMContentLoaded', loadDashboardStats);
</script>
@endpush

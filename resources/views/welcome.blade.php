<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Travel Express - Votre partenaire pour réaliser vos projets à l'international. Études, travail et business en Chine, Espagne et Allemagne. Accompagnement personnalisé.">
    <title>Travel Express - Études, Travail & Business à l'International</title>

    <!-- Google Fonts - Premium Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS (OpenStreetMap) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">

    <style>
        .font-display { font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif; }
        .font-sans { font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; }

        /* Custom Leaflet Popup */
        .leaflet-popup-content-wrapper {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 0;
        }
        .leaflet-popup-content {
            margin: 0;
            min-width: 200px;
        }
        .leaflet-popup-tip {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .custom-popup .leaflet-popup-content-wrapper {
            background: white;
            border: none;
        }

        /* Professional Scroll Animations */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(60px);
            transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-reveal-left {
            opacity: 0;
            transform: translateX(-80px);
            transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .scroll-reveal-left.revealed {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-reveal-right {
            opacity: 0;
            transform: translateX(80px);
            transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .scroll-reveal-right.revealed {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-reveal-scale {
            opacity: 0;
            transform: scale(0.85);
            transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .scroll-reveal-scale.revealed {
            opacity: 1;
            transform: scale(1);
        }

        .scroll-reveal-fade {
            opacity: 0;
            transition: opacity 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .scroll-reveal-fade.revealed {
            opacity: 1;
        }

        /* Staggered animations for children */
        .scroll-reveal-stagger > * {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .scroll-reveal-stagger.revealed > *:nth-child(1) { transition-delay: 0.1s; }
        .scroll-reveal-stagger.revealed > *:nth-child(2) { transition-delay: 0.2s; }
        .scroll-reveal-stagger.revealed > *:nth-child(3) { transition-delay: 0.3s; }
        .scroll-reveal-stagger.revealed > *:nth-child(4) { transition-delay: 0.4s; }
        .scroll-reveal-stagger.revealed > *:nth-child(5) { transition-delay: 0.5s; }
        .scroll-reveal-stagger.revealed > *:nth-child(6) { transition-delay: 0.6s; }

        .scroll-reveal-stagger.revealed > * {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hide avatar ring animation on mobile */
        @media (max-width: 1023px) {
            .avatar-ring::before {
                display: none !important;
                animation: none !important;
            }
        }
    </style>
</head>
<body class="font-sans text-dark antialiased bg-white overflow-x-hidden w-full max-w-none m-0 p-0" x-data="{
    mobileMenuOpen: false,
    activeCountry: 'china',
    testimonialModalOpen: false,
    evaluationModalOpen: false,
    init() {
        // Check if we should open testimonial modal (after login redirect)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('openTestimonial') === 'true') {
            // Clean URL without reloading
            window.history.replaceState({}, document.title, window.location.pathname);
            // Open modal after a short delay to ensure page is loaded
            setTimeout(() => {
                this.testimonialModalOpen = true;
            }, 500);
        }
    },
    openTestimonialModal() {
        const token = localStorage.getItem('auth_token');
        if (!token) {
            window.location.href = '/login?redirect=testimonial';
            return;
        }
        this.testimonialModalOpen = true;
    },
    faqCategories: [
        { id: 'all', name: 'Toutes', icon: 'grid' },
        { id: 'general', name: 'Général', icon: 'info' },
        { id: 'studies', name: 'Études', icon: 'academic' },
        { id: 'process', name: 'Processus', icon: 'clock' },
        { id: 'services', name: 'Services', icon: 'briefcase' }
    ],
    activeFaqCategory: 'all',
    faqs: [
        { id: 1, category: 'general', open: false, icon: 'globe', question: 'Quels types de projets accompagnez-vous ?', answer: 'Nous accompagnons trois types de projets : les études (universités, formations professionnelles), le travail (recherche d\'emploi, contrats de travail) et les affaires (import-export, création d\'entreprise, partenariats commerciaux) en Chine, Espagne et Allemagne.' },
        { id: 2, category: 'process', open: false, icon: 'calendar', question: 'Combien de temps prend le processus complet ?', answer: 'Le délai varie selon votre projet. Pour les études : 3 à 6 mois. Pour un contrat de travail : 2 à 4 mois. Pour un projet business : 1 à 3 mois selon la complexité. Nous recommandons de nous contacter le plus tôt possible.' },
        { id: 3, category: 'studies', open: false, icon: 'language', question: 'Dois-je parler la langue du pays de destination ?', answer: 'Pas nécessairement. Pour les études, de nombreux programmes sont en anglais. Pour le travail et le business, cela dépend du secteur. Nous pouvons vous orienter vers des formations linguistiques adaptées.' },
        { id: 4, category: 'general', open: false, icon: 'currency', question: 'Quel est le coût de vos services ?', answer: 'Nos tarifs sont adaptés à chaque projet. Nous proposons différentes formules selon vos besoins : accompagnement études, accompagnement professionnel, accompagnement business. Contactez-nous pour un devis personnalisé gratuit.' },
        { id: 5, category: 'services', open: false, icon: 'home', question: 'Aidez-vous pour le logement et l\'installation ?', answer: 'Oui ! Notre accompagnement inclut la recherche de logement, l\'accueil à l\'aéroport, les démarches administratives et toute l\'aide nécessaire pour votre installation réussie dans votre pays de destination.' },
        { id: 6, category: 'services', open: false, icon: 'building', question: 'Proposez-vous un accompagnement pour le business en Chine ?', answer: 'Absolument ! Nous accompagnons les entrepreneurs dans leurs projets d\'import-export, la recherche de fournisseurs, la création de partenariats commerciaux et l\'installation d\'activités en Chine. Notre réseau local facilite vos démarches.' },
        { id: 7, category: 'studies', open: false, icon: 'scholarship', question: 'Proposez-vous des bourses d\'études ?', answer: 'Oui, nous avons accès à plusieurs programmes de bourses partielles et complètes dans nos universités partenaires. Nous évaluons votre profil pour identifier les opportunités les plus adaptées et vous accompagnons dans vos candidatures.' },
        { id: 8, category: 'process', open: false, icon: 'document', question: 'Quels documents sont nécessaires pour commencer ?', answer: 'Les documents de base incluent : passeport valide, diplômes et relevés de notes, CV, lettre de motivation. Selon votre projet, d\'autres documents peuvent être requis. Nous vous fournissons une checklist personnalisée dès le début.' }
    ],
    get filteredFaqs() {
        if (this.activeFaqCategory === 'all') return this.faqs;
        return this.faqs.filter(faq => faq.category === this.activeFaqCategory);
    }
}" x-init="init()">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-2xl border-b border-black/[0.08] shadow-sm transition-all duration-300"
            x-data="{ scrolled: false }"
            @scroll.window="scrolled = window.pageYOffset > 20"
            :class="scrolled ? 'shadow-md' : ''">
        <!-- Top Info Bar -->
        <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white py-1.5 hidden lg:block">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center space-x-6">
                        <a href="https://wa.me/22665604592" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span class="font-medium">+226 65 60 45 92</span>
                        </a>
                        <a href="mailto:armel.bakoua@travel-express.bf" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">armel.bakoua@travel-express.bf</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Lun-Ven: 9h-18h | Sam: 10h-14h</span>
                        </span>
                        <div class="flex items-center space-x-2 border-l border-white/20 pl-4">
                            <a href="#" class="hover:opacity-80 transition-opacity">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
                            </a>
                            <a href="#" class="hover:opacity-80 transition-opacity">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg>
                            </a>
                            <a href="#" class="hover:opacity-80 transition-opacity">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
                            </a>
                            <a href="#" class="hover:opacity-80 transition-opacity">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation - Full Width -->
        <div class="w-full">
            <nav class="flex items-center justify-between h-[70px] sm:h-[85px]">
                <!-- Logo -->
                <a href="#" class="flex items-center group relative flex-shrink-0 pl-1">
                    <img src="/images/logo/logo_travel.png" alt="Travel Express" class="h-14 sm:h-[70px] w-auto transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- Center Navigation + Actions (All in One Line) -->
                <div class="hidden xl:flex items-center justify-end flex-1 space-x-2 pr-2">
                    <!-- Navigation Links -->
                    <a href="#programmes" class="relative px-3 py-2 text-sm font-semibold text-gray-600 hover:text-dark transition-all duration-300 group">
                        <span class="relative z-10">Programmes</span>
                        <div class="absolute bottom-0 left-3 right-3 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></div>
                    </a>
                    <a href="#pourquoi" class="relative px-3 py-2 text-sm font-semibold text-gray-600 hover:text-dark transition-all duration-300 group">
                        <span class="relative z-10">Avantages</span>
                        <div class="absolute bottom-0 left-3 right-3 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></div>
                    </a>
                    <a href="#processus" class="relative px-3 py-2 text-sm font-semibold text-gray-600 hover:text-dark transition-all duration-300 group">
                        <span class="relative z-10">Processus</span>
                        <div class="absolute bottom-0 left-3 right-3 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></div>
                    </a>
                    <a href="#temoignages" class="relative px-3 py-2 text-sm font-semibold text-gray-600 hover:text-dark transition-all duration-300 group">
                        <span class="relative z-10">Témoignages</span>
                        <div class="absolute bottom-0 left-3 right-3 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></div>
                    </a>
                    <a href="#faq" class="relative px-3 py-2 text-sm font-semibold text-gray-600 hover:text-dark transition-all duration-300 group">
                        <span class="relative z-10">FAQ</span>
                        <div class="absolute bottom-0 left-3 right-3 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></div>
                    </a>

                    <!-- Separator -->
                    <div class="w-px h-6 bg-gray-200 mx-2"></div>

                    <!-- Action Buttons -->
                    <!-- User Profile or Login -->
                    <div x-data="{
                        userMenuOpen: false,
                        user: null,
                        init() {
                            const userData = localStorage.getItem('user');
                            if (userData) {
                                this.user = JSON.parse(userData);
                            }
                        },
                        logout() {
                            localStorage.removeItem('auth_token');
                            localStorage.removeItem('user');
                            window.location.href = '/';
                        },
                        getInitials(name) {
                            return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
                        },
                        isAdmin() {
                            return this.user && (this.user.is_admin === 1 || this.user.is_admin === true);
                        }
                    }" class="relative">
                        <!-- User Profile Dropdown -->
                        <template x-if="user">
                            <div>
                                <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2.5 px-3 py-2 hover:bg-gray-50 rounded-xl transition-all duration-300 group">
                                    <div class="w-8 h-8 bg-gradient-to-br from-primary-600 to-accent-600 rounded-full flex items-center justify-center shadow-md">
                                        <span x-text="getInitials(user.name)" class="text-xs font-bold text-white"></span>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p x-text="user.name" class="text-sm font-bold text-dark leading-tight"></p>
                                        <p class="text-xs text-gray-500">Mon compte</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="userMenuOpen"
                                     @click.away="userMenuOpen = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50">

                                    <!-- User Info -->
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <p x-text="user.name" class="text-sm font-bold text-dark"></p>
                                        <p x-text="user.email" class="text-xs text-gray-500 mt-0.5"></p>
                                    </div>

                                    <!-- Menu Items -->
                                    <div class="py-2">
                                        <!-- Dashboard Admin (only for admins) -->
                                        <template x-if="isAdmin()">
                                            <a href="/admin/dashboard" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 transition-all mx-2 rounded-lg group shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                                <span class="font-bold">Dashboard Admin</span>
                                                <span class="ml-auto bg-white/20 px-1.5 py-0.5 rounded text-xs">ADMIN</span>
                                            </a>
                                        </template>

                                        <a href="/profile" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-colors group">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span class="font-medium">Mon profil</span>
                                        </a>
                                        <a href="/applications" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-colors group">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="font-medium">Mes candidatures</span>
                                        </a>
                                    </div>

                                    <!-- Logout -->
                                    <div class="border-t border-gray-100 pt-2">
                                        <button @click="logout()" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors w-full group">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span class="font-bold">Déconnexion</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Login Button (when not logged in) -->
                        <template x-if="!user">
                            <a href="/login" class="flex items-center space-x-1.5 px-4 py-2 text-sm font-semibold text-dark hover:text-primary-600 transition-all duration-300 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Connexion</span>
                            </a>
                        </template>
                    </div>

                    <a href="/bourse" class="relative flex items-center space-x-1.5 px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 rounded-lg transition-all duration-300 group shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 group-hover:scale-110 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Ma Bourse</span>
                        <span class="absolute -top-2 -right-2 px-1.5 py-0.5 bg-amber-400 text-amber-900 text-[10px] font-bold rounded-full shadow-sm animate-pulse">Bientôt</span>
                    </a>

                    <a href="#contact" class="relative px-5 py-2 bg-gradient-to-r from-accent-600 to-accent-500 text-white text-sm font-bold rounded-lg hover:shadow-xl hover:shadow-accent-600/30 transform hover:scale-105 transition-all duration-300 overflow-hidden group">
                        <span class="relative z-10 flex items-center space-x-1.5">
                            <span>Postuler</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-accent-700 to-accent-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                </div>

                <!-- Enhanced Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2.5 mr-1 text-dark hover:bg-gray-100 rounded-xl transition-colors">
                    <div class="burger-icon" :class="{ 'burger-open': mobileMenuOpen }">
                        <div class="burger-line"></div>
                        <div class="burger-line"></div>
                        <div class="burger-line"></div>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Enhanced Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="xl:hidden bg-white border-t border-black/[0.06] shadow-xl"
             @click.away="mobileMenuOpen = false"
             x-data="{
                mobileUser: null,
                init() {
                    const userData = localStorage.getItem('user');
                    if (userData) {
                        this.mobileUser = JSON.parse(userData);
                    }
                },
                mobileLogout() {
                    localStorage.removeItem('auth_token');
                    localStorage.removeItem('user');
                    localStorage.removeItem('token_expires_at');
                    localStorage.removeItem('is_admin');
                    window.location.href = '/';
                },
                getInitials(name) {
                    return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
                },
                isAdmin() {
                    return this.mobileUser && (this.mobileUser.is_admin === 1 || this.mobileUser.is_admin === true);
                },
                userMenuExpanded: false
             }">
            <div class="w-full px-4 sm:px-6 py-4 sm:py-6 space-y-2">
                <!-- Navigation Links -->
                <a href="#programmes" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Programmes</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#pourquoi" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Avantages</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#processus" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Processus</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#temoignages" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Témoignages</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#faq" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">FAQ</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- User Menu (if logged in) - Collapsible -->
                <template x-if="mobileUser">
                    <div class="space-y-2">
                        <!-- User Toggle Button -->
                        <button @click="userMenuExpanded = !userMenuExpanded" class="flex items-center justify-between w-full py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary-600 to-accent-600 rounded-full flex items-center justify-center">
                                    <span x-text="getInitials(mobileUser.name)" class="text-xs font-bold text-white"></span>
                                </div>
                                <span class="font-medium" x-text="mobileUser.name"></span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-90': userMenuExpanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Expanded User Menu -->
                        <div x-show="userMenuExpanded" x-collapse class="pl-4 space-y-1">
                            <!-- Admin Dashboard (if admin) -->
                            <template x-if="isAdmin()">
                                <a href="/admin/dashboard" @click="mobileMenuOpen = false" class="flex items-center space-x-3 py-2.5 px-4 text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span class="font-medium">Dashboard Admin</span>
                                </a>
                            </template>
                            <a href="/profile" @click="mobileMenuOpen = false" class="flex items-center space-x-3 py-2.5 px-4 text-gray-600 hover:bg-gray-50 rounded-xl transition-all text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">Mon profil</span>
                            </a>
                            <button @click="mobileLogout()" class="flex items-center space-x-3 w-full py-2.5 px-4 text-red-600 hover:bg-red-50 rounded-xl transition-all text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="font-medium">Déconnexion</span>
                            </button>
                        </div>
                    </div>
                </template>

                <!-- Action Buttons -->
                <div class="pt-4 space-y-2.5">
                    <!-- Login button (if not logged in) -->
                    <template x-if="!mobileUser">
                        <a href="/login" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-4 py-2.5 border-2 border-primary-600 text-primary-600 font-medium text-sm rounded-xl hover:bg-primary-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Connexion</span>
                        </a>
                    </template>

                    <a href="/bourse" @click="mobileMenuOpen = false" class="relative flex items-center justify-center space-x-2 w-full px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium text-sm rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Ma Bourse</span>
                        <span class="absolute -top-2 -right-1 px-1.5 py-0.5 bg-amber-400 text-amber-900 text-[10px] font-bold rounded-full shadow-sm">Bientôt</span>
                    </a>

                    <a href="#contact" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-4 py-2.5 bg-gradient-to-r from-accent-600 to-accent-500 text-white font-medium text-sm rounded-xl hover:shadow-lg transition-all">
                        <span>Postuler</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section - Modern with Image Slider -->
    <section class="relative min-h-[85vh] flex items-center overflow-hidden pt-[100px] lg:pt-[108px]"
             x-data="{
                currentSlide: 0,
                slides: [
                    'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1920&q=80&fit=crop&crop=faces',
                    'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=1920&q=80&fit=crop&crop=faces',
                    'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1920&q=80&fit=crop&crop=faces',
                    'https://images.unsplash.com/photo-1531498860502-7c67cf02f657?w=1920&q=80&fit=crop&crop=faces',
                    'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=80&fit=crop&crop=faces',
                    'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1920&q=80&fit=crop&crop=faces'
                ],
                autoplay: null,
                isPaused: false,
                init() {
                    this.startAutoplay();
                },
                startAutoplay() {
                    this.autoplay = setInterval(() => {
                        if (!this.isPaused) {
                            this.nextSlide();
                        }
                    }, 5000);
                },
                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                },
                prevSlide() {
                    this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                },
                goToSlide(index) {
                    this.currentSlide = index;
                },
                pauseAutoplay() {
                    this.isPaused = true;
                },
                resumeAutoplay() {
                    this.isPaused = false;
                }
             }"
             @mouseenter="pauseAutoplay()"
             @mouseleave="resumeAutoplay()">

        <!-- Background Image Slider with Overlay -->
        <div class="absolute inset-0 z-0">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-dark/90 via-dark/85 to-primary-900/90 z-10"></div>

            <!-- Slider Images -->
            <div x-show="currentSlide === 0"
                 x-transition:enter="transition-opacity ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1920&q=80&fit=crop&crop=faces');">
            </div>
            <div x-show="currentSlide === 1"
                 x-transition:enter="transition-opacity ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=1920&q=80&fit=crop&crop=faces');">
            </div>
            <div x-show="currentSlide === 2"
                 x-transition:enter="transition-opacity ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1920&q=80&fit=crop&crop=faces');">
            </div>
            <div x-show="currentSlide === 3"
                 x-transition:enter="transition-opacity ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1531498860502-7c67cf02f657?w=1920&q=80&fit=crop&crop=faces');">
            </div>
            <div x-show="currentSlide === 4"
                 x-transition:enter="transition-opacity ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=80&fit=crop&crop=faces');">
            </div>
            <div x-show="currentSlide === 5"
                 x-transition:enter="transition-opacity ease-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1920&q=80&fit=crop&crop=faces');">
            </div>

            <!-- Animated Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary-600/30 via-transparent to-accent-600/30 z-10"></div>

            <!-- Pattern Overlay -->
            <div class="absolute inset-0 z-10 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Content -->
        <div class="relative z-20 w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24 py-8 sm:py-12">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Text Content -->
                <div class="text-left space-y-8 fade-in-up">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2">
                        <div class="w-2 h-2 bg-accent-500 rounded-full animate-pulse"></div>
                        <span class="text-white/90 text-sm font-semibold">🌍 Études • Travail • Business</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-2xl md:text-4xl xl:text-5xl font-display font-black text-white leading-tight">
                        Vos projets
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-400 via-accent-500 to-primary-400 animate-gradient">
                            à l'international
                        </span>
                    </h1>

                    <!-- Subheading -->
                    <p class="text-base md:text-lg text-white/80 leading-relaxed max-w-lg">
                        Accompagnement personnalisé en <span class="text-accent-400 font-semibold">Chine</span>, <span class="text-accent-400 font-semibold">Espagne</span> et <span class="text-accent-400 font-semibold">Allemagne</span>.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-3">
                        <a href="#contact" class="group relative px-5 py-2.5 bg-gradient-to-r from-accent-600 to-accent-500 text-white text-sm font-semibold rounded-lg shadow-xl hover:shadow-accent-600/50 transform hover:scale-105 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center space-x-2">
                                <span>Démarrer mon projet</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-accent-700 to-accent-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        <a href="#programmes" class="group px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/30 text-white text-sm font-semibold rounded-lg hover:bg-white/20 hover:border-white/50 transition-all duration-300">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Nos programmes</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="flex items-center space-x-6 pt-8 border-t border-white/20">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-white/90 font-semibold">4.9/5</span>
                            <span class="text-white/60 text-sm">(250+ avis)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-white/90 font-semibold">+10 ans d'expérience</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Stats Cards -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Card 1 -->
                    <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center hover:from-white/20 hover:to-white/10 hover:scale-[1.02] hover:border-accent-400/50 transition-all duration-500 group cursor-pointer">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-accent-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-black text-white group-hover:text-accent-400 transition-colors duration-300">500+</div>
                        <div class="text-white/60 text-[10px] font-semibold uppercase tracking-wider">Clients</div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center hover:from-white/20 hover:to-white/10 hover:scale-[1.02] hover:border-primary-400/50 transition-all duration-500 group cursor-pointer">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-primary-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-black text-white group-hover:text-primary-400 transition-colors duration-300">3</div>
                        <div class="text-white/60 text-[10px] font-semibold uppercase tracking-wider">Destinations</div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center hover:from-white/20 hover:to-white/10 hover:scale-[1.02] hover:border-accent-400/50 transition-all duration-500 group cursor-pointer">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-accent-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-black text-white group-hover:text-accent-400 transition-colors duration-300">10+</div>
                        <div class="text-white/60 text-[10px] font-semibold uppercase tracking-wider">Ans d'exp.</div>
                    </div>
                    <!-- Card 4 -->
                    <div class="bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center hover:from-white/20 hover:to-white/10 hover:scale-[1.02] hover:border-primary-400/50 transition-all duration-500 group cursor-pointer">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-primary-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-black text-white group-hover:text-primary-400 transition-colors duration-300">100%</div>
                        <div class="text-white/60 text-[10px] font-semibold uppercase tracking-wider">Personnalisé</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Controls & Indicators -->
        <div class="absolute bottom-8 left-0 right-0 z-20">
            <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24">
                <div class="flex items-center justify-between">
                    <!-- Slider Dots -->
                    <div class="flex items-center space-x-3">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="goToSlide(index)"
                                    class="group relative focus:outline-none"
                                    :aria-label="'Aller à la diapositive ' + (index + 1)">
                                <div class="w-2 h-2 rounded-full transition-all duration-300"
                                     :class="currentSlide === index ? 'bg-white w-8 h-2' : 'bg-white/40 hover:bg-white/60'"></div>
                                <div x-show="currentSlide === index"
                                     x-transition
                                     class="absolute inset-0 -m-1 border-2 border-white/40 rounded-full animate-ping"></div>
                            </button>
                        </template>
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="flex items-center space-x-3">
                        <button @click="prevSlide()"
                                class="p-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/20 hover:scale-110 active:scale-95 transition-all duration-300 group focus:outline-none focus:ring-2 focus:ring-white/50"
                                aria-label="Image précédente">
                            <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextSlide()"
                                class="p-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/20 hover:scale-110 active:scale-95 transition-all duration-300 group focus:outline-none focus:ring-2 focus:ring-white/50"
                                aria-label="Image suivante">
                            <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Scroll Indicator (Hidden on Mobile) -->
                    <div class="hidden md:flex flex-col items-center space-y-2 animate-bounce">
                        <span class="text-white/60 text-xs font-semibold uppercase tracking-wider">Défiler</span>
                        <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section - Enhanced -->
    <section id="pourquoi" class="relative py-12 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 -left-20 w-72 h-72 bg-primary-200/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 -right-20 w-96 h-96 bg-accent-200/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24">
            <!-- Section Header -->
            <div class="text-center mb-12 scroll-reveal">
                <div class="inline-flex items-center space-x-2 bg-primary-100 px-3 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-primary-600 font-semibold text-xs uppercase tracking-wider">Nos avantages</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-dark mb-3 tracking-apple-tight">
                    Pourquoi <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-600">Travel Express</span> ?
                </h2>
                <p class="text-sm text-gray max-w-xl mx-auto leading-relaxed">
                    Votre partenaire pour vos projets d'études, travail et business à l'international
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 scroll-reveal-stagger">
                <!-- Feature 1 -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-primary-300/50 overflow-hidden text-center sm:text-left">
                    <!-- Gradient background on hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 via-white to-primary-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <!-- Decorative circle -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-primary-500/10 to-primary-600/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto sm:mx-0 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-primary-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-bold text-dark mb-3 group-hover:text-primary-600 transition-colors">Expertise prouvée</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            Plus de <span class="text-primary-600 font-semibold">10 ans d'expérience</span> et <span class="text-primary-600 font-semibold">500+ étudiants</span> accompagnés avec succès.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-accent-300/50 overflow-hidden text-center sm:text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-50 via-white to-accent-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-accent-500/10 to-accent-600/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto sm:mx-0 bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-accent-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-bold text-dark mb-3 group-hover:text-accent-600 transition-colors">Services complets</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            Études, travail, business : <span class="text-accent-600 font-semibold">tous vos projets</span> à l'international avec des solutions adaptées.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-primary-300/50 overflow-hidden text-center sm:text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 via-white to-primary-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-primary-500/10 to-primary-600/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto sm:mx-0 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-primary-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-bold text-dark mb-3 group-hover:text-primary-600 transition-colors">Accompagnement 360°</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            De la sélection jusqu'à l'installation : <span class="text-primary-600 font-semibold">à vos côtés</span> à chaque étape du parcours.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-accent-300/50 overflow-hidden text-center sm:text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-50 via-white to-accent-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-accent-500/10 to-accent-600/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto sm:mx-0 bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-accent-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-bold text-dark mb-3 group-hover:text-accent-600 transition-colors">Réseau international</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            Contacts établis avec <span class="text-accent-600 font-semibold">universités et partenaires</span> en Chine, Espagne et Allemagne.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-primary-300/50 overflow-hidden text-center sm:text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 via-white to-primary-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-primary-500/10 to-primary-600/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto sm:mx-0 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-primary-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-bold text-dark mb-3 group-hover:text-primary-600 transition-colors">Processus rapide</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            <span class="text-primary-600 font-semibold">Délais optimisés</span> pour vos admissions et visas. Démarrez votre aventure rapidement.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-accent-300/50 overflow-hidden text-center sm:text-left">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-50 via-white to-accent-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-accent-500/10 to-accent-600/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto sm:mx-0 bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-accent-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-display font-bold text-dark mb-3 group-hover:text-accent-600 transition-colors">Suivi post-arrivée</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            <span class="text-accent-600 font-semibold">Assistance continue</span> après votre arrivée : logement, installation, intégration.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-10 text-center">
                <a href="#contact" class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <span>C'est parti !</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Destinations Section - Futuristic World Map Design -->
    <section id="programmes" class="relative py-20 overflow-hidden" style="background: linear-gradient(135deg, #0f0f23 0%, #1a1a3e 50%, #0d0d1f 100%);">

        <!-- Animated Stars Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="stars-container">
                <div class="absolute w-1 h-1 bg-white rounded-full animate-pulse" style="top: 10%; left: 15%; animation-delay: 0s;"></div>
                <div class="absolute w-1.5 h-1.5 bg-blue-300 rounded-full animate-pulse" style="top: 20%; left: 80%; animation-delay: 0.5s;"></div>
                <div class="absolute w-1 h-1 bg-white rounded-full animate-pulse" style="top: 40%; left: 25%; animation-delay: 1s;"></div>
                <div class="absolute w-2 h-2 bg-purple-300 rounded-full animate-pulse" style="top: 60%; left: 90%; animation-delay: 1.5s;"></div>
                <div class="absolute w-1 h-1 bg-white rounded-full animate-pulse" style="top: 80%; left: 10%; animation-delay: 2s;"></div>
                <div class="absolute w-1.5 h-1.5 bg-cyan-300 rounded-full animate-pulse" style="top: 15%; left: 50%; animation-delay: 0.3s;"></div>
                <div class="absolute w-1 h-1 bg-white rounded-full animate-pulse" style="top: 70%; left: 60%; animation-delay: 1.2s;"></div>
                <div class="absolute w-1 h-1 bg-pink-300 rounded-full animate-pulse" style="top: 45%; left: 75%; animation-delay: 0.8s;"></div>
            </div>
        </div>

        <!-- Floating Orbs -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-gradient-to-br from-cyan-500/15 to-pink-500/15 rounded-full blur-3xl animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-br from-indigo-500/10 to-transparent rounded-full blur-3xl"></div>

        <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Section Header with Glow Effect -->
            <div class="text-center mb-16 scroll-reveal">
                <div class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 backdrop-blur-xl rounded-full mb-8 border border-white/10 shadow-lg shadow-purple-500/10">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">Explorez le monde avec nous</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-6 leading-tight">
                    Votre passeport vers
                    <span class="relative inline-block">
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 bg-clip-text text-transparent">l'international</span>
                        <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none">
                            <path d="M1 5.5C47.6667 2.16667 141 -2.4 199 5.5" stroke="url(#gradient)" stroke-width="3" stroke-linecap="round"/>
                            <defs>
                                <linearGradient id="gradient" x1="0" y1="0" x2="200" y2="0">
                                    <stop offset="0%" stop-color="#22d3ee"/>
                                    <stop offset="50%" stop-color="#3b82f6"/>
                                    <stop offset="100%" stop-color="#a855f7"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                </h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Trois destinations exceptionnelles pour transformer vos ambitions en réalité
                </p>
            </div>

            <!-- Destination Cards - Equal Size with Image Gallery -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">

                <!-- ============================================== -->
                <!-- CHINA Card - Full Featured -->
                <!-- ============================================== -->
                <div class="group relative cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-yellow-500 rounded-3xl blur-xl opacity-0 group-hover:opacity-40 transition-opacity duration-700"></div>
                    <div class="relative h-full rounded-3xl overflow-hidden border border-white/10 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm transition-all duration-500 group-hover:border-red-500/50 group-hover:scale-[1.01]">

                        <!-- Main Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1508804185872-d7badad00f7d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                 alt="Shanghai - Pudong Skyline"
                                 class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            <!-- Flag & Badge -->
                            <div class="absolute top-4 left-4 z-20">
                                <div class="flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-red-600 to-yellow-500 rounded-full shadow-lg">
                                    <span class="text-lg">🇨🇳</span>
                                    <span class="text-xs font-bold text-white uppercase tracking-wider">Chine</span>
                                </div>
                            </div>

                            <!-- Premium Star -->
                            <div class="absolute top-4 right-4 z-20">
                                <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center shadow-lg shadow-yellow-500/50">
                                    <svg class="w-5 h-5 text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Title Overlay -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-2xl font-display font-bold text-white">Empire du Milieu</h3>
                                <p class="text-white/80 text-sm">Shanghai • Pékin • Guangzhou • Shenzhen</p>
                            </div>
                        </div>

                        <!-- Image Gallery - Landmarks -->
                        <div class="grid grid-cols-3 gap-1 p-1">
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1547981609-4b6bfe67ca0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Grande Muraille de Chine"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Grande Muraille</span>
                                </div>
                            </div>
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1529921879218-f99546d03a9d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Cité Interdite Pékin"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Cité Interdite</span>
                                </div>
                            </div>
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1474181487882-5abf3f0ba6c2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Temple du Ciel"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Temple du Ciel</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                                Deuxième économie mondiale, la Chine offre des opportunités uniques : universités de rang mondial, marché du travail dynamique et hub business international.
                            </p>

                            <!-- Programs Available -->
                            <div class="mb-4">
                                <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-2">Programmes disponibles</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2.5 py-1 bg-red-500/20 border border-red-500/30 rounded-lg text-red-300 text-xs">🎓 Études universitaires</span>
                                    <span class="px-2.5 py-1 bg-yellow-500/20 border border-yellow-500/30 rounded-lg text-yellow-300 text-xs">💼 Travail & Stages</span>
                                    <span class="px-2.5 py-1 bg-orange-500/20 border border-orange-500/30 rounded-lg text-orange-300 text-xs">🏢 Business & Import</span>
                                    <span class="px-2.5 py-1 bg-purple-500/20 border border-purple-500/30 rounded-lg text-purple-300 text-xs">🌐 Cours de Mandarin</span>
                                </div>
                            </div>

                            <!-- Key Features -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Bourses CSC disponibles (100% des frais)</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Visa étudiant X1/X2 facilité</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Accompagnement de A à Z</span>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-3 p-3 bg-black/30 backdrop-blur-md rounded-xl border border-white/10 mb-4">
                                <div class="text-center">
                                    <div class="text-xl font-bold text-yellow-400">50+</div>
                                    <div class="text-xs text-white/50">Universités</div>
                                </div>
                                <div class="text-center border-x border-white/10">
                                    <div class="text-xl font-bold text-white">98%</div>
                                    <div class="text-xs text-white/50">Réussite</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-xl font-bold text-green-400">500+</div>
                                    <div class="text-xs text-white/50">Étudiants</div>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <a href="#contact" class="group/btn relative flex items-center justify-center gap-2 w-full px-5 py-3 overflow-hidden rounded-xl font-bold text-white transition-all duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-yellow-500"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-yellow-400 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                                <span class="relative z-10 text-sm">Découvrir la Chine</span>
                                <svg class="relative z-10 w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- SPAIN Card - Full Featured -->
                <!-- ============================================== -->
                <div class="group relative cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-red-500 rounded-3xl blur-xl opacity-0 group-hover:opacity-40 transition-opacity duration-700"></div>
                    <div class="relative h-full rounded-3xl overflow-hidden border border-white/10 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm transition-all duration-500 group-hover:border-orange-500/50 group-hover:scale-[1.01]">

                        <!-- Main Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1539037116277-4db20889f2d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                 alt="Barcelone - Sagrada Familia"
                                 class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            <!-- Flag & Badge -->
                            <div class="absolute top-4 left-4 z-20">
                                <div class="flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-red-600 to-yellow-500 rounded-full shadow-lg">
                                    <span class="text-lg">🇪🇸</span>
                                    <span class="text-xs font-bold text-white uppercase tracking-wider">Espagne</span>
                                </div>
                            </div>

                            <!-- EU Badge -->
                            <div class="absolute top-4 right-4 z-20">
                                <div class="px-3 py-1.5 bg-blue-600 rounded-full flex items-center gap-1.5 shadow-lg">
                                    <span class="text-sm">🇪🇺</span>
                                    <span class="text-xs font-bold text-white">UE</span>
                                </div>
                            </div>

                            <!-- Title Overlay -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-2xl font-display font-bold text-white">Tierra del Sol</h3>
                                <p class="text-white/80 text-sm">Madrid • Barcelone • Valence • Séville</p>
                            </div>
                        </div>

                        <!-- Image Gallery - Landmarks -->
                        <div class="grid grid-cols-3 gap-1 p-1">
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1583422409516-2895a77efded?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Sagrada Familia Barcelone"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Sagrada Familia</span>
                                </div>
                            </div>
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Plaza Mayor Madrid"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Madrid</span>
                                </div>
                            </div>
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1504019347908-b45f9b0b8dd5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Alhambra Grenade"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Alhambra</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                                Porte d'entrée vers l'Europe, l'Espagne offre des diplômes reconnus dans toute l'UE, une qualité de vie exceptionnelle et des opportunités professionnelles variées.
                            </p>

                            <!-- Programs Available -->
                            <div class="mb-4">
                                <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-2">Programmes disponibles</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2.5 py-1 bg-red-500/20 border border-red-500/30 rounded-lg text-red-300 text-xs">🎓 Études supérieures</span>
                                    <span class="px-2.5 py-1 bg-orange-500/20 border border-orange-500/30 rounded-lg text-orange-300 text-xs">💼 Emploi saisonnier</span>
                                    <span class="px-2.5 py-1 bg-yellow-500/20 border border-yellow-500/30 rounded-lg text-yellow-300 text-xs">🏛️ Diplômes UE</span>
                                    <span class="px-2.5 py-1 bg-pink-500/20 border border-pink-500/30 rounded-lg text-pink-300 text-xs">🎨 Arts & Design</span>
                                </div>
                            </div>

                            <!-- Key Features -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Diplômes reconnus dans 27 pays UE</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Possibilité de travail pendant études</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Coût de vie abordable</span>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-3 p-3 bg-black/30 backdrop-blur-md rounded-xl border border-white/10 mb-4">
                                <div class="text-center">
                                    <div class="text-xl font-bold text-yellow-400">30+</div>
                                    <div class="text-xs text-white/50">Universités</div>
                                </div>
                                <div class="text-center border-x border-white/10">
                                    <div class="text-xl font-bold text-white">95%</div>
                                    <div class="text-xs text-white/50">Réussite</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-xl font-bold text-green-400">200+</div>
                                    <div class="text-xs text-white/50">Étudiants</div>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <a href="#contact" class="group/btn relative flex items-center justify-center gap-2 w-full px-5 py-3 overflow-hidden rounded-xl font-bold text-white transition-all duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-500"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-400 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                                <span class="relative z-10 text-sm">Découvrir l'Espagne</span>
                                <svg class="relative z-10 w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- GERMANY Card - Full Featured -->
                <!-- ============================================== -->
                <div class="group relative cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-500 to-yellow-500 rounded-3xl blur-xl opacity-0 group-hover:opacity-40 transition-opacity duration-700"></div>
                    <div class="relative h-full rounded-3xl overflow-hidden border border-white/10 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm transition-all duration-500 group-hover:border-yellow-500/50 group-hover:scale-[1.01]">

                        <!-- Main Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                 alt="Berlin - Porte de Brandebourg"
                                 class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            <!-- Flag & Badge -->
                            <div class="absolute top-4 left-4 z-20">
                                <div class="flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-gray-800 to-yellow-500 rounded-full shadow-lg">
                                    <span class="text-lg">🇩🇪</span>
                                    <span class="text-xs font-bold text-white uppercase tracking-wider">Allemagne</span>
                                </div>
                            </div>

                            <!-- Tech Badge -->
                            <div class="absolute top-4 right-4 z-20">
                                <div class="px-3 py-1.5 bg-emerald-600 rounded-full flex items-center gap-1.5 shadow-lg">
                                    <span class="text-sm">⚙️</span>
                                    <span class="text-xs font-bold text-white">Tech</span>
                                </div>
                            </div>

                            <!-- Title Overlay -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-2xl font-display font-bold text-white">Land der Ideen</h3>
                                <p class="text-white/80 text-sm">Berlin • Munich • Francfort • Hambourg</p>
                            </div>
                        </div>

                        <!-- Image Gallery - Landmarks -->
                        <div class="grid grid-cols-3 gap-1 p-1">
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1560969184-10fe8719e047?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Porte de Brandebourg Berlin"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Brandebourg</span>
                                </div>
                            </div>
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1595867818082-083862f3d630?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Château Neuschwanstein"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Neuschwanstein</span>
                                </div>
                            </div>
                            <div class="relative h-20 overflow-hidden rounded-lg group/img">
                                <img src="https://images.unsplash.com/photo-1534351590666-13e3e96b5017?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                     alt="Cathédrale de Cologne"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-medium">Cologne</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                                Première économie européenne et leader mondial de l'innovation. Formation professionnelle d'excellence, industrie automobile et technologies de pointe.
                            </p>

                            <!-- Programs Available -->
                            <div class="mb-4">
                                <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-2">Programmes disponibles</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2.5 py-1 bg-gray-500/20 border border-gray-500/30 rounded-lg text-gray-300 text-xs">🎓 Études techniques</span>
                                    <span class="px-2.5 py-1 bg-yellow-500/20 border border-yellow-500/30 rounded-lg text-yellow-300 text-xs">⚙️ Ausbildung</span>
                                    <span class="px-2.5 py-1 bg-blue-500/20 border border-blue-500/30 rounded-lg text-blue-300 text-xs">🚗 Automobile</span>
                                    <span class="px-2.5 py-1 bg-green-500/20 border border-green-500/30 rounded-lg text-green-300 text-xs">💼 Emploi qualifié</span>
                                </div>
                            </div>

                            <!-- Key Features -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Études gratuites dans universités publiques</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Ausbildung : formation + salaire</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Salaires parmi les plus élevés d'Europe</span>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-3 p-3 bg-black/30 backdrop-blur-md rounded-xl border border-white/10 mb-4">
                                <div class="text-center">
                                    <div class="text-xl font-bold text-yellow-400">20+</div>
                                    <div class="text-xs text-white/50">Universités</div>
                                </div>
                                <div class="text-center border-x border-white/10">
                                    <div class="text-xl font-bold text-white">97%</div>
                                    <div class="text-xs text-white/50">Réussite</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-xl font-bold text-green-400">150+</div>
                                    <div class="text-xs text-white/50">Étudiants</div>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <a href="#contact" class="group/btn relative flex items-center justify-center gap-2 w-full px-5 py-3 overflow-hidden rounded-xl font-bold text-white transition-all duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-gray-700 to-yellow-500"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-gray-600 to-yellow-400 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                                <span class="relative z-10 text-sm">Découvrir l'Allemagne</span>
                                <svg class="relative z-10 w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Floating Stats Bar -->
            <div class="mt-16 max-w-5xl mx-auto">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 via-purple-500/20 to-pink-500/20 rounded-3xl blur-xl"></div>
                    <div class="relative grid grid-cols-2 md:grid-cols-4 gap-4 p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10">
                        <div class="text-center p-4 rounded-2xl hover:bg-white/5 transition-colors">
                            <div class="text-3xl md:text-4xl font-display font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">500+</div>
                            <div class="text-gray-400 text-sm mt-1">Étudiants accompagnés</div>
                        </div>
                        <div class="text-center p-4 rounded-2xl hover:bg-white/5 transition-colors">
                            <div class="text-3xl md:text-4xl font-display font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">98%</div>
                            <div class="text-gray-400 text-sm mt-1">Taux de réussite</div>
                        </div>
                        <div class="text-center p-4 rounded-2xl hover:bg-white/5 transition-colors">
                            <div class="text-3xl md:text-4xl font-display font-bold bg-gradient-to-r from-purple-400 to-pink-500 bg-clip-text text-transparent">100+</div>
                            <div class="text-gray-400 text-sm mt-1">Universités partenaires</div>
                        </div>
                        <div class="text-center p-4 rounded-2xl hover:bg-white/5 transition-colors">
                            <div class="text-3xl md:text-4xl font-display font-bold bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">24h</div>
                            <div class="text-gray-400 text-sm mt-1">Réponse garantie</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-12 text-center">
                <a href="#contact" class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <span>Consultation gratuite</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <style>
            @keyframes blob {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(20px, -30px) scale(1.1); }
                50% { transform: translate(-20px, 20px) scale(0.9); }
                75% { transform: translate(30px, 10px) scale(1.05); }
            }
            .animate-blob {
                animation: blob 8s ease-in-out infinite;
            }
            .drop-shadow-glow {
                filter: drop-shadow(0 0 10px currentColor);
            }
        </style>
    </section>

    <!-- Process Section - Modern Timeline Steps -->
    <section id="processus" class="py-20 bg-white">
        <div class="w-full px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-14 scroll-reveal">
                <h2 class="text-3xl md:text-4xl font-display font-extrabold text-dark mb-4 tracking-tight">
                    Notre accompagnement en <span class="text-primary-600">4 étapes</span>
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto text-base font-medium tracking-wide">
                    Un processus clair et personnalisé pour concrétiser votre projet
                </p>
            </div>

            <!-- Timeline -->
            <div class="relative scroll-reveal-scale">
                <!-- Connection Line - Desktop -->
                <div class="hidden md:block absolute top-14 left-[10%] right-[10%] h-1 bg-gradient-to-r from-primary-400 via-purple-500 via-orange-400 to-green-500 rounded-full"></div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-6 scroll-reveal-stagger">

                    <!-- Step 1 - Blue -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-xl shadow-primary-500/40 mx-auto group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-lg border-2 border-primary-500">
                                <span class="text-lg font-extrabold text-primary-600">1</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-display font-extrabold text-dark mb-2 uppercase tracking-widest">Consultation</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">
                            Analyse de votre projet et définition de vos objectifs.
                        </p>
                    </div>

                    <!-- Step 2 - Purple -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-xl shadow-purple-500/40 mx-auto group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-lg border-2 border-purple-500">
                                <span class="text-lg font-extrabold text-purple-600">2</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-display font-extrabold text-dark mb-2 uppercase tracking-widest">Préparation</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">
                            Constitution de votre dossier complet.
                        </p>
                    </div>

                    <!-- Step 3 - Orange -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-xl shadow-orange-500/40 mx-auto group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-lg border-2 border-orange-500">
                                <span class="text-lg font-extrabold text-orange-600">3</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-display font-extrabold text-dark mb-2 uppercase tracking-widest">Validation</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">
                            Suivi des démarches et validations.
                        </p>
                    </div>

                    <!-- Step 4 - Green -->
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-28 h-28 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-xl shadow-green-500/40 mx-auto group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-lg border-2 border-green-500">
                                <span class="text-lg font-extrabold text-green-600">4</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-display font-extrabold text-dark mb-2 uppercase tracking-widest">Départ</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">
                            Visa, logement et nouvelle vie.
                        </p>
                    </div>

                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-14">
                <a href="#contact" class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 tracking-wide">
                    <span>Commencer maintenant</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Section: Témoignages - Design Premium avec Auto-Slide -->
    <section id="temoignages" class="py-24 bg-gradient-to-b from-slate-50 via-white to-slate-50 overflow-hidden"
             x-data="{
                testimonials: [],
                loading: true,
                currentIndex: 0,
                autoPlayInterval: null,
                isPaused: false,
                colors: [
                    'from-blue-500 to-indigo-600',
                    'from-purple-500 to-pink-600',
                    'from-emerald-500 to-teal-600',
                    'from-orange-500 to-red-500',
                    'from-cyan-500 to-blue-600',
                    'from-rose-500 to-pink-600'
                ],
                flags: {
                    'CN': '🇨🇳', 'DE': '🇩🇪', 'ES': '🇪🇸', 'FR': '🇫🇷',
                    'SN': '🇸🇳', 'CI': '🇨🇮', 'ML': '🇲🇱', 'CM': '🇨🇲',
                    'BF': '🇧🇫', 'GN': '🇬🇳', 'TG': '🇹🇬', 'BJ': '🇧🇯',
                    'NE': '🇳🇪', 'GA': '🇬🇦', 'CG': '🇨🇬', 'CD': '🇨🇩',
                    'MA': '🇲🇦', 'TN': '🇹🇳', 'DZ': '🇩🇿'
                },
                countryNames: {
                    'CN': 'Chine', 'DE': 'Allemagne', 'ES': 'Espagne', 'FR': 'France',
                    'SN': 'Sénégal', 'CI': 'Côte d\'Ivoire', 'ML': 'Mali', 'CM': 'Cameroun',
                    'BF': 'Burkina Faso', 'GN': 'Guinée', 'TG': 'Togo', 'BJ': 'Bénin',
                    'NE': 'Niger', 'GA': 'Gabon', 'CG': 'Congo', 'CD': 'RD Congo',
                    'MA': 'Maroc', 'TN': 'Tunisie', 'DZ': 'Algérie'
                },
                // Mapping noms de pays vers codes ISO
                countryToCode: {
                    'chine': 'cn', 'china': 'cn', 'allemagne': 'de', 'germany': 'de',
                    'espagne': 'es', 'spain': 'es', 'france': 'fr',
                    'sénégal': 'sn', 'senegal': 'sn', 'côte d\'ivoire': 'ci', 'ivory coast': 'ci',
                    'mali': 'ml', 'cameroun': 'cm', 'cameroon': 'cm',
                    'burkina faso': 'bf', 'burkina': 'bf', 'guinée': 'gn', 'guinea': 'gn',
                    'togo': 'tg', 'bénin': 'bj', 'benin': 'bj',
                    'niger': 'ne', 'gabon': 'ga', 'congo': 'cg', 'rd congo': 'cd', 'rdc': 'cd',
                    'maroc': 'ma', 'morocco': 'ma', 'tunisie': 'tn', 'tunisia': 'tn',
                    'algérie': 'dz', 'algeria': 'dz', 'canada': 'ca', 'usa': 'us',
                    'états-unis': 'us', 'belgique': 'be', 'belgium': 'be', 'suisse': 'ch',
                    'russie': 'ru', 'russia': 'ru', 'japon': 'jp', 'japan': 'jp',
                    'turquie': 'tr', 'turkey': 'tr', 'inde': 'in', 'india': 'in'
                },
                init() {
                    this.loadTestimonials();
                },
                async loadTestimonials() {
                    try {
                        const response = await fetch('/api/testimonials?status=approved');
                        const data = await response.json();
                        if (data.data && data.data.length > 0) {
                            this.testimonials = data.data;
                            this.startAutoPlay();
                        }
                    } catch (e) {
                        console.error('Erreur chargement témoignages:', e);
                    } finally {
                        this.loading = false;
                    }
                },
                startAutoPlay() {
                    this.autoPlayInterval = setInterval(() => {
                        if (!this.isPaused) {
                            this.next();
                        }
                    }, 5000);
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.testimonials.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.testimonials.length) % this.testimonials.length;
                },
                goTo(index) {
                    this.currentIndex = index;
                },
                getInitials(name) {
                    if (!name) return '?';
                    return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
                },
                getColor(index) {
                    return this.colors[index % this.colors.length];
                },
                getFlag(code) {
                    return this.flags[code] || '🌍';
                },
                getFlagUrl(code) {
                    if (!code) return 'https://flagcdn.com/w40/xx.png';
                    // Si c'est déjà un code ISO (2 lettres), l'utiliser directement
                    let isoCode = code.toLowerCase();
                    if (isoCode.length > 2) {
                        // Chercher dans le mapping des noms de pays
                        isoCode = this.countryToCode[isoCode] || isoCode;
                    }
                    return `https://flagcdn.com/w40/${isoCode}.png`;
                },
                getCountryName(code) {
                    if (!code) return '';
                    // D'abord chercher dans countryNames par code ISO
                    if (this.countryNames[code.toUpperCase()]) {
                        return this.countryNames[code.toUpperCase()];
                    }
                    // Sinon, capitaliser le nom du pays
                    return code.charAt(0).toUpperCase() + code.slice(1).toLowerCase();
                },
                getVisibleCards() {
                    if (this.testimonials.length === 0) return [];
                    const total = this.testimonials.length;
                    const indices = [];
                    for (let i = -1; i <= 1; i++) {
                        indices.push((this.currentIndex + i + total) % total);
                    }
                    return indices;
                }
             }"
             @mouseenter="isPaused = true"
             @mouseleave="isPaused = false">

        <!-- CSS Animations Premium -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            @keyframes shimmer {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            @keyframes pulse-ring {
                0% { transform: scale(0.8); opacity: 1; }
                100% { transform: scale(1.3); opacity: 0; }
            }
            .testimonial-card-premium {
                transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            }
            .testimonial-card-premium.active {
                transform: scale(1.05) translateY(-8px);
                z-index: 20;
            }
            .testimonial-card-premium.side {
                transform: scale(0.9) translateY(0);
                opacity: 0.6;
                filter: blur(1px);
            }
            .testimonial-card-premium:hover {
                box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.2);
            }
            .avatar-ring {
                position: relative;
            }
            .avatar-ring::before {
                content: '';
                position: absolute;
                inset: -4px;
                border-radius: 50%;
                background: linear-gradient(135deg, #0071e3, #FF9500);
                z-index: -1;
                animation: pulse-ring 2s ease-out infinite;
            }
            .quote-gradient {
                background: linear-gradient(135deg, rgba(0,113,227,0.1), rgba(255,149,0,0.1));
            }
            .progress-bar {
                animation: progress 5s linear infinite;
            }
            @keyframes progress {
                0% { width: 0%; }
                100% { width: 100%; }
            }
            .star-animate {
                animation: starPop 0.3s ease-out forwards;
            }
            @keyframes starPop {
                0% { transform: scale(0); opacity: 0; }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); opacity: 1; }
            }
        </style>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Premium -->
            <div class="text-center mb-16 scroll-reveal">
                <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-gradient-to-r from-primary-50 to-accent-50 border border-primary-100 rounded-full mb-8">
                    <div class="relative">
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-ping absolute"></span>
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full relative"></span>
                    </div>
                    <span class="text-primary-700 text-sm font-bold tracking-wide uppercase">+500 Étudiants Accompagnés</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-extrabold text-slate-900 mb-6 tracking-tight">
                    Ils ont réalisé leur <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 via-purple-600 to-accent-500">rêve</span>
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-medium">
                    Découvrez les parcours inspirants de ceux qui nous ont fait confiance
                </p>
            </div>

            <!-- Stats Premium -->
            <div class="grid grid-cols-3 gap-2 sm:gap-4 md:gap-8 mb-10 sm:mb-16 max-w-3xl mx-auto scroll-reveal-stagger">
                <div class="text-center p-3 sm:p-4 md:p-6 bg-white rounded-xl sm:rounded-2xl shadow-lg shadow-primary-500/10 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-display font-extrabold bg-gradient-to-r from-primary-600 to-blue-600 bg-clip-text text-transparent">98%</div>
                    <div class="text-slate-500 text-[10px] sm:text-xs md:text-sm font-semibold mt-1 sm:mt-2 uppercase tracking-wider">Satisfaction</div>
                </div>
                <div class="text-center p-3 sm:p-4 md:p-6 bg-white rounded-xl sm:rounded-2xl shadow-lg shadow-amber-500/10 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-baseline justify-center gap-0.5 sm:gap-1">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-display font-extrabold bg-gradient-to-r from-amber-500 to-orange-500 bg-clip-text text-transparent">4.9</span>
                        <span class="text-base sm:text-lg md:text-xl text-amber-500">/5</span>
                    </div>
                    <div class="text-slate-500 text-[10px] sm:text-xs md:text-sm font-semibold mt-1 sm:mt-2 uppercase tracking-wider">Note</div>
                </div>
                <div class="text-center p-3 sm:p-4 md:p-6 bg-white rounded-xl sm:rounded-2xl shadow-lg shadow-emerald-500/10 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-display font-extrabold bg-gradient-to-r from-emerald-500 to-teal-500 bg-clip-text text-transparent">50+</div>
                    <div class="text-slate-500 text-[10px] sm:text-xs md:text-sm font-semibold mt-1 sm:mt-2 uppercase tracking-wider">Universités</div>
                </div>
            </div>

            <!-- Carrousel Premium -->
            <div class="relative">
                <!-- Loading State -->
                <template x-if="loading">
                    <div class="flex justify-center items-center py-20">
                        <div class="relative">
                            <div class="w-16 h-16 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-8 h-8 bg-primary-600 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Cards Container -->
                <template x-if="!loading && testimonials.length > 0">
                    <div>
                        <!-- Navigation Arrows -->
                        <button @click="prev()" class="absolute -left-1 sm:left-0 md:left-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-14 sm:h-14 bg-white/90 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center text-slate-600 hover:text-primary-600 hover:bg-white hover:scale-110 transition-all duration-300 border border-slate-200">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="next()" class="absolute -right-1 sm:right-0 md:right-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-14 sm:h-14 bg-white/90 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center text-slate-600 hover:text-primary-600 hover:bg-white hover:scale-110 transition-all duration-300 border border-slate-200">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Cards -->
                        <div class="flex justify-center items-center gap-2 sm:gap-6 py-4 sm:py-8 px-2 sm:px-8 lg:px-16 min-h-[380px] sm:min-h-[480px]">
                            <template x-for="(testimonial, index) in testimonials" :key="testimonial.id">
                                <div class="testimonial-card-premium absolute w-[calc(100%-1rem)] sm:w-full max-w-[calc(100%-1rem)] sm:max-w-xl h-[360px] sm:h-[440px] bg-white rounded-xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 shadow-2xl border border-slate-100 flex flex-col"
                                     :class="{
                                         'active': index === currentIndex,
                                         'side': index !== currentIndex,
                                         'opacity-0 pointer-events-none': Math.abs(index - currentIndex) > 1 && !(index === 0 && currentIndex === testimonials.length - 1) && !(index === testimonials.length - 1 && currentIndex === 0)
                                     }"
                                     :style="index === currentIndex ? 'position: relative;' : 'position: absolute;'"
                                     x-show="index === currentIndex || Math.abs(index - currentIndex) <= 1 || (index === 0 && currentIndex === testimonials.length - 1) || (index === testimonials.length - 1 && currentIndex === 0)">

                                    <!-- Header: Photo + Infos + Note -->
                                    <div class="flex items-start gap-2.5 sm:gap-4 mb-3 sm:mb-4">
                                        <!-- Avatar -->
                                        <div class="relative flex-shrink-0">
                                            <template x-if="testimonial.user && testimonial.user.avatar">
                                                <img :src="'/storage/' + testimonial.user.avatar"
                                                     :alt="testimonial.name"
                                                     class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl object-cover ring-2 ring-primary-100 shadow-lg">
                                            </template>
                                            <template x-if="!testimonial.user || !testimonial.user.avatar">
                                                <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-gradient-to-br flex items-center justify-center text-white text-base sm:text-xl font-bold ring-2 ring-primary-100 shadow-lg"
                                                     :class="getColor(index)">
                                                    <span x-text="getInitials(testimonial.name)"></span>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Infos -->
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-display font-bold text-slate-900 text-base sm:text-lg truncate" x-text="testimonial.name"></h4>
                                            <p class="text-slate-500 text-xs sm:text-sm font-medium truncate" x-text="testimonial.program || 'Étudiant'"></p>
                                            <!-- Stars -->
                                            <div class="flex gap-0.5 mt-1 sm:mt-1.5">
                                                <template x-for="star in 5" :key="'star-'+star">
                                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" :class="star <= (testimonial.rating || 5) ? 'text-amber-400' : 'text-slate-200'" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Badge Vérifié -->
                                        <div class="flex-shrink-0 flex items-center gap-1 sm:gap-1.5 px-2 sm:px-3 py-1 sm:py-1.5 bg-green-50 rounded-full border border-green-100">
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-[10px] sm:text-xs font-bold text-green-700">Vérifié</span>
                                        </div>
                                    </div>

                                    <!-- Trajet stylé - Responsive -->
                                    <div class="relative mb-4 py-3 sm:py-4 px-3 sm:px-4 bg-gradient-to-r from-slate-50 via-primary-50/30 to-slate-50 rounded-xl border border-slate-100">
                                        <div class="flex items-center justify-between gap-2 sm:gap-4">
                                            <!-- Départ -->
                                            <div class="flex items-center gap-1.5 sm:gap-2 min-w-0 flex-1">
                                                <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                                                    <img :src="getFlagUrl(testimonial.country)"
                                                         :alt="getCountryName(testimonial.country)"
                                                         class="w-6 h-4 sm:w-8 sm:h-6 object-cover rounded-sm"
                                                         onerror="this.parentElement.innerHTML='🌍'">
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-[9px] sm:text-[10px] text-slate-400 font-medium uppercase tracking-wide">Départ</p>
                                                    <p class="text-xs sm:text-sm font-bold text-slate-700 truncate" x-text="getCountryName(testimonial.country) || 'Non spécifié'"></p>
                                                </div>
                                            </div>

                                            <!-- Ligne de trajet avec avion -->
                                            <div class="flex-shrink-0 w-12 sm:w-20 md:w-24 relative mx-1 sm:mx-2">
                                                <div class="h-0.5 bg-gradient-to-r from-slate-300 via-primary-400 to-primary-500 rounded-full"></div>
                                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-6 h-6 sm:w-8 sm:h-8 bg-white rounded-full shadow-md flex items-center justify-center border-2 border-primary-200">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-500" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                                                    </svg>
                                                </div>
                                                <!-- Points sur la ligne -->
                                                <div class="absolute top-1/2 left-0 -translate-y-1/2 w-1.5 h-1.5 sm:w-2 sm:h-2 bg-slate-400 rounded-full"></div>
                                                <div class="absolute top-1/2 right-0 -translate-y-1/2 w-1.5 h-1.5 sm:w-2 sm:h-2 bg-primary-500 rounded-full"></div>
                                            </div>

                                            <!-- Destination -->
                                            <div class="flex items-center gap-1.5 sm:gap-2 min-w-0 flex-1 justify-end">
                                                <div class="min-w-0 text-right">
                                                    <p class="text-[9px] sm:text-[10px] text-slate-400 font-medium uppercase tracking-wide">Destination</p>
                                                    <p class="text-xs sm:text-sm font-bold text-primary-600 truncate" x-text="getCountryName(testimonial.destination) || 'Non spécifié'"></p>
                                                </div>
                                                <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 shadow-md flex items-center justify-center overflow-hidden flex-shrink-0">
                                                    <img :src="getFlagUrl(testimonial.destination)"
                                                         :alt="getCountryName(testimonial.destination)"
                                                         class="w-6 h-4 sm:w-8 sm:h-6 object-cover rounded-sm"
                                                         onerror="this.parentElement.innerHTML='<span class=\'text-white text-base sm:text-lg\'>🎯</span>'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Témoignage -->
                                    <div class="flex-1 min-h-[60px] sm:min-h-[80px] max-h-[80px] sm:max-h-[100px] overflow-hidden mb-3 sm:mb-4">
                                        <p class="text-slate-600 text-[13px] sm:text-[15px] leading-relaxed line-clamp-3">
                                            <span class="text-primary-400 font-serif text-xl sm:text-2xl leading-none">"</span>
                                            <span x-text="testimonial.content"></span>
                                            <span class="text-primary-400 font-serif text-xl sm:text-2xl leading-none">"</span>
                                        </p>
                                    </div>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-slate-100 mt-auto gap-2">
                                        <div class="flex items-center gap-1.5 sm:gap-2 text-slate-400 text-[10px] sm:text-xs">
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span x-text="new Date(testimonial.created_at).toLocaleDateString('fr-FR', {day: 'numeric', month: 'short', year: 'numeric'})"></span>
                                        </div>
                                        <div class="flex items-center gap-1 sm:gap-1.5 px-2 sm:px-3 py-1 sm:py-1.5 bg-primary-50 rounded-full flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-[10px] sm:text-xs font-semibold text-primary-600 whitespace-nowrap">Expérience vécue</span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Pagination Dots -->
                        <div class="flex justify-center items-center gap-2 sm:gap-3 mt-4 sm:mt-8">
                            <template x-for="(testimonial, index) in testimonials" :key="'dot-'+testimonial.id">
                                <button @click="goTo(index)"
                                        class="relative w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full transition-all duration-300"
                                        :class="index === currentIndex ? 'bg-primary-600 w-8 sm:w-10' : 'bg-slate-300 hover:bg-slate-400'">
                                    <template x-if="index === currentIndex && !isPaused">
                                        <div class="absolute inset-0 bg-primary-400 rounded-full progress-bar"></div>
                                    </template>
                                </button>
                            </template>
                        </div>

                        <!-- Auto-play indicator -->
                        <div class="flex justify-center mt-3 sm:mt-4">
                            <span class="text-xs sm:text-sm text-slate-400 font-medium" x-text="isPaused ? '⏸ En pause' : '▶ Lecture auto'"></span>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <template x-if="!loading && testimonials.length === 0">
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-500 text-lg">Aucun témoignage pour le moment.</p>
                        <p class="text-slate-400">Soyez le premier à partager votre expérience !</p>
                    </div>
                </template>
            </div>

            <!-- CTA Section - Premium Design -->
            <div class="mt-16 max-w-2xl mx-auto">
                <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-8 md:p-10 overflow-hidden">
                    <!-- Background decoration -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-primary-500/20 to-accent-500/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-accent-500/10 to-primary-500/10 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2"></div>

                    <div class="relative z-10 text-center">
                        <!-- Icon -->
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-primary-500 to-accent-500 rounded-2xl mb-6 shadow-lg shadow-primary-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                        </div>

                        <!-- Text -->
                        <h3 class="text-white text-2xl md:text-3xl font-display font-bold mb-3">
                            Votre histoire nous inspire
                        </h3>
                        <p class="text-slate-300 text-base md:text-lg leading-relaxed mb-8 max-w-lg mx-auto">
                            Vous avez vécu l'aventure internationale avec nous ? Partagez votre parcours et inspirez la prochaine génération d'étudiants.
                        </p>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <button @click="openTestimonialModal()"
                                    class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 tracking-wide">
                                <span>Partager mon expérience</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                            <button @click="evaluationModalOpen = true"
                                    class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 tracking-wide">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Formulaire d'évaluation</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section - Professional Premium Design -->
    <section id="faq" class="py-16 sm:py-24 bg-gradient-to-b from-slate-50 via-white to-slate-50 relative overflow-hidden">
        <!-- Background decorations -->
        <div class="absolute top-0 left-0 w-72 sm:w-96 h-72 sm:h-96 bg-primary-500/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-72 sm:w-96 h-72 sm:h-96 bg-accent-500/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-br from-primary-500/3 to-accent-500/3 rounded-full blur-3xl"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center mb-10 sm:mb-16 scroll-reveal">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-gradient-to-r from-primary-50 to-accent-50 border border-primary-100 rounded-full mb-4 sm:mb-6">
                    <div class="w-6 h-6 sm:w-7 sm:h-7 bg-gradient-to-br from-primary-500 to-accent-500 rounded-lg flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-primary-700 text-xs sm:text-sm font-bold">Centre d'aide</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-extrabold text-slate-900 mb-3 sm:mb-4 tracking-tight">
                    Questions <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-500">fréquentes</span>
                </h2>
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed px-4">
                    Trouvez rapidement les réponses à vos questions sur nos services d'accompagnement international
                </p>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex justify-center mb-8 sm:mb-12 scroll-reveal">
                <div class="inline-flex flex-wrap justify-center gap-2 sm:gap-3 p-1.5 sm:p-2 bg-white rounded-xl sm:rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100">
                    <template x-for="cat in faqCategories" :key="cat.id">
                        <button @click="activeFaqCategory = cat.id"
                                class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-semibold transition-all duration-300"
                                :class="activeFaqCategory === cat.id
                                    ? 'bg-gradient-to-r from-primary-600 to-accent-600 text-white shadow-lg shadow-primary-500/25'
                                    : 'text-slate-600 hover:bg-slate-50 hover:text-primary-600'">
                            <!-- Category Icons -->
                            <template x-if="cat.icon === 'grid'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                            </template>
                            <template x-if="cat.icon === 'info'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </template>
                            <template x-if="cat.icon === 'academic'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                </svg>
                            </template>
                            <template x-if="cat.icon === 'clock'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </template>
                            <template x-if="cat.icon === 'briefcase'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </template>
                            <span x-text="cat.name" class="hidden sm:inline"></span>
                        </button>
                    </template>
                </div>
            </div>

            <!-- FAQ Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 scroll-reveal-scale">
                <template x-for="(faq, index) in filteredFaqs" :key="faq.id">
                    <div class="group relative"
                         :class="faq.open ? 'lg:col-span-2' : ''">
                        <div class="h-full bg-white rounded-xl sm:rounded-2xl border border-slate-100 overflow-hidden transition-all duration-500"
                             :class="faq.open ? 'shadow-2xl shadow-primary-500/10 ring-2 ring-primary-100' : 'shadow-lg shadow-slate-200/50 hover:shadow-xl hover:border-primary-100'">

                            <button @click="faq.open = !faq.open"
                                    class="w-full flex items-start gap-3 sm:gap-4 p-4 sm:p-6 text-left">
                                <!-- Icon based on FAQ type -->
                                <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center transition-all duration-300"
                                     :class="faq.open
                                        ? 'bg-gradient-to-br from-primary-500 to-accent-500 shadow-lg shadow-primary-500/30'
                                        : 'bg-gradient-to-br from-slate-100 to-slate-50 group-hover:from-primary-100 group-hover:to-accent-50'">
                                    <!-- Globe icon -->
                                    <template x-if="faq.icon === 'globe'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </template>
                                    <!-- Calendar icon -->
                                    <template x-if="faq.icon === 'calendar'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </template>
                                    <!-- Language icon -->
                                    <template x-if="faq.icon === 'language'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                        </svg>
                                    </template>
                                    <!-- Currency icon -->
                                    <template x-if="faq.icon === 'currency'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </template>
                                    <!-- Home icon -->
                                    <template x-if="faq.icon === 'home'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </template>
                                    <!-- Building icon -->
                                    <template x-if="faq.icon === 'building'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </template>
                                    <!-- Scholarship icon -->
                                    <template x-if="faq.icon === 'scholarship'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </template>
                                    <!-- Document icon -->
                                    <template x-if="faq.icon === 'document'">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-colors duration-300" :class="faq.open ? 'text-white' : 'text-slate-500 group-hover:text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </template>
                                </div>

                                <!-- Question text -->
                                <div class="flex-1 min-w-0 pt-1">
                                    <h3 class="font-display font-bold text-sm sm:text-base lg:text-lg transition-colors duration-300 pr-8"
                                        :class="faq.open ? 'text-primary-700' : 'text-slate-800 group-hover:text-primary-600'"
                                        x-text="faq.question"></h3>

                                    <!-- Category badge -->
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium bg-slate-100 text-slate-600"
                                              x-text="faqCategories.find(c => c.id === faq.category)?.name || faq.category"></span>
                                    </div>
                                </div>

                                <!-- Toggle icon -->
                                <div class="absolute right-4 sm:right-6 top-4 sm:top-6 flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center transition-all duration-300"
                                     :class="faq.open ? 'bg-primary-100 rotate-180' : 'bg-slate-100 group-hover:bg-primary-50'">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-colors duration-300"
                                         :class="faq.open ? 'text-primary-600' : 'text-slate-400 group-hover:text-primary-500'"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>

                            <!-- Answer -->
                            <div x-show="faq.open"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 max-h-0"
                                 x-transition:enter-end="opacity-100 max-h-96"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 max-h-96"
                                 x-transition:leave-end="opacity-0 max-h-0"
                                 class="overflow-hidden">
                                <div class="px-4 sm:px-6 pb-4 sm:pb-6">
                                    <div class="ml-0 sm:ml-16 pt-2 sm:pt-0">
                                        <div class="h-px bg-gradient-to-r from-primary-200 via-accent-200 to-transparent mb-4"></div>
                                        <p class="text-slate-600 leading-relaxed text-sm sm:text-[15px]" x-text="faq.answer"></p>

                                        <!-- Action button -->
                                        <div class="mt-4 flex items-center gap-3">
                                            <a href="#contact" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                                                <span>En savoir plus</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Stats Bar -->
            <div class="mt-12 sm:mt-16 scroll-reveal">
                <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/10 rounded-full blur-2xl"></div>

                    <div class="relative z-10 grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                        <!-- Stat 1 -->
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400">500+</div>
                            <p class="text-slate-400 text-xs sm:text-sm font-medium mt-1">Clients accompagnés</p>
                        </div>
                        <!-- Stat 2 -->
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">98%</div>
                            <p class="text-slate-400 text-xs sm:text-sm font-medium mt-1">Taux de satisfaction</p>
                        </div>
                        <!-- Stat 3 -->
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-400">24h</div>
                            <p class="text-slate-400 text-xs sm:text-sm font-medium mt-1">Temps de réponse</p>
                        </div>
                        <!-- Stat 4 -->
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">5+</div>
                            <p class="text-slate-400 text-xs sm:text-sm font-medium mt-1">Années d'expérience</p>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="relative z-10 mt-8 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3 text-center sm:text-left">
                            <div class="hidden sm:flex w-12 h-12 bg-white/10 rounded-xl items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm sm:text-base">Vous avez d'autres questions ?</p>
                                <p class="text-slate-400 text-xs sm:text-sm">Notre équipe est disponible pour vous aider</p>
                            </div>
                        </div>
                        <a href="#contact" class="group inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white text-sm font-bold rounded-xl hover:shadow-lg hover:shadow-primary-500/25 transition-all duration-300">
                            <span>Contactez-nous</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section - Full Width Premium Design -->
    <section id="contact" class="py-16 lg:py-20 bg-gradient-to-b from-white via-slate-50/50 to-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-32 -right-32 w-72 h-72 bg-primary-500/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-72 h-72 bg-accent-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="w-full max-w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24 relative z-10 overflow-hidden">
            <!-- Header -->
            <div class="text-center mb-8 sm:mb-10 scroll-reveal">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-primary-50 to-accent-50 border border-primary-100 rounded-full mb-4">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span class="text-primary-700 text-xs font-bold uppercase tracking-wide">Démarrez votre projet</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-display font-extrabold text-slate-900 mb-3 tracking-tight">
                    Prêt à changer <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-500">votre vie</span> ?
                </h2>
                <p class="text-base text-slate-600 max-w-xl mx-auto">
                    Remplissez ce formulaire et recevez une consultation gratuite sous 24h
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 sm:gap-6 lg:gap-8 items-stretch max-w-full scroll-reveal-scale">
                <!-- Left Side - Info Cards -->
                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4 order-2 lg:order-1">
                    <!-- Card 1 - Nos Services -->
                    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl p-4 sm:p-5 text-white flex flex-col relative overflow-hidden min-h-0">
                        <!-- Decorative -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 rounded-full blur-3xl"></div>

                        <!-- Header -->
                        <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-base sm:text-lg font-display font-bold truncate">Nos Services</h3>
                                <p class="text-slate-400 text-[11px] sm:text-xs truncate">Solutions complètes</p>
                            </div>
                        </div>

                        <!-- Services List -->
                        <div class="space-y-2 sm:space-y-2.5 flex-1">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 bg-green-500/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-medium text-xs sm:text-sm text-white truncate">Études à l'étranger</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 bg-green-500/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-medium text-xs sm:text-sm text-white truncate">Accompagnement visa</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 bg-green-500/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-medium text-xs sm:text-sm text-white truncate">Voyages d'affaires</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 bg-green-500/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-medium text-xs sm:text-sm text-white truncate">Billets & Hébergement</p>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-2 mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-white/10">
                            <div class="text-center">
                                <div class="text-lg sm:text-xl font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">500+</div>
                                <p class="text-slate-500 text-[9px] sm:text-[10px] font-medium">Clients satisfaits</p>
                            </div>
                            <div class="text-center">
                                <div class="text-lg sm:text-xl font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-blue-400">5 ans</div>
                                <p class="text-slate-500 text-[9px] sm:text-[10px] font-medium">D'expérience</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 - Contact Direct -->
                    <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-lg shadow-slate-200/50 border border-slate-100 flex flex-col overflow-hidden min-h-0">
                        <!-- Header -->
                        <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-md shadow-green-500/20 flex-shrink-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-display font-bold text-slate-900 text-sm sm:text-base truncate">Contactez-nous</h4>
                                <p class="text-slate-500 text-[11px] sm:text-xs truncate">Réponse sous 24h</p>
                            </div>
                        </div>

                        <!-- Contact Options -->
                        <div class="space-y-2 sm:space-y-3 flex-1">
                            <a href="https://wa.me/22665604592" target="_blank" class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 rounded-xl transition-all group border border-green-100">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-md shadow-green-500/25 group-hover:scale-105 transition-transform flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-slate-900 text-xs sm:text-sm">WhatsApp</p>
                                    <p class="text-green-600 font-semibold text-[11px] sm:text-xs truncate">+226 65 60 45 92</p>
                                </div>
                                <svg class="w-4 h-4 text-green-500 group-hover:translate-x-1 transition-transform flex-shrink-0 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="mailto:armel.bakoua@travel-express.bf" class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 bg-gradient-to-r from-primary-50 to-blue-50 hover:from-primary-100 hover:to-blue-100 rounded-xl transition-all group border border-primary-100">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-md shadow-primary-500/25 group-hover:scale-105 transition-transform flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-slate-900 text-xs sm:text-sm">Email</p>
                                    <p class="text-primary-600 font-semibold text-[11px] sm:text-xs truncate">armel.bakoua@travel-express.bf</p>
                                </div>
                                <svg class="w-4 h-4 text-primary-500 group-hover:translate-x-1 transition-transform flex-shrink-0 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Location -->
                        <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-slate-100 flex items-center gap-2 sm:gap-3">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-900 text-xs sm:text-sm truncate">Ouagadougou, Burkina Faso</p>
                                <p class="text-slate-500 text-[10px] sm:text-xs truncate">Lun-Ven: 9h-18h | Sam: 10h-14h</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="lg:col-span-3 flex order-1 lg:order-2 min-w-0">
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-lg shadow-slate-200/50 border border-slate-100 flex-1 overflow-hidden min-w-0 w-full">
                        <!-- Success Message -->
                        <div id="contact-success" class="hidden">
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/30">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-display font-bold text-slate-900 mb-2">Demande envoyée !</h3>
                                <p class="text-slate-600 mb-6">Notre équipe vous contactera sous 24h via WhatsApp ou email.</p>
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Réponse garantie sous 24h</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <form id="contact-form" class="space-y-4 sm:space-y-5">
                            <!-- Step indicator -->
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] sm:text-xs font-bold text-primary-600 uppercase tracking-wider">Formulaire de contact</span>
                                <div class="flex-1 h-px bg-slate-200"></div>
                            </div>

                            <!-- Row 1: Name & Email -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div class="space-y-1.5">
                                    <label for="contact-name" class="block text-xs sm:text-sm font-semibold text-slate-700">
                                        Nom complet <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="contact-name" name="name" required placeholder="Votre nom"
                                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-slate-50 border-0 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm sm:text-base text-slate-900 placeholder-slate-400">
                                </div>
                                <div class="space-y-1.5">
                                    <label for="contact-email" class="block text-xs sm:text-sm font-semibold text-slate-700">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="contact-email" name="email" required placeholder="votre@email.com"
                                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-slate-50 border-0 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm sm:text-base text-slate-900 placeholder-slate-400">
                                </div>
                            </div>

                            <!-- Row 2: Phone -->
                            <div class="space-y-1.5">
                                <label for="contact-phone" class="block text-xs sm:text-sm font-semibold text-slate-700">
                                    WhatsApp / Téléphone <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-2" x-data="{
                                    open: false,
                                    search: '',
                                    selectedCode: '+226',
                                    selectedIso: 'bf',
                                    selectedCountry: 'Burkina Faso',
                                    countries: [
                                        { code: '+27', country: 'Afrique du Sud', iso: 'za' },
                                        { code: '+213', country: 'Algérie', iso: 'dz' },
                                        { code: '+49', country: 'Allemagne', iso: 'de' },
                                        { code: '+32', country: 'Belgique', iso: 'be' },
                                        { code: '+229', country: 'Bénin', iso: 'bj' },
                                        { code: '+55', country: 'Brésil', iso: 'br' },
                                        { code: '+226', country: 'Burkina Faso', iso: 'bf' },
                                        { code: '+257', country: 'Burundi', iso: 'bi' },
                                        { code: '+237', country: 'Cameroun', iso: 'cm' },
                                        { code: '+1', country: 'Canada/USA', iso: 'us' },
                                        { code: '+236', country: 'Centrafrique', iso: 'cf' },
                                        { code: '+86', country: 'Chine', iso: 'cn' },
                                        { code: '+242', country: 'Congo', iso: 'cg' },
                                        { code: '+243', country: 'RD Congo', iso: 'cd' },
                                        { code: '+225', country: 'Côte d\'Ivoire', iso: 'ci' },
                                        { code: '+20', country: 'Égypte', iso: 'eg' },
                                        { code: '+971', country: 'Émirats', iso: 'ae' },
                                        { code: '+34', country: 'Espagne', iso: 'es' },
                                        { code: '+251', country: 'Éthiopie', iso: 'et' },
                                        { code: '+33', country: 'France', iso: 'fr' },
                                        { code: '+241', country: 'Gabon', iso: 'ga' },
                                        { code: '+220', country: 'Gambie', iso: 'gm' },
                                        { code: '+233', country: 'Ghana', iso: 'gh' },
                                        { code: '+224', country: 'Guinée', iso: 'gn' },
                                        { code: '+245', country: 'Guinée-Bissau', iso: 'gw' },
                                        { code: '+91', country: 'Inde', iso: 'in' },
                                        { code: '+39', country: 'Italie', iso: 'it' },
                                        { code: '+81', country: 'Japon', iso: 'jp' },
                                        { code: '+254', country: 'Kenya', iso: 'ke' },
                                        { code: '+961', country: 'Liban', iso: 'lb' },
                                        { code: '+261', country: 'Madagascar', iso: 'mg' },
                                        { code: '+223', country: 'Mali', iso: 'ml' },
                                        { code: '+212', country: 'Maroc', iso: 'ma' },
                                        { code: '+230', country: 'Maurice', iso: 'mu' },
                                        { code: '+222', country: 'Mauritanie', iso: 'mr' },
                                        { code: '+227', country: 'Niger', iso: 'ne' },
                                        { code: '+234', country: 'Nigéria', iso: 'ng' },
                                        { code: '+256', country: 'Ouganda', iso: 'ug' },
                                        { code: '+31', country: 'Pays-Bas', iso: 'nl' },
                                        { code: '+351', country: 'Portugal', iso: 'pt' },
                                        { code: '+44', country: 'Royaume-Uni', iso: 'gb' },
                                        { code: '+250', country: 'Rwanda', iso: 'rw' },
                                        { code: '+221', country: 'Sénégal', iso: 'sn' },
                                        { code: '+232', country: 'Sierra Leone', iso: 'sl' },
                                        { code: '+41', country: 'Suisse', iso: 'ch' },
                                        { code: '+235', country: 'Tchad', iso: 'td' },
                                        { code: '+228', country: 'Togo', iso: 'tg' },
                                        { code: '+216', country: 'Tunisie', iso: 'tn' },
                                        { code: '+90', country: 'Turquie', iso: 'tr' },
                                        { code: '+260', country: 'Zambie', iso: 'zm' },
                                        { code: '+263', country: 'Zimbabwe', iso: 'zw' }
                                    ],
                                    get filteredCountries() {
                                        if (!this.search) return this.countries;
                                        const s = this.search.toLowerCase();
                                        return this.countries.filter(c => c.country.toLowerCase().includes(s) || c.code.includes(s));
                                    },
                                    selectCountry(c) {
                                        this.selectedCode = c.code;
                                        this.selectedIso = c.iso;
                                        this.selectedCountry = c.country;
                                        this.open = false;
                                        this.search = '';
                                        document.getElementById('contact-phone-code').value = c.code;
                                    }
                                }">
                                    <!-- Hidden input pour le formulaire -->
                                    <input type="hidden" id="contact-phone-code" name="phone_code" x-bind:value="selectedCode">

                                    <!-- Bouton sélecteur avec drapeau -->
                                    <div class="relative">
                                        <button type="button" @click="open = !open"
                                                class="flex items-center gap-1.5 sm:gap-2 w-[100px] sm:w-[130px] px-2 sm:px-3 py-2.5 sm:py-3 bg-slate-50 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-slate-900 text-xs sm:text-sm font-medium hover:bg-slate-100">
                                            <img :src="'https://flagcdn.com/24x18/' + selectedIso + '.png'"
                                                 :alt="selectedCountry"
                                                 class="w-6 h-[18px] object-cover rounded shadow-sm border border-slate-200"
                                                 onerror="this.style.display='none'">
                                            <span class="font-semibold" x-text="selectedCode"></span>
                                            <svg class="w-4 h-4 ml-auto text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>

                                        <!-- Dropdown -->
                                        <div x-show="open" @click.away="open = false"
                                             x-transition:enter="transition ease-out duration-150"
                                             x-transition:enter-start="opacity-0 scale-95"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-95"
                                             class="absolute z-50 left-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-slate-200 overflow-hidden"
                                             style="display: none;">

                                            <!-- Recherche -->
                                            <div class="p-2 border-b border-slate-100">
                                                <div class="relative">
                                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                    </svg>
                                                    <input type="text" x-model="search" placeholder="Rechercher..."
                                                           class="w-full pl-9 pr-3 py-2 text-sm border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none"
                                                           @click.stop>
                                                </div>
                                            </div>

                                            <!-- Liste des pays -->
                                            <div class="max-h-56 overflow-y-auto">
                                                <template x-for="c in filteredCountries" :key="c.iso">
                                                    <button type="button" @click="selectCountry(c)"
                                                            class="flex items-center gap-3 w-full px-3 py-2.5 hover:bg-primary-50 transition-colors text-left"
                                                            :class="{ 'bg-primary-50 border-l-2 border-primary-500': selectedIso === c.iso }">
                                                        <img :src="'https://flagcdn.com/24x18/' + c.iso + '.png'"
                                                             :alt="c.country"
                                                             class="w-6 h-[18px] object-cover rounded shadow-sm border border-slate-200">
                                                        <span class="flex-1 text-sm text-slate-700" x-text="c.country"></span>
                                                        <span class="text-sm font-semibold text-slate-500" x-text="c.code"></span>
                                                        <svg x-show="selectedIso === c.iso" class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>
                                                </template>
                                                <div x-show="filteredCountries.length === 0" class="px-3 py-4 text-sm text-slate-500 text-center">
                                                    Aucun pays trouvé
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="tel" id="contact-phone" name="phone" required placeholder="65 60 45 92"
                                           class="flex-1 min-w-0 px-3 sm:px-4 py-2.5 sm:py-3 bg-slate-50 border-0 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm sm:text-base text-slate-900 placeholder-slate-400">
                                </div>
                            </div>

                            <!-- Row 3: Destination & Project Type -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div class="space-y-1.5">
                                    <label for="contact-destination" class="block text-xs sm:text-sm font-semibold text-slate-700">
                                        Destination <span class="text-red-500">*</span>
                                    </label>
                                    <select id="contact-destination" name="destination" required
                                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-slate-50 border-0 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm sm:text-base text-slate-900">
                                        <option value="">Choisir un pays...</option>
                                        <option value="china">🇨🇳 Chine</option>
                                        <option value="germany">🇩🇪 Allemagne</option>
                                        <option value="spain">🇪🇸 Espagne</option>
                                        <option value="other">🌍 Autre pays</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label for="contact-project-type" class="block text-xs sm:text-sm font-semibold text-slate-700">
                                        Type de projet <span class="text-red-500">*</span>
                                    </label>
                                    <select id="contact-project-type" name="project_type" required
                                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-slate-50 border-0 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm sm:text-base text-slate-900">
                                        <option value="">Choisir...</option>
                                        <option value="etudes">📚 Études</option>
                                        <option value="travail">💼 Travail</option>
                                        <option value="business">🏢 Business</option>
                                        <option value="autre">📋 Autre</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Row 4: Message -->
                            <div class="space-y-1.5">
                                <label for="contact-message" class="block text-xs sm:text-sm font-semibold text-slate-700">
                                    Votre projet en quelques mots
                                </label>
                                <textarea id="contact-message" name="message" rows="3"
                                          placeholder="Décrivez brièvement votre projet..."
                                          class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-slate-50 border-0 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm sm:text-base text-slate-900 placeholder-slate-400 resize-none"></textarea>
                            </div>

                            <!-- Consent -->
                            <div class="flex items-start gap-2 sm:gap-3">
                                <input type="checkbox" id="contact-consent" name="consent" required
                                       class="mt-0.5 w-4 h-4 sm:w-5 sm:h-5 text-primary-600 bg-slate-50 border-0 rounded focus:ring-primary-500 flex-shrink-0">
                                <label for="contact-consent" class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    J'accepte d'être contacté(e) par Travel Express. <span class="text-red-500">*</span>
                                </label>
                            </div>

                            <!-- Error Message -->
                            <div id="contact-error" class="hidden bg-red-50 border border-red-200 rounded-lg sm:rounded-xl p-3 sm:p-4 text-red-700 text-xs sm:text-sm"></div>

                            <!-- Submit Button -->
                            <button type="submit" id="contact-submit"
                                    class="w-full py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-accent-600 text-white font-bold text-sm sm:text-base rounded-lg sm:rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-xl hover:shadow-primary-500/40 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                                <span id="submit-text">Envoyer ma demande</span>
                                <svg id="submit-icon" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                <svg id="submit-loading" class="hidden animate-spin w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>

                            
                            <!-- Trust badges -->
                            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6 pt-4">
                                <div class="flex items-center gap-1.5 sm:gap-2 text-slate-500 text-[11px] sm:text-xs">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Données sécurisées</span>
                                </div>
                                <div class="flex items-center gap-1.5 sm:gap-2 text-slate-500 text-[11px] sm:text-xs">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Réponse 24h</span>
                                </div>
                                <div class="flex items-center gap-1.5 sm:gap-2 text-slate-500 text-[11px] sm:text-xs">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-accent-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Consultation gratuite</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Localisation / Carte -->
    <section id="localisation" class="py-16 lg:py-20 bg-gradient-to-b from-white to-slate-50 relative overflow-hidden">
        <!-- Éléments décoratifs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/3 translate-y-1/3"></div>

        <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24 relative z-10">
            <!-- En-tête de section -->
            <div class="text-center mb-12 scroll-reveal">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 rounded-full mb-4">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-semibold text-primary-700">Notre présence</span>
                </div>
                <h2 class="text-3xl lg:text-4xl font-display font-bold text-slate-900 mb-4">
                    Retrouvez-nous à <span class="text-primary-600">Ouagadougou</span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Venez nous rencontrer dans nos bureaux pour discuter de votre projet en personne
                </p>
            </div>

            <!-- Carte pleine largeur -->
            <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden scroll-reveal-scale">
                <!-- Carte Leaflet -->
                <div id="map-travel-express" class="w-full h-[450px] lg:h-[500px] rounded-3xl z-0"></div>

                <!-- Bouton Itinéraire -->
                <div class="absolute bottom-4 right-4 flex gap-2 z-[1000]">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=12.348568,-1.4896206&travelmode=driving"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 hover:shadow-xl hover:scale-105 transition-all duration-300 text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Itinéraire
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer Premium -->
    <footer class="relative overflow-hidden">
        <!-- Background avec motif géométrique -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Éléments décoratifs -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>

        <div class="relative">
            <!-- Newsletter Section -->
            <div class="border-b border-white/10">
                <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24 py-12 sm:py-16">
                    <div class="max-w-4xl mx-auto text-center">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500/20 rounded-full mb-6">
                            <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-primary-300 text-sm font-medium">Newsletter</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-display font-bold text-white mb-3">
                            Restez informé de nos opportunités
                        </h3>
                        <p class="text-gray-400 mb-8 max-w-xl mx-auto">
                            Recevez les dernières actualités sur les programmes d'études et les opportunités à l'étranger.
                        </p>
                        <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                            <div class="flex-1 relative">
                                <input type="email" placeholder="Votre adresse email" class="w-full px-5 py-4 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent backdrop-blur-sm">
                            </div>
                            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold rounded-xl hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25 flex items-center justify-center gap-2 group">
                                S'abonner
                                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Footer Content -->
            <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24 py-12 sm:py-16">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 lg:gap-12">
                    <!-- Company Info -->
                    <div class="col-span-2 lg:col-span-2 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-3 mb-6">
                            <!-- Logo -->
                            <img src="/images/logo/logo_travel.png" alt="Travel Express" class="h-24 sm:h-28 w-auto">
                        </div>
                        <p class="text-gray-400 leading-relaxed mb-6 max-w-sm mx-auto md:mx-0">
                            Votre partenaire de confiance pour réaliser vos rêves d'études et de business à l'international. Accompagnement personnalisé et expertise reconnue.
                        </p>

                        <!-- Social Links -->
                        <div class="flex items-center justify-center md:justify-start gap-3">
                            <a href="#" class="group w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center hover:bg-primary-500 hover:border-primary-500 transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                                </svg>
                            </a>
                            <a href="#" class="group w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 hover:border-transparent transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                                </svg>
                            </a>
                            <a href="#" class="group w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center hover:bg-blue-500 hover:border-blue-500 transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"></path>
                                </svg>
                            </a>
                            <a href="https://wa.me/22665604592" class="group w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center hover:bg-green-500 hover:border-green-500 transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-display font-bold text-white mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                            Navigation
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="#programmes" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-600 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Nos programmes
                                </a>
                            </li>
                            <li>
                                <a href="#pourquoi" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-600 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Pourquoi nous
                                </a>
                            </li>
                            <li>
                                <a href="#processus" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-600 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Notre processus
                                </a>
                            </li>
                            <li>
                                <a href="#temoignages" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-600 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Témoignages
                                </a>
                            </li>
                            <li>
                                <a href="#faq" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-600 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    FAQ
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Destinations -->
                    <div>
                        <h4 class="font-display font-bold text-white mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                            Destinations
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="#programmes" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="text-base">🇨🇳</span>
                                    <span>Chine</span>
                                </a>
                            </li>
                            <li>
                                <a href="#programmes" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="text-base">🇪🇸</span>
                                    <span>Espagne</span>
                                </a>
                            </li>
                            <li>
                                <a href="#programmes" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="text-base">🇩🇪</span>
                                    <span>Allemagne</span>
                                </a>
                            </li>
                            <li>
                                <a href="#programmes" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="text-base">🇷🇺</span>
                                    <span>Russie</span>
                                </a>
                            </li>
                            <li>
                                <a href="#programmes" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="text-base">🇹🇷</span>
                                    <span>Turquie</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="font-display font-bold text-white mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            Contact
                        </h4>
                        <ul class="space-y-4">
                            <li>
                                <a href="https://maps.google.com" target="_blank" class="flex items-start gap-3 group">
                                    <div class="w-10 h-10 bg-white/5 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary-500/20 transition-colors">
                                        <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white text-sm font-medium">Ouagadougou</p>
                                        <p class="text-gray-400 text-xs">Burkina Faso</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/22665604592" class="flex items-start gap-3 group">
                                    <div class="w-10 h-10 bg-white/5 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-green-500/20 transition-colors">
                                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white text-sm font-medium">+226 65 60 45 92</p>
                                        <p class="text-gray-400 text-xs">WhatsApp disponible</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:armel.bakoua@travel-express.bf" class="flex items-start gap-3 group">
                                    <div class="w-10 h-10 bg-white/5 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary-500/20 transition-colors">
                                        <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white text-sm font-medium break-all">armel.bakoua@travel-express.bf</p>
                                        <p class="text-gray-400 text-xs">Réponse sous 24h</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/10">
                <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-24 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-4">
                            <p class="text-gray-400 text-sm">
                                © 2025 <span class="text-white font-medium">Travel Express</span>. Tous droits réservés.
                            </p>
                        </div>

                        <div class="flex flex-wrap justify-center gap-4 sm:gap-6 text-sm">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Conditions d'utilisation</a>
                            <span class="text-gray-600 hidden sm:inline">•</span>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Politique de confidentialité</a>
                            <span class="text-gray-600 hidden sm:inline">•</span>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Mentions légales</a>
                        </div>

                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <span>Fait avec</span>
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                            <span>au Burkina Faso</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* Animations de base */
        @keyframes blob {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        /* Animations d'apparition au scroll */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Classes d'animation */
        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .fade-in-left {
            opacity: 0;
            animation: fadeInLeft 0.6s ease-out forwards;
        }
        .fade-in-right {
            opacity: 0;
            animation: fadeInRight 0.6s ease-out forwards;
        }
        .scale-in {
            opacity: 0;
            animation: scaleIn 0.5s ease-out forwards;
        }

        /* Délais d'animation échelonnés */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }
        .stagger-6 { animation-delay: 0.6s; }

        /* Sections avec transition douce */
        section {
            scroll-margin-top: 100px;
        }

        /* Hover effects améliorés pour les cards */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }

        /* Gradient animé pour les titres */
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Modal Témoignage -->
    <div x-show="testimonialModalOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         @click.self="testimonialModalOpen = false"
         style="display: none;">

        <div x-show="testimonialModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden max-h-[90vh] overflow-y-auto">

            <!-- Header du modal -->
            <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-accent-500 px-6 py-5 sticky top-0 z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Partagez votre expérience</h3>
                            <p class="text-white/70 text-xs mt-0.5">Votre témoignage inspirera d'autres voyageurs</p>
                        </div>
                    </div>
                    <button @click="testimonialModalOpen = false" class="text-white/80 hover:text-white transition-colors p-1 hover:bg-white/10 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Formulaire -->
            <form x-data="{
                user: null,
                destination: '',
                message: '',
                rating: 5,
                submitting: false,
                success: false,
                error: '',
                avatarPreview: null,
                avatarFile: null,
                loading: true,
                countryNames: {
                    'Sénégal': '🇸🇳', 'Côte d\'Ivoire': '🇨🇮', 'Mali': '🇲🇱', 'Cameroun': '🇨🇲',
                    'Burkina Faso': '🇧🇫', 'Guinée': '🇬🇳', 'Togo': '🇹🇬', 'Bénin': '🇧🇯',
                    'Niger': '🇳🇪', 'Gabon': '🇬🇦', 'Congo': '🇨🇬', 'RD Congo': '🇨🇩',
                    'Maroc': '🇲🇦', 'Tunisie': '🇹🇳', 'Algérie': '🇩🇿', 'Chine': '🇨🇳',
                    'Espagne': '🇪🇸', 'Allemagne': '🇩🇪', 'France': '🇫🇷'
                },
                getFlag(country) {
                    return this.countryNames[country] || '🌍';
                },
                async init() {
                    const token = localStorage.getItem('auth_token');
                    if (token) {
                        try {
                            const response = await fetch('/api/user', {
                                headers: {
                                    'Authorization': 'Bearer ' + token,
                                    'Accept': 'application/json'
                                }
                            });
                            if (response.ok) {
                                const data = await response.json();
                                this.user = data.data || data;
                                if (this.user.avatar) {
                                    this.avatarPreview = '/storage/' + this.user.avatar;
                                }
                            }
                        } catch (e) {
                            console.error('Erreur chargement utilisateur:', e);
                        }
                    }
                    this.loading = false;
                },
                handleAvatarChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.avatarFile = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.avatarPreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },
                async submitTestimonial() {
                    this.submitting = true;
                    this.error = '';

                    try {
                        const token = localStorage.getItem('auth_token');

                        // Upload avatar si nouveau
                        if (this.avatarFile) {
                            const formData = new FormData();
                            formData.append('avatar', this.avatarFile);
                            await fetch('/api/profile/avatar', {
                                method: 'POST',
                                headers: {
                                    'Authorization': 'Bearer ' + token,
                                    'Accept': 'application/json'
                                },
                                body: formData
                            });
                        }

                        const response = await fetch('/api/testimonials', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + token
                            },
                            body: JSON.stringify({
                                destination: this.destination,
                                content: this.message,
                                rating: this.rating
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.success = true;
                            setTimeout(() => {
                                testimonialModalOpen = false;
                                this.success = false;
                                this.destination = '';
                                this.message = '';
                                this.rating = 5;
                                this.avatarFile = null;
                            }, 2500);
                        } else {
                            this.error = data.message || 'Une erreur est survenue';
                        }
                    } catch (e) {
                        this.error = 'Erreur de connexion. Veuillez réessayer.';
                    } finally {
                        this.submitting = false;
                    }
                }
            }" x-init="init()" @submit.prevent="submitTestimonial" class="p-6 space-y-5">

                <!-- Chargement -->
                <div x-show="loading" class="flex items-center justify-center py-12">
                    <svg class="animate-spin w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <!-- Message de succès -->
                <div x-show="success" x-transition class="bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">Merci pour votre témoignage !</p>
                        <p class="text-sm text-emerald-600">Il sera visible après validation par notre équipe.</p>
                    </div>
                </div>

                <!-- Message d'erreur -->
                <div x-show="error" x-transition class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-text="error"></span>
                </div>

                <template x-if="!loading && !success">
                    <div class="space-y-5">
                        <!-- Profil utilisateur avec photo -->
                        <div class="bg-gradient-to-br from-slate-50 to-gray-50 rounded-2xl p-5 border border-slate-100">
                            <div class="flex items-start gap-4">
                                <!-- Avatar avec upload -->
                                <div class="relative group">
                                    <div class="w-20 h-20 rounded-2xl overflow-hidden ring-4 ring-white shadow-lg">
                                        <template x-if="avatarPreview">
                                            <img :src="avatarPreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!avatarPreview">
                                            <div class="w-full h-full bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center">
                                                <span class="text-white text-2xl font-bold" x-text="user?.name?.charAt(0)?.toUpperCase() || '?'"></span>
                                            </div>
                                        </template>
                                    </div>
                                    <label class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer rounded-2xl">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <input type="file" class="hidden" accept="image/*" @change="handleAvatarChange($event)">
                                    </label>
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center ring-2 ring-white">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Infos utilisateur -->
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-gray-900" x-text="user?.name || 'Utilisateur'"></h4>
                                    <p class="text-sm text-primary-600 font-medium" x-text="user?.position || 'Voyageur'"></p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="text-lg" x-text="getFlag(user?.country)"></span>
                                        <span class="text-sm text-gray-600" x-text="user?.country || 'Pays non spécifié'"></span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Survolez la photo pour la modifier
                            </p>
                        </div>

                        <!-- Trajet stylisé -->
                        <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-2xl p-5 border border-indigo-100">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Votre trajet
                            </label>
                            <div class="flex items-center gap-3">
                                <!-- Départ -->
                                <div class="flex-1 bg-white rounded-xl p-3 border border-slate-200 shadow-sm">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Départ</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xl" x-text="getFlag(user?.country)"></span>
                                        <span class="text-sm font-medium text-gray-700" x-text="user?.country || 'Votre pays'"></span>
                                    </div>
                                </div>

                                <!-- Flèche avec avion -->
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Destination -->
                                <div class="flex-1">
                                    <div class="bg-white rounded-xl p-3 border-2 border-dashed border-indigo-300 shadow-sm">
                                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Destination</p>
                                        <select x-model="destination" required
                                                class="w-full text-sm font-medium text-gray-700 bg-transparent border-none focus:ring-0 p-0 cursor-pointer">
                                            <option value="">Choisir...</option>
                                            <option value="Chine">🇨🇳 Chine</option>
                                            <option value="Espagne">🇪🇸 Espagne</option>
                                            <option value="Allemagne">🇩🇪 Allemagne</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Note avec étoiles -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Votre évaluation
                            </label>
                            <div class="flex items-center gap-3 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl p-4 border border-amber-100">
                                <div class="flex items-center gap-1">
                                    <template x-for="star in 5" :key="star">
                                        <button type="button" @click="rating = star"
                                                class="focus:outline-none transition-all duration-200 hover:scale-125"
                                                :class="star <= rating ? 'drop-shadow-lg' : ''">
                                            <svg class="w-9 h-9 transition-colors"
                                                 :class="star <= rating ? 'text-amber-400' : 'text-gray-200'"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                                <div class="flex-1">
                                    <p class="text-lg font-bold text-amber-600" x-text="rating + '/5'"></p>
                                    <p class="text-xs text-amber-500"
                                       x-text="rating === 5 ? 'Excellent !' : rating === 4 ? 'Très bien' : rating === 3 ? 'Bien' : rating === 2 ? 'Moyen' : 'À améliorer'"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Votre témoignage
                            </label>
                            <div class="relative">
                                <textarea x-model="message" required rows="4" minlength="20" maxlength="500"
                                          class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                                          placeholder="Racontez votre expérience avec Travel Express... Comment s'est passé votre voyage ? Qu'avez-vous apprécié ?"></textarea>
                                <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                    <span x-text="message.length"></span>/500
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Minimum 20 caractères</p>
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-3 pt-3">
                            <button type="button" @click="testimonialModalOpen = false"
                                    class="flex-1 px-5 py-3 border border-gray-200 text-gray-700 font-medium rounded-xl text-sm hover:bg-gray-50 transition-all">
                                Annuler
                            </button>
                            <button type="submit" :disabled="submitting || message.length < 20 || !destination"
                                    class="flex-1 px-5 py-3 bg-gradient-to-r from-primary-600 to-accent-500 text-white font-semibold rounded-xl text-sm hover:shadow-lg hover:shadow-primary-500/25 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:shadow-none flex items-center justify-center gap-2">
                                <svg x-show="submitting" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <svg x-show="!submitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                <span x-text="submitting ? 'Envoi en cours...' : 'Publier mon témoignage'"></span>
                            </button>
                        </div>
                    </div>
                </template>
            </form>
        </div>
    </div>

    <!-- Evaluation Modal - Formulaire pour les anciens collaborateurs -->
    <div x-show="evaluationModalOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="evaluationModalOpen = false"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm flex items-start justify-center p-4 pt-10 pb-10"
         style="display: none;">
        <div x-show="evaluationModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95"
             @click.stop
             class="relative w-full max-w-3xl bg-white rounded-3xl shadow-2xl overflow-hidden">

            <!-- Header with gradient -->
            <div class="relative bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 px-6 py-6 text-white">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.08\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Formulaire d'évaluation</h3>
                            <p class="text-white/80 text-sm">Partagez votre expérience avec Travel Express</p>
                        </div>
                    </div>
                    <button @click="evaluationModalOpen = false" class="text-white/80 hover:text-white transition-colors p-2 hover:bg-white/10 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Form Content -->
            <form id="evaluation-form" class="p-6 max-h-[70vh] overflow-y-auto" x-data="{
                step: 1,
                totalSteps: 4,
                submitting: false,
                success: false,
                error: null,

                // Form data
                firstName: '',
                lastName: '',
                email: '',
                phone: '',

                university: '',
                countryOfStudy: '',
                studyLevel: '',
                fieldOfStudy: '',
                startYear: '',
                serviceUsed: 'etudes',

                projectStory: '',
                discoverySource: '',
                discoverySourceDetail: '',

                rating: 5,
                ratingAccompagnement: 5,
                ratingCommunication: 5,
                ratingDelais: 5,
                ratingQualitePrix: 5,
                wouldRecommend: true,
                comment: '',

                publicTestimonial: '',
                allowPublicDisplay: false,
                allowPhotoDisplay: false,

                // Signature
                signatureData: '',
                signatureCanvas: null,
                signatureCtx: null,
                isDrawing: false,

                // Prefill from logged user
                init() {
                    // Initialize signature canvas after DOM is ready
                    this.$nextTick(() => {
                        this.initSignatureCanvas();
                    });

                    const token = localStorage.getItem('auth_token');
                    if (token) {
                        fetch('/api/user', {
                            headers: { 'Authorization': 'Bearer ' + token }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.name) {
                                const parts = data.name.split(' ');
                                this.firstName = parts[0] || '';
                                this.lastName = parts.slice(1).join(' ') || '';
                            }
                            if (data.email) this.email = data.email;
                            if (data.phone) this.phone = data.phone;
                        })
                        .catch(() => {});
                    }
                },

                initSignatureCanvas() {
                    const canvas = document.getElementById('signature-canvas');
                    if (!canvas) return;

                    this.signatureCanvas = canvas;
                    this.signatureCtx = canvas.getContext('2d');
                    this.signatureCtx.strokeStyle = '#1e3a5f';
                    this.signatureCtx.lineWidth = 2;
                    this.signatureCtx.lineCap = 'round';
                    this.signatureCtx.lineJoin = 'round';

                    // Mouse events
                    canvas.addEventListener('mousedown', (e) => this.startDrawing(e));
                    canvas.addEventListener('mousemove', (e) => this.draw(e));
                    canvas.addEventListener('mouseup', () => this.stopDrawing());
                    canvas.addEventListener('mouseout', () => this.stopDrawing());

                    // Touch events
                    canvas.addEventListener('touchstart', (e) => { e.preventDefault(); this.startDrawing(e.touches[0]); });
                    canvas.addEventListener('touchmove', (e) => { e.preventDefault(); this.draw(e.touches[0]); });
                    canvas.addEventListener('touchend', () => this.stopDrawing());
                },

                startDrawing(e) {
                    this.isDrawing = true;
                    const rect = this.signatureCanvas.getBoundingClientRect();
                    this.signatureCtx.beginPath();
                    this.signatureCtx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
                },

                draw(e) {
                    if (!this.isDrawing) return;
                    const rect = this.signatureCanvas.getBoundingClientRect();
                    this.signatureCtx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
                    this.signatureCtx.stroke();
                },

                stopDrawing() {
                    if (this.isDrawing) {
                        this.isDrawing = false;
                        this.signatureData = this.signatureCanvas.toDataURL('image/png');
                    }
                },

                clearSignature() {
                    if (this.signatureCtx && this.signatureCanvas) {
                        this.signatureCtx.clearRect(0, 0, this.signatureCanvas.width, this.signatureCanvas.height);
                        this.signatureData = '';
                    }
                },

                nextStep() {
                    if (this.step < this.totalSteps) this.step++;
                    // Re-init signature canvas when reaching step 4
                    if (this.step === 4) {
                        this.$nextTick(() => this.initSignatureCanvas());
                    }
                },
                prevStep() {
                    if (this.step > 1) this.step--;
                },

                async submitForm() {
                    this.submitting = true;
                    this.error = null;

                    const formData = {
                        first_name: this.firstName,
                        last_name: this.lastName,
                        email: this.email,
                        phone: this.phone,
                        university: this.university,
                        country_of_study: this.countryOfStudy,
                        study_level: this.studyLevel,
                        field_of_study: this.fieldOfStudy,
                        start_year: this.startYear || null,
                        service_used: this.serviceUsed,
                        project_story: this.projectStory,
                        discovery_source: this.discoverySource,
                        discovery_source_detail: this.discoverySourceDetail || null,
                        rating: this.rating,
                        rating_accompagnement: this.ratingAccompagnement,
                        rating_communication: this.ratingCommunication,
                        rating_delais: this.ratingDelais,
                        rating_rapport_qualite_prix: this.ratingQualitePrix,
                        would_recommend: this.wouldRecommend,
                        comment: this.comment || null,
                        public_testimonial: this.publicTestimonial || null,
                        allow_public_display: this.allowPublicDisplay,
                        allow_photo_display: this.allowPhotoDisplay,
                        signature: this.signatureData
                    };

                    try {
                        const token = localStorage.getItem('auth_token');
                        const headers = {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        };
                        if (token) headers['Authorization'] = 'Bearer ' + token;

                        const response = await fetch('/api/evaluations', {
                            method: 'POST',
                            headers: headers,
                            body: JSON.stringify(formData)
                        });

                        const result = await response.json();

                        if (response.ok) {
                            this.success = true;
                        } else {
                            this.error = result.message || 'Une erreur est survenue.';
                        }
                    } catch (e) {
                        this.error = 'Erreur de connexion. Veuillez réessayer.';
                    } finally {
                        this.submitting = false;
                    }
                }
            }">
                <!-- Progress bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Étape <span x-text="step"></span> sur <span x-text="totalSteps"></span></span>
                        <span class="text-sm text-gray-500" x-text="step === 1 ? 'Informations personnelles' : step === 2 ? 'Parcours académique' : step === 3 ? 'Votre expérience' : 'Évaluation'"></span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 transition-all duration-500 rounded-full" :style="'width: ' + (step / totalSteps * 100) + '%'"></div>
                    </div>
                </div>

                <!-- Success Message -->
                <div x-show="success" x-transition class="text-center py-12">
                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Merci pour votre évaluation !</h4>
                    <p class="text-gray-600 mb-6">Votre retour est précieux et nous aide à améliorer nos services.</p>
                    <button @click="evaluationModalOpen = false; success = false; step = 1;" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-colors">
                        Fermer
                    </button>
                </div>

                <!-- Error Message -->
                <div x-show="error" x-transition class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-red-700 text-sm" x-text="error"></span>
                    <button @click="error = null" class="ml-auto text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Step 1: Informations personnelles -->
                <div x-show="step === 1 && !success" x-transition>
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Prénom *</label>
                                <input type="text" x-model="firstName" required placeholder="Votre prénom"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                                <input type="text" x-model="lastName" required placeholder="Votre nom"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input type="email" x-model="email" required placeholder="votre.email@exemple.com"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" x-model="phone" placeholder="+226 70 00 00 00"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Parcours académique -->
                <div x-show="step === 2 && !success" x-transition>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Université / École *</label>
                            <input type="text" x-model="university" required placeholder="Nom de votre université ou école"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pays d'études *</label>
                                <select x-model="countryOfStudy" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    <option value="">Sélectionner...</option>
                                    <option value="Chine">Chine</option>
                                    <option value="Espagne">Espagne</option>
                                    <option value="Allemagne">Allemagne</option>
                                    <option value="France">France</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Niveau d'études *</label>
                                <select x-model="studyLevel" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    <option value="">Sélectionner...</option>
                                    <option value="licence_1">Licence 1</option>
                                    <option value="licence_2">Licence 2</option>
                                    <option value="licence_3">Licence 3</option>
                                    <option value="master_1">Master 1</option>
                                    <option value="master_2">Master 2</option>
                                    <option value="doctorat">Doctorat</option>
                                    <option value="formation_professionnelle">Formation professionnelle</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Filière *</label>
                                <input type="text" x-model="fieldOfStudy" required placeholder="Ex: Informatique, Commerce..."
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Année de début</label>
                                <select x-model="startYear"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    <option value="">Sélectionner...</option>
                                    <template x-for="year in Array.from({length: 10}, (_, i) => new Date().getFullYear() - i)" :key="year">
                                        <option :value="year" x-text="year"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Type de service utilisé</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="serviceUsed" value="etudes" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">🎓</span>
                                        <span class="text-sm font-medium">Études</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="serviceUsed" value="business" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">💼</span>
                                        <span class="text-sm font-medium">Business</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="serviceUsed" value="visa_seul" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">📄</span>
                                        <span class="text-sm font-medium">Visa seul</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Expérience -->
                <div x-show="step === 3 && !success" x-transition>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Comment êtes-vous parvenu(e) à réaliser votre projet de voyage ? *</label>
                            <textarea x-model="projectStory" required rows="4" placeholder="Racontez-nous votre parcours, les étapes clés, les défis surmontés..."
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                            <p class="text-xs text-gray-500 mt-1">Minimum 50 caractères - <span x-text="projectStory.length"></span>/50</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Comment avez-vous connu Travel Express ? *</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="ambassadeur_la_bobolaise" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">👩‍💼</span>
                                        <span class="text-xs font-medium">La Bobolaise</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="ambassadeur_ley_ley" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">👨‍💼</span>
                                        <span class="text-xs font-medium">Ley Ley</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="ambassadeur_autre" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">🤝</span>
                                        <span class="text-xs font-medium">Autre ambassadeur</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="facebook" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">📘</span>
                                        <span class="text-xs font-medium">Facebook</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="tiktok" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">🎵</span>
                                        <span class="text-xs font-medium">TikTok</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="instagram" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">📸</span>
                                        <span class="text-xs font-medium">Instagram</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="youtube" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">▶️</span>
                                        <span class="text-xs font-medium">YouTube</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="bouche_a_oreille" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">🗣️</span>
                                        <span class="text-xs font-medium">Bouche à oreille</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" x-model="discoverySource" value="autre" class="peer sr-only">
                                    <div class="p-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-2xl mb-1 block">❓</span>
                                        <span class="text-xs font-medium">Autre</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div x-show="discoverySource === 'ambassadeur_autre' || discoverySource === 'autre'" x-transition>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Précisez</label>
                            <input type="text" x-model="discoverySourceDetail" placeholder="Nom de l'ambassadeur ou autre source..."
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Step 4: Évaluation -->
                <div x-show="step === 4 && !success" x-transition>
                    <div class="space-y-6">
                        <!-- Note globale -->
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Note globale à Travel Express *</label>
                            <div class="flex items-center justify-center gap-2">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click="rating = star" class="focus:outline-none transform hover:scale-110 transition-transform">
                                        <svg class="w-10 h-10 transition-colors" :class="star <= rating ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <p class="text-center text-sm text-gray-600 mt-2" x-text="rating === 5 ? 'Excellent !' : rating === 4 ? 'Très bien' : rating === 3 ? 'Bien' : rating === 2 ? 'Moyen' : 'À améliorer'"></p>
                        </div>

                        <!-- Notes détaillées -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Accompagnement</label>
                                <div class="flex gap-1">
                                    <template x-for="star in 5" :key="'acc-'+star">
                                        <button type="button" @click="ratingAccompagnement = star" class="focus:outline-none">
                                            <svg class="w-6 h-6" :class="star <= ratingAccompagnement ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Communication</label>
                                <div class="flex gap-1">
                                    <template x-for="star in 5" :key="'com-'+star">
                                        <button type="button" @click="ratingCommunication = star" class="focus:outline-none">
                                            <svg class="w-6 h-6" :class="star <= ratingCommunication ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Respect des délais</label>
                                <div class="flex gap-1">
                                    <template x-for="star in 5" :key="'del-'+star">
                                        <button type="button" @click="ratingDelais = star" class="focus:outline-none">
                                            <svg class="w-6 h-6" :class="star <= ratingDelais ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Rapport qualité/prix</label>
                                <div class="flex gap-1">
                                    <template x-for="star in 5" :key="'qp-'+star">
                                        <button type="button" @click="ratingQualitePrix = star" class="focus:outline-none">
                                            <svg class="w-6 h-6" :class="star <= ratingQualitePrix ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Recommandation -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Recommanderiez-vous Travel Express ?</label>
                            <div class="flex gap-4">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" x-model="wouldRecommend" :value="true" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                        <span class="text-3xl mb-2 block">👍</span>
                                        <span class="font-semibold text-gray-700">Oui, absolument !</span>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" x-model="wouldRecommend" :value="false" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-red-500 peer-checked:bg-red-50 transition-all">
                                        <span class="text-3xl mb-2 block">👎</span>
                                        <span class="font-semibold text-gray-700">Non</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Commentaire -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Laissez un commentaire à Travel Express</label>
                            <textarea x-model="comment" rows="3" placeholder="Vos suggestions, remarques ou feedback..."
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                        </div>

                        <!-- Témoignage public optionnel -->
                        <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">
                            <div class="flex items-start gap-3 mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Témoignage public (optionnel)</h4>
                                    <p class="text-sm text-gray-600">Votre témoignage pourra être affiché sur notre site pour inspirer d'autres personnes.</p>
                                </div>
                            </div>
                            <textarea x-model="publicTestimonial" rows="3" placeholder="Écrivez un témoignage qui pourrait aider d'autres personnes..."
                                      class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none bg-white"></textarea>
                            <div class="mt-3 space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" x-model="allowPublicDisplay" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">J'autorise l'affichage de mon témoignage sur le site</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" x-model="allowPhotoDisplay" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">J'autorise l'affichage de ma photo</span>
                                </label>
                            </div>
                        </div>

                        <!-- Signature -->
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-5 border border-amber-200">
                            <div class="flex items-start gap-3 mb-4">
                                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Signature *</h4>
                                    <p class="text-sm text-gray-600">Signez dans le cadre ci-dessous pour valider votre évaluation</p>
                                </div>
                            </div>
                            <div class="relative">
                                <canvas id="signature-canvas" width="500" height="150"
                                        class="w-full border-2 border-dashed border-amber-300 rounded-xl bg-white cursor-crosshair touch-none"
                                        style="max-height: 150px;"></canvas>
                                <button type="button" @click="clearSignature()"
                                        class="absolute top-2 right-2 p-2 bg-white/80 hover:bg-white text-gray-500 hover:text-red-500 rounded-lg transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-amber-700 mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Utilisez votre souris ou votre doigt pour signer
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div x-show="!success" class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                    <button type="button" @click="prevStep()" x-show="step > 1"
                            class="px-5 py-2.5 text-gray-600 hover:text-gray-900 font-medium rounded-xl hover:bg-gray-100 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Précédent
                    </button>
                    <div x-show="step === 1"></div>

                    <button type="button" @click="nextStep()" x-show="step < totalSteps"
                            :disabled="(step === 1 && (!firstName || !lastName || !email)) || (step === 2 && (!university || !countryOfStudy || !studyLevel || !fieldOfStudy)) || (step === 3 && (!projectStory || projectStory.length < 50 || !discoverySource))"
                            class="px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                        Suivant
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <button type="button" @click="submitForm()" x-show="step === totalSteps" :disabled="submitting || !signatureData"
                            class="px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                        <svg x-show="submitting" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <svg x-show="!submitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-text="submitting ? 'Envoi...' : 'Envoyer mon évaluation'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Form Script -->
    <script>
        document.getElementById('contact-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('contact-submit');
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const submitLoading = document.getElementById('submit-loading');
            const errorDiv = document.getElementById('contact-error');
            const successDiv = document.getElementById('contact-success');

            // Hide error
            errorDiv.classList.add('hidden');

            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Envoi en cours...';
            submitIcon.classList.add('hidden');
            submitLoading.classList.remove('hidden');

            // Gather form data
            const phoneCode = document.getElementById('contact-phone-code').value;
            const phoneNumber = document.getElementById('contact-phone').value.replace(/\s/g, '');
            const fullPhone = phoneCode + phoneNumber;

            const formData = {
                name: document.getElementById('contact-name').value,
                email: document.getElementById('contact-email').value,
                phone: fullPhone,
                destination: document.getElementById('contact-destination').value,
                project_type: document.getElementById('contact-project-type').value,
                message: document.getElementById('contact-message').value || null
            };

            try {
                const response = await fetch('/api/contact-requests', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (result.success) {
                    // Show success message
                    form.classList.add('hidden');
                    successDiv.classList.remove('hidden');

                    // Scroll to success message
                    successDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    // Show error
                    errorDiv.textContent = result.message || 'Une erreur est survenue. Veuillez réessayer.';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                errorDiv.textContent = 'Une erreur est survenue. Veuillez vérifier votre connexion et réessayer.';
                errorDiv.classList.remove('hidden');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitText.textContent = 'Envoyer ma demande';
                submitIcon.classList.remove('hidden');
                submitLoading.classList.add('hidden');
            }
        });
    </script>

    <!-- Leaflet JS (OpenStreetMap) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Coordonnées Travel Express Ouagadougou (8GX6+C57, rue 30.200, Sanyiri)
            const lat = 12.348568;
            const lng = -1.4896206;

            // Initialisation de la carte
            const map = L.map('map-travel-express', {
                scrollWheelZoom: false
            }).setView([lat, lng], 16);

            // Tuiles OpenStreetMap avec style clair
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Icône personnalisée pour le marqueur
            const customIcon = L.divIcon({
                className: 'custom-marker',
                html: `
                    <div style="position: relative;">
                        <div style="background: linear-gradient(135deg, #0071e3, #0077ED); width: 50px; height: 50px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,113,227,0.4);">
                            <svg style="transform: rotate(45deg); width: 24px; height: 24px; color: white;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 10px; height: 10px; background: #0071e3; border-radius: 50%; animation: pulse 2s infinite;"></div>
                    </div>
                `,
                iconSize: [50, 60],
                iconAnchor: [25, 60],
                popupAnchor: [0, -55]
            });

            // Ajout du marqueur
            const marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);

            // Contenu du popup
            const popupContent = `
                <div style="padding: 16px; font-family: 'Poppins', sans-serif;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #0071e3, #0077ED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 700; font-size: 16px; color: #1e293b; margin: 0;">Travel Express</h3>
                            <p style="font-size: 12px; color: #64748b; margin: 2px 0 0 0; line-height: 1.4;">8GX6+C57, Rue 30.200, Sanyiri<br>Ouagadougou, Burkina Faso</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&travelmode=driving"
                           target="_blank"
                           style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 10px 16px; background: linear-gradient(135deg, #0071e3, #0077ED); color: white; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600; transition: all 0.2s;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Itinéraire
                        </a>
                        <a href="https://wa.me/22665604592"
                           target="_blank"
                           style="display: flex; align-items: center; justify-content: center; padding: 10px 14px; background: #25D366; color: white; border-radius: 10px; text-decoration: none; transition: all 0.2s;">
                            <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            `;

            // Bind popup au marqueur
            marker.bindPopup(popupContent, {
                maxWidth: 300,
                className: 'custom-popup'
            });

            // Ouvrir le popup par défaut
            marker.openPopup();

            // Activer le scroll zoom au clic sur la carte
            map.on('click', function() {
                map.scrollWheelZoom.enable();
            });

            // Style pour l'animation pulse
            const style = document.createElement('style');
            style.textContent = `
                @keyframes pulse {
                    0%, 100% { transform: translateX(-50%) scale(1); opacity: 1; }
                    50% { transform: translateX(-50%) scale(1.5); opacity: 0.5; }
                }
            `;
            document.head.appendChild(style);
        });
    </script>

    <!-- Scroll Reveal Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Intersection Observer for scroll reveal animations
            // Animations repeat every time element enters viewport
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.15
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add revealed class when entering viewport
                        entry.target.classList.add('revealed');
                    } else {
                        // Remove revealed class when leaving viewport for repeat animation
                        entry.target.classList.remove('revealed');
                    }
                });
            }, observerOptions);

            // Observe all scroll-reveal elements
            const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale, .scroll-reveal-fade, .scroll-reveal-stagger');
            revealElements.forEach(el => {
                revealObserver.observe(el);
            });

            // Add scroll-reveal classes to sections dynamically
            const sections = document.querySelectorAll('section[id]');
            sections.forEach((section, index) => {
                // Add reveal class to section headers
                const header = section.querySelector('.text-center.mb-12, .text-center.mb-16, .text-center.mb-8');
                if (header && !header.classList.contains('scroll-reveal')) {
                    header.classList.add('scroll-reveal');
                    revealObserver.observe(header);
                }

                // Add stagger animation to grids (only if not already added)
                const grids = section.querySelectorAll('.grid');
                grids.forEach(grid => {
                    if (!grid.classList.contains('scroll-reveal-stagger')) {
                        grid.classList.add('scroll-reveal-stagger');
                        revealObserver.observe(grid);
                    }
                });
            });

            // Smooth scroll behavior enhancement
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const target = document.querySelector(targetId);
                    if (target) {
                        const headerHeight = 100;
                        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

    <!-- Scroll to Top Button -->
    <button id="scroll-to-top"
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-2xl shadow-lg shadow-primary-500/30 flex items-center justify-center opacity-0 invisible translate-y-4 transition-all duration-300 hover:from-primary-600 hover:to-primary-700 hover:shadow-xl hover:shadow-primary-500/40 hover:-translate-y-1 hover:scale-105 group">
        <!-- Arrow Icon -->
        <svg class="w-6 h-6 transition-transform duration-300 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
        <!-- Pulse Ring -->
        <span class="absolute inset-0 rounded-2xl bg-primary-400 animate-ping opacity-20"></span>
        <!-- Glow Effect -->
        <span class="absolute inset-0 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 blur-lg opacity-0 group-hover:opacity-40 transition-opacity duration-300"></span>
    </button>

    <script>
        // Scroll to Top Button Visibility
        (function() {
            const scrollBtn = document.getElementById('scroll-to-top');
            let lastScrollY = 0;
            let ticking = false;

            function updateButton() {
                const scrollY = window.scrollY;

                if (scrollY > 400) {
                    scrollBtn.classList.remove('opacity-0', 'invisible', 'translate-y-4');
                    scrollBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
                } else {
                    scrollBtn.classList.add('opacity-0', 'invisible', 'translate-y-4');
                    scrollBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
                }

                ticking = false;
            }

            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(updateButton);
                    ticking = true;
                }
            });
        })();
    </script>
</body>
</html>

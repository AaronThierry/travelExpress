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

    <style>
        .font-display { font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif; }
        .font-sans { font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; }
    </style>
</head>
<body class="font-sans text-dark antialiased bg-white overflow-x-hidden w-full max-w-none m-0 p-0" x-data="{
    mobileMenuOpen: false,
    activeCountry: 'china',
    testimonialModalOpen: false,
    faqs: [
        { id: 1, open: false, question: 'Quels types de projets accompagnez-vous ?', answer: 'Nous accompagnons trois types de projets : les études (universités, formations professionnelles), le travail (recherche d\'emploi, contrats de travail) et les affaires (import-export, création d\'entreprise, partenariats commerciaux) en Chine, Espagne et Allemagne.' },
        { id: 2, open: false, question: 'Combien de temps prend le processus complet ?', answer: 'Le délai varie selon votre projet. Pour les études : 3 à 6 mois. Pour un contrat de travail : 2 à 4 mois. Pour un projet business : 1 à 3 mois selon la complexité. Nous recommandons de nous contacter le plus tôt possible.' },
        { id: 3, open: false, question: 'Dois-je parler la langue du pays de destination ?', answer: 'Pas nécessairement. Pour les études, de nombreux programmes sont en anglais. Pour le travail et le business, cela dépend du secteur. Nous pouvons vous orienter vers des formations linguistiques adaptées.' },
        { id: 4, open: false, question: 'Quel est le coût de vos services ?', answer: 'Nos tarifs sont adaptés à chaque projet. Nous proposons différentes formules selon vos besoins : accompagnement études, accompagnement professionnel, accompagnement business. Contactez-nous pour un devis personnalisé gratuit.' },
        { id: 5, open: false, question: 'Aidez-vous pour le logement et l\'installation ?', answer: 'Oui ! Notre accompagnement inclut la recherche de logement, l\'accueil à l\'aéroport, les démarches administratives et toute l\'aide nécessaire pour votre installation réussie dans votre pays de destination.' },
        { id: 6, open: false, question: 'Proposez-vous un accompagnement pour le business en Chine ?', answer: 'Absolument ! Nous accompagnons les entrepreneurs dans leurs projets d\'import-export, la recherche de fournisseurs, la création de partenariats commerciaux et l\'installation d\'activités en Chine. Notre réseau local facilite vos démarches.' }
    ]
}">

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
                        <a href="tel:+221771234567" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="font-medium">+221 77 123 45 67</span>
                        </a>
                        <a href="mailto:contact@travelexpress.com" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">contact@travelexpress.com</span>
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

        <!-- Main Navigation - Single Line Layout -->
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between h-[70px] sm:h-[80px]">
                <!-- Logo - Compact & Modern -->
                <a href="#" class="flex items-center space-x-3 group relative flex-shrink-0">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-accent-500 to-accent-600 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                        <div class="relative w-12 h-12 bg-gradient-to-br from-primary-600 via-primary-700 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-lg shadow-primary-600/20">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-display font-extrabold text-dark leading-none group-hover:text-primary-600 transition-colors duration-300">Travel Express</span>
                        <span class="text-[9px] font-sans font-bold text-primary-600 tracking-widest uppercase leading-none mt-0.5 opacity-80">Study Abroad</span>
                    </div>
                </a>

                <!-- Center Navigation + Actions (All in One Line) -->
                <div class="hidden xl:flex items-center justify-end flex-1 space-x-2">
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

                    <a href="tel:+221771234567" class="flex items-center space-x-1.5 px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-all duration-300 group shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 group-hover:rotate-12 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Appeler</span>
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
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2.5 text-dark hover:bg-gray-100 rounded-xl transition-colors">
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
                <div class="pt-4 space-y-3">
                    <!-- Login button (if not logged in) -->
                    <template x-if="!mobileUser">
                        <a href="/login" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-5 py-3 border-2 border-primary-600 text-primary-600 font-semibold rounded-xl hover:bg-primary-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Connexion</span>
                        </a>
                    </template>

                    <a href="tel:+221771234567" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-5 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-all shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Appeler</span>
                    </a>

                    <a href="#contact" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-5 py-3 bg-gradient-to-r from-accent-600 to-accent-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                        <span>Postuler</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="relative z-20 w-full px-6 lg:px-12 xl:px-16 2xl:px-24 py-12">
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
            <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
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

        <div class="relative w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <!-- Section Header -->
            <div class="text-center mb-12 fade-in-up">
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
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
            <div class="text-center mb-16">
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

    <!-- Process Section -->
    <section id="processus" class="py-16 bg-white">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-10 fade-in-up">
                <h2 class="text-2xl md:text-3xl font-display font-bold text-dark mb-3 tracking-apple-tight">
                    Notre accompagnement en 4 étapes
                </h2>
                <p class="text-base text-gray">
                    Un processus clair et personnalisé pour concrétiser votre projet
                </p>
            </div>

            <div class="relative">
                <!-- Timeline Line - Rainbow gradient -->
                <div class="hidden md:block absolute top-24 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 via-purple-500 via-orange-500 to-green-500"></div>

                <div class="grid md:grid-cols-4 gap-8 relative z-10">
                    <!-- Step 1 - Blue -->
                    <div class="text-center fade-in-up stagger-1">
                        <div class="relative inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full mb-6 shadow-xl shadow-blue-500/50 mx-auto hover:scale-110 transition-transform duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <div class="absolute -top-3 -right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-2xl font-bold text-blue-600">1</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Consultation initiale</h3>
                        <p class="text-gray leading-apple">
                            Analyse de votre projet (études, travail ou business) et définition de vos objectifs.
                        </p>
                    </div>

                    <!-- Step 2 - Purple -->
                    <div class="text-center fade-in-up stagger-2">
                        <div class="relative inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full mb-6 shadow-xl shadow-purple-500/50 mx-auto hover:scale-110 transition-transform duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div class="absolute -top-3 -right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-2xl font-bold text-purple-600">2</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Préparation du dossier</h3>
                        <p class="text-gray leading-apple">
                            Constitution et optimisation de votre dossier selon votre projet : admission, contrat ou création d'entreprise.
                        </p>
                    </div>

                    <!-- Step 3 - Orange -->
                    <div class="text-center fade-in-up stagger-3">
                        <div class="relative inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mb-6 shadow-xl shadow-orange-500/50 mx-auto hover:scale-110 transition-transform duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <div class="absolute -top-3 -right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-2xl font-bold text-orange-600">3</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Démarches & Validation</h3>
                        <p class="text-gray leading-apple">
                            Suivi de vos candidatures, démarches administratives et obtention des validations nécessaires.
                        </p>
                    </div>

                    <!-- Step 4 - Green -->
                    <div class="text-center fade-in-up stagger-4">
                        <div class="relative inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-full mb-6 shadow-xl shadow-green-500/50 mx-auto hover:scale-110 transition-transform duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7"></path>
                            </svg>
                            <div class="absolute -top-3 -right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-2xl font-bold text-green-600">4</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Visa & Installation</h3>
                        <p class="text-gray leading-apple">
                            Accompagnement visa, logement et préparation à votre nouvelle vie à l'étranger.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-16">
                <a href="#contact" class="btn-primary inline-block">
                    Commencer maintenant
                    <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Section: Ils nous ont fait confiance - Carrousel Animé -->
    <section id="temoignages" class="py-16 bg-gradient-to-b from-slate-50 to-white overflow-hidden"
             x-data="{
                scrollContainer: null,
                scrollAmount: 420,
                testimonials: [],
                loading: true,
                colors: [
                    'from-red-500 to-red-600',
                    'from-gray-700 to-gray-900',
                    'from-orange-500 to-red-500',
                    'from-emerald-500 to-teal-600',
                    'from-blue-500 to-blue-600',
                    'from-purple-500 to-purple-600',
                    'from-pink-500 to-pink-600'
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
                init() {
                    this.scrollContainer = this.$refs.testimonialScroll;
                    this.loadTestimonials();
                },
                async loadTestimonials() {
                    try {
                        const response = await fetch('/api/testimonials?status=approved');
                        const data = await response.json();
                        if (data.data) {
                            this.testimonials = data.data;
                        }
                    } catch (e) {
                        console.error('Erreur chargement témoignages:', e);
                    } finally {
                        this.loading = false;
                    }
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
                getCountryName(code) {
                    return this.countryNames[code] || code || '';
                },
                scrollLeft() {
                    if (this.scrollContainer) {
                        this.scrollContainer.scrollBy({ left: -this.scrollAmount, behavior: 'smooth' });
                    }
                },
                scrollRight() {
                    if (this.scrollContainer) {
                        this.scrollContainer.scrollBy({ left: this.scrollAmount, behavior: 'smooth' });
                    }
                }
             }">
        <!-- CSS pour l'animation du carrousel -->
        <style>
            .testimonial-scroll {
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            .testimonial-scroll::-webkit-scrollbar {
                display: none;
            }
            .testimonial-card {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .testimonial-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            }
            .quote-icon {
                opacity: 0.1;
                transition: opacity 0.3s;
            }
            .testimonial-card:hover .quote-icon {
                opacity: 0.2;
            }
            .nav-arrow {
                transition: all 0.3s ease;
            }
            .nav-arrow:hover {
                transform: scale(1.1);
            }
            .nav-arrow:active {
                transform: scale(0.95);
            }
        </style>

        <div class="w-full">
            <!-- Header -->
            <div class="text-center mb-16 px-6 lg:px-12">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 rounded-full mb-6">
                    <span class="w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                    <span class="text-primary-700 text-sm font-semibold">+500 Étudiants Accompagnés</span>
                </div>
                <h2 class="text-xl md:text-2xl font-display font-bold text-slate-900 mb-4">
                    Ils nous ont fait <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-500">confiance</span>
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Découvrez les parcours inspirants de nos étudiants qui ont réalisé leurs rêves d'études à l'étranger
                </p>
            </div>

            <!-- Stats rapides -->
            <div class="flex flex-wrap justify-center gap-6 md:gap-10 mb-10 px-6">
                <div class="text-center">
                    <div class="text-xl md:text-2xl font-display font-bold text-primary-600">98%</div>
                    <div class="text-slate-500 text-sm font-medium mt-1">Taux de satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-xl md:text-2xl font-display font-bold text-accent-500">4.9<span class="text-2xl">/5</span></div>
                    <div class="text-slate-500 text-sm font-medium mt-1">Note moyenne</div>
                </div>
                <div class="text-center">
                    <div class="text-xl md:text-2xl font-display font-bold text-emerald-500">50+</div>
                    <div class="text-slate-500 text-sm font-medium mt-1">Universités partenaires</div>
                </div>
            </div>

            <!-- Carrousel avec flèches de navigation -->
            <div class="relative">
                <!-- Flèche gauche -->
                <button @click="scrollLeft()" class="nav-arrow absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center text-slate-600 hover:text-primary-600 hover:shadow-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Flèche droite -->
                <button @click="scrollRight()" class="nav-arrow absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center text-slate-600 hover:text-primary-600 hover:shadow-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Gradient fade gauche -->
                <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
                <!-- Gradient fade droite -->
                <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

                <div x-ref="testimonialScroll" class="testimonial-scroll flex gap-4 overflow-x-auto px-12 py-3">
                    <!-- Loading state -->
                    <template x-if="loading">
                        <div class="flex gap-4">
                            <template x-for="i in 4" :key="i">
                                <div class="w-[320px] flex-shrink-0 bg-white rounded-xl p-4 shadow-md border border-slate-100 animate-pulse">
                                    <div class="flex items-start gap-3 mb-3">
                                        <div class="w-11 h-11 bg-slate-200 rounded-lg"></div>
                                        <div class="flex-1">
                                            <div class="h-3 bg-slate-200 rounded w-24 mb-2"></div>
                                            <div class="h-2 bg-slate-200 rounded w-32"></div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-2 bg-slate-200 rounded w-full"></div>
                                        <div class="h-2 bg-slate-200 rounded w-full"></div>
                                        <div class="h-2 bg-slate-200 rounded w-3/4"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Témoignages dynamiques -->
                    <template x-for="(testimonial, index) in testimonials" :key="testimonial.id">
                        <div class="testimonial-card w-[320px] flex-shrink-0 bg-white rounded-xl p-4 shadow-md border border-slate-100 relative overflow-hidden">
                            <svg class="quote-icon absolute top-3 right-3 w-8 h-8 text-primary-600/50" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                            <div class="flex items-start gap-4 mb-4">
                                <div class="relative">
                                    <!-- Photo de profil ou initiales -->
                                    <template x-if="testimonial.user && testimonial.user.profile_photo">
                                        <img :src="'/storage/' + testimonial.user.profile_photo"
                                             :alt="testimonial.name"
                                             class="w-11 h-11 rounded-lg object-cover shadow">
                                    </template>
                                    <template x-if="!testimonial.user || !testimonial.user.profile_photo">
                                        <div class="w-11 h-11 bg-gradient-to-br rounded-lg flex items-center justify-center text-white text-sm font-bold shadow"
                                             :class="getColor(index)">
                                            <span x-text="getInitials(testimonial.name)"></span>
                                        </div>
                                    </template>
                                    <!-- Drapeau destination -->
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                        <span class="text-xs" x-text="getFlag(testimonial.destination)"></span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-display font-bold text-slate-900" x-text="testimonial.name"></h4>
                                        <!-- Drapeau pays d'origine -->
                                        <span class="text-base" x-text="getFlag(testimonial.country)"></span>
                                    </div>
                                    <p class="text-sm text-slate-500" x-text="testimonial.program || getCountryName(testimonial.country)"></p>
                                    <div class="flex gap-0.5 mt-1">
                                        <template x-for="star in testimonial.rating" :key="star">
                                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 leading-relaxed text-sm" x-text="'&quot;' + testimonial.content + '&quot;'"></p>
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-xs text-slate-400" x-text="new Date(testimonial.created_at).toLocaleDateString('fr-FR', {year: 'numeric', month: 'short'})"></span>
                                <span class="px-2 py-1 bg-primary-100 text-primary-700 text-xs font-semibold rounded-full flex items-center gap-1">
                                    <span x-text="getFlag(testimonial.destination)"></span>
                                    <span x-text="getCountryName(testimonial.destination)"></span>
                                </span>
                            </div>
                        </div>
                    </template>

                    <!-- Message si aucun témoignage -->
                    <template x-if="!loading && testimonials.length === 0">
                        <div class="w-full text-center py-12">
                            <p class="text-slate-500">Aucun témoignage pour le moment. Soyez le premier à partager votre expérience !</p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-16 px-6">
                <p class="text-slate-500 mb-6">Vous aussi, partagez votre expérience avec nous</p>
                <button @click="testimonialModalOpen = true" class="inline-flex items-center gap-3 px-5 py-2.5 bg-gradient-to-r from-primary-600 to-accent-500 text-white font-semibold rounded-lg text-sm shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Laisser un témoignage</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-white">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-10 fade-in-up">
                <h2 class="text-2xl md:text-3xl font-display font-bold text-dark mb-3 tracking-apple-tight">
                    Questions fréquentes
                </h2>
                <p class="text-base text-gray">
                    Tout ce que vous devez savoir sur nos services et les études à l'étranger
                </p>
            </div>

            <div class=" space-y-4">
                <template x-for="faq in faqs" :key="faq.id">
                    <div class="card overflow-hidden">
                        <button @click="faq.open = !faq.open"
                                class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors">
                            <span class="font-display font-bold text-dark text-lg pr-8" x-text="faq.question"></span>
                            <svg class="w-6 h-6 text-primary-600 flex-shrink-0 transform transition-transform duration-300"
                                 :class="{ 'rotate-180': faq.open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="faq.open"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="px-6 pb-6 text-gray leading-apple"
                             x-text="faq.answer">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Contact/Application Form Section -->
    <section id="contact" class="py-16 bg-gradient-to-br from-gray-light via-white to-primary-50">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-10 fade-in-up">
                <h2 class="text-2xl md:text-3xl font-display font-bold text-dark mb-3 tracking-apple-tight">
                    Concrétisez votre projet international
                </h2>
                <p class="text-base text-gray">
                    Études, travail ou business ? Parlez-nous de votre projet et recevez un accompagnement personnalisé
                </p>
            </div>

            <div class="card p-5 md:p-8">
                <!-- Success Message -->
                <div id="contact-success" class="hidden bg-green-50 border border-green-200 rounded-xl p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-green-800 mb-2">Demande envoyée avec succès!</h3>
                    <p class="text-green-700">Merci pour votre demande. Notre équipe vous contactera très bientôt via WhatsApp ou email.</p>
                </div>

                <!-- Contact Form -->
                <form id="contact-form" class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact-name" class="block text-xs font-medium text-dark mb-1">Nom complet *</label>
                            <input type="text" id="contact-name" name="name" required
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label for="contact-email" class="block text-xs font-medium text-dark mb-1">Email *</label>
                            <input type="email" id="contact-email" name="email" required
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact-phone" class="block text-xs font-medium text-dark mb-1">Téléphone / WhatsApp *</label>
                            <div class="flex gap-2">
                                <select id="contact-phone-code" name="phone_code" required
                                        class="w-28 px-2 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                                    <option value="+221">🇸🇳 +221</option>
                                    <option value="+237">🇨🇲 +237</option>
                                    <option value="+225">🇨🇮 +225</option>
                                    <option value="+223">🇲🇱 +223</option>
                                    <option value="+224">🇬🇳 +224</option>
                                    <option value="+229">🇧🇯 +229</option>
                                    <option value="+228">🇹🇬 +228</option>
                                    <option value="+226">🇧🇫 +226</option>
                                    <option value="+227">🇳🇪 +227</option>
                                    <option value="+242">🇨🇬 +242</option>
                                    <option value="+243">🇨🇩 +243</option>
                                    <option value="+241">🇬🇦 +241</option>
                                    <option value="+212">🇲🇦 +212</option>
                                    <option value="+213">🇩🇿 +213</option>
                                    <option value="+216">🇹🇳 +216</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+32">🇧🇪 +32</option>
                                    <option value="+41">🇨🇭 +41</option>
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="+86">🇨🇳 +86</option>
                                    <option value="+34">🇪🇸 +34</option>
                                    <option value="+49">🇩🇪 +49</option>
                                </select>
                                <input type="tel" id="contact-phone" name="phone" required placeholder="77 123 45 67"
                                       class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                            </div>
                        </div>
                        <div>
                            <label for="contact-country" class="block text-xs font-medium text-dark mb-1">Pays de résidence</label>
                            <input type="text" id="contact-country" name="country"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact-destination" class="block text-xs font-medium text-dark mb-1">Destination souhaitée *</label>
                            <select id="contact-destination" name="destination" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                                <option value="">Sélectionnez...</option>
                                <option value="china">🇨🇳 Chine</option>
                                <option value="spain">🇪🇸 Espagne</option>
                                <option value="germany">🇩🇪 Allemagne</option>
                                <option value="other">Autre / Je ne sais pas encore</option>
                            </select>
                        </div>
                        <div>
                            <label for="contact-project-type" class="block text-xs font-medium text-dark mb-1">Type de projet *</label>
                            <select id="contact-project-type" name="project_type" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                                <option value="">Sélectionnez...</option>
                                <option value="etudes">Études (Université, Formation)</option>
                                <option value="travail">Travail (Emploi, Contrat)</option>
                                <option value="business">Business (Import-Export, Partenariat)</option>
                                <option value="autre">Autre / Plusieurs projets</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="contact-details" class="block text-xs font-medium text-dark mb-1">Précisez votre projet *</label>
                        <input type="text" id="contact-details" name="project_details" required
                               placeholder="Ex: Master en informatique, Recherche d'emploi en ingénierie, Import de produits électroniques..."
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="contact-message" class="block text-xs font-medium text-dark mb-1">Parlez-nous de votre projet</label>
                        <textarea id="contact-message" name="message" rows="5"
                                  placeholder="Décrivez brièvement votre parcours, vos objectifs et vos motivations..."
                                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all"></textarea>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="contact-consent" name="consent" required
                               class="mt-1 w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-600">
                        <label for="contact-consent" class="ml-3 text-sm text-gray">
                            J'accepte que mes informations soient utilisées pour me contacter concernant mon projet. *
                        </label>
                    </div>

                    <!-- Error Message -->
                    <div id="contact-error" class="hidden bg-red-50 border border-red-200 rounded-lg p-3 text-red-700 text-sm"></div>

                    <button type="submit" id="contact-submit" class="btn-primary w-full text-center text-sm">
                        <span id="submit-text">Envoyer ma demande</span>
                        <svg id="submit-icon" class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        <svg id="submit-loading" class="hidden animate-spin inline-block w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <p class="text-center text-sm text-gray">
                        Réponse sous 24 heures • Consultation personnalisée gratuite
                    </p>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="grid md:grid-cols-3 gap-6 mt-10 ">
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-dark mb-2">Email</h4>
                    <p class="text-gray">contact@travelexpress.com</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-dark mb-2">Téléphone</h4>
                    <p class="text-gray">+221 77 123 45 67</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-dark mb-2">Adresse</h4>
                    <p class="text-gray">Dakar, Sénégal</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-display font-bold">Travel Express</span>
                    </div>
                    <p class="text-gray-400 leading-apple mb-4">
                        Votre partenaire de confiance pour réaliser vos rêves d'études à l'étranger.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-display font-bold text-lg mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">Nos programmes</a></li>
                        <li><a href="#pourquoi" class="text-gray-400 hover:text-white transition-colors">Pourquoi nous</a></li>
                        <li><a href="#processus" class="text-gray-400 hover:text-white transition-colors">Notre processus</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Destinations -->
                <div>
                    <h4 class="font-display font-bold text-lg mb-4">Destinations</h4>
                    <ul class="space-y-2">
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">🇨🇳 Chine</a></li>
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">🇪🇸 Espagne</a></li>
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">🇩🇪 Allemagne</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Nos universités partenaires</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Opportunités business</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Success stories</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="font-display font-bold text-lg mb-4">Ressources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Guide visa</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Guide études à l'étranger</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Guide import-export</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Télécharger la brochure</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Devenir partenaire</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    © 2025 Travel Express. Tous droits réservés.
                </p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Conditions d'utilisation</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Politique de confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Mentions légales</a>
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
             class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">

            <!-- Header du modal -->
            <div class="bg-gradient-to-r from-primary-600 to-accent-500 px-6 py-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Partagez votre expérience</h3>
                    <button @click="testimonialModalOpen = false" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-white/80 text-sm mt-1">Votre témoignage aidera d'autres étudiants à se lancer</p>
            </div>

            <!-- Formulaire -->
            <form x-data="{
                name: '',
                country: '',
                destination: '',
                message: '',
                rating: 5,
                submitting: false,
                success: false,
                error: '',
                async submitTestimonial() {
                    this.submitting = true;
                    this.error = '';

                    try {
                        const token = localStorage.getItem('auth_token');
                        const response = await fetch('/api/testimonials', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': token ? 'Bearer ' + token : ''
                            },
                            body: JSON.stringify({
                                name: this.name,
                                country: this.country,
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
                                this.name = '';
                                this.country = '';
                                this.destination = '';
                                this.message = '';
                                this.rating = 5;
                            }, 2000);
                        } else {
                            this.error = data.message || 'Une erreur est survenue';
                        }
                    } catch (e) {
                        this.error = 'Erreur de connexion. Veuillez réessayer.';
                    } finally {
                        this.submitting = false;
                    }
                }
            }" @submit.prevent="submitTestimonial" class="p-6 space-y-5">

                <!-- Message de succès -->
                <div x-show="success" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Merci ! Votre témoignage a été envoyé avec succès.</span>
                </div>

                <!-- Message d'erreur -->
                <div x-show="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-text="error"></span>
                </div>

                <template x-if="!success">
                    <div class="space-y-5">
                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Votre nom</label>
                            <input type="text" x-model="name" required
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                   placeholder="Ex: Fatou Diallo">
                        </div>

                        <!-- Pays d'origine -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Votre pays d'origine</label>
                            <select x-model="country" required
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                                <option value="">Sélectionnez votre pays</option>
                                <option value="SN">Sénégal</option>
                                <option value="CI">Côte d'Ivoire</option>
                                <option value="ML">Mali</option>
                                <option value="CM">Cameroun</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="GN">Guinée</option>
                                <option value="TG">Togo</option>
                                <option value="BJ">Bénin</option>
                                <option value="NE">Niger</option>
                                <option value="GA">Gabon</option>
                                <option value="CG">Congo</option>
                                <option value="CD">RD Congo</option>
                                <option value="MA">Maroc</option>
                                <option value="TN">Tunisie</option>
                                <option value="DZ">Algérie</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>

                        <!-- Destination -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pays de destination</label>
                            <select x-model="destination" required
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                                <option value="">Sélectionnez la destination</option>
                                <option value="CN">Chine</option>
                                <option value="ES">Espagne</option>
                                <option value="DE">Allemagne</option>
                            </select>
                        </div>

                        <!-- Note -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Votre note</label>
                            <div class="flex items-center gap-2">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click="rating = star" class="focus:outline-none transition-transform hover:scale-110">
                                        <svg class="w-8 h-8" :class="star <= rating ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                                <span class="ml-2 text-gray-500 text-sm" x-text="rating + '/5'"></span>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Votre témoignage</label>
                            <textarea x-model="message" required rows="4"
                                      class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                                      placeholder="Partagez votre expérience avec Travel Express..."></textarea>
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="testimonialModalOpen = false"
                                    class="flex-1 px-4 py-2 border border-gray-200 text-gray-700 font-medium rounded-lg text-sm hover:bg-gray-50 transition-all">
                                Annuler
                            </button>
                            <button type="submit" :disabled="submitting"
                                    class="flex-1 px-4 py-2 bg-gradient-to-r from-primary-600 to-accent-500 text-white font-medium rounded-lg text-sm hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                                <svg x-show="submitting" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="submitting ? 'Envoi...' : 'Envoyer'"></span>
                            </button>
                        </div>
                    </div>
                </template>
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
                country: document.getElementById('contact-country').value || null,
                destination: document.getElementById('contact-destination').value,
                project_type: document.getElementById('contact-project-type').value,
                project_details: document.getElementById('contact-details').value,
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
</body>
</html>

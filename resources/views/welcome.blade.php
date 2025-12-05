<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Travel Express - Votre partenaire de confiance pour vos études à l'étranger en Chine, Espagne et Allemagne. Bourses, admissions, visas.">
    <title>Travel Express - Études à l'Étranger | Chine, Espagne, Allemagne</title>

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
<body class="font-sans text-dark antialiased bg-white overflow-x-hidden" x-data="{
    mobileMenuOpen: false,
    activeCountry: 'china',
    faqs: [
        { id: 1, open: false, question: 'Quelles sont les conditions pour obtenir une bourse ?', answer: 'Les conditions varient selon le pays et le programme. En général, un bon dossier académique, une lettre de motivation solide et parfois un niveau de langue sont requis. Notre équipe vous accompagne dans la constitution d\'un dossier compétitif.' },
        { id: 2, open: false, question: 'Combien de temps prend le processus d\'admission ?', answer: 'Le processus complet prend généralement entre 3 et 6 mois, incluant la préparation du dossier, les candidatures, l\'obtention de l\'admission et le visa. Nous recommandons de commencer au moins 6 mois avant la rentrée souhaitée.' },
        { id: 3, open: false, question: 'Dois-je parler la langue du pays d\'accueil ?', answer: 'Pas nécessairement. De nombreux programmes sont dispensés en anglais. Pour les programmes en langue locale, des cours de préparation linguistique sont souvent disponibles avant ou pendant vos études.' },
        { id: 4, open: false, question: 'Quel est le coût de vos services ?', answer: 'Nos services sont personnalisés selon vos besoins. Nous proposons différentes formules d\'accompagnement. Contactez-nous pour un devis gratuit adapté à votre projet.' },
        { id: 5, open: false, question: 'Aidez-vous pour le logement et l\'installation ?', answer: 'Absolument ! Notre accompagnement inclut la recherche de logement, l\'accueil à l\'aéroport, l\'inscription administrative et toute l\'aide nécessaire pour votre installation dans votre pays d\'accueil.' },
        { id: 6, open: false, question: 'Puis-je travailler pendant mes études ?', answer: 'Cela dépend du pays et de votre visa étudiant. En Chine, Espagne et Allemagne, les étudiants internationaux peuvent généralement travailler à temps partiel. Nous vous informons sur les réglementations spécifiques.' }
    ]
}">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-2xl border-b border-black/[0.08] shadow-sm transition-all duration-300"
            x-data="{ scrolled: false }"
            @scroll.window="scrolled = window.pageYOffset > 20"
            :class="scrolled ? 'shadow-md' : ''">
        <!-- Top Info Bar -->
        <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white py-1.5 hidden lg:block">
            <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
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
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <nav class="flex items-center justify-between h-[80px]">
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
                                        <a href="/settings" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-colors group">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="font-medium">Paramètres</span>
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
             class="lg:hidden bg-white border-t border-black/[0.06] shadow-xl"
             @click.away="mobileMenuOpen = false">
            <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24 py-6 space-y-2">
                <a href="#programmes" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Programmes</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#pourquoi" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Pourquoi nous</span>
                    <svg class="w-4 h-4 text-gray group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <a href="#processus" @click="mobileMenuOpen = false" class="flex items-center justify-between py-3 px-4 text-dark hover:bg-primary-50 rounded-xl transition-all group">
                    <span class="font-medium">Notre processus</span>
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
                <div class="pt-4 space-y-3">
                    <a href="tel:+221771234567" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-5 py-3 bg-primary-50 text-primary-600 font-semibold rounded-xl hover:bg-primary-100 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Nous appeler</span>
                    </a>
                    <a href="#contact" @click="mobileMenuOpen = false" class="flex items-center justify-center space-x-2 w-full px-5 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                        <span>Déposer ma candidature</span>
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
        <div class="relative z-20 w-full px-6 lg:px-12 xl:px-16 2xl:px-24 py-12">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Text Content -->
                <div class="text-left space-y-8 fade-in-up">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2">
                        <div class="w-2 h-2 bg-accent-500 rounded-full animate-pulse"></div>
                        <span class="text-white/90 text-sm font-semibold">🎓 Votre avenir commence ici</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-6xl xl:text-7xl font-display font-black text-white leading-tight">
                        Transformez vos
                        <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-accent-400 via-accent-500 to-primary-400 animate-gradient">
                            rêves d'études
                        </span>
                        <span class="block mt-2">en réalité</span>
                    </h1>

                    <!-- Subheading -->
                    <p class="text-lg md:text-xl text-white/80 leading-relaxed max-w-xl">
                        Rejoignez <strong class="text-white font-bold">500+ étudiants africains</strong> qui ont décroché leurs bourses pour étudier en
                        <span class="text-accent-400 font-semibold">Chine</span>,
                        <span class="text-accent-400 font-semibold">Espagne</span> et
                        <span class="text-accent-400 font-semibold">Allemagne</span>.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#contact" class="group relative px-8 py-4 bg-gradient-to-r from-accent-600 to-accent-500 text-white text-base font-bold rounded-xl shadow-2xl hover:shadow-accent-600/50 transform hover:scale-105 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center space-x-2">
                                <span>Démarrer mon projet</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-accent-700 to-accent-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        <a href="#programmes" class="group px-8 py-4 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white text-base font-bold rounded-xl hover:bg-white/20 hover:border-white/50 transition-all duration-300">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Découvrir nos programmes</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
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
                            <span class="text-white/90 font-semibold">95% de réussite</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Stats Cards -->
                <div class="grid grid-cols-2 gap-4 lg:gap-6">
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/15 hover:scale-105 transition-all duration-300 group">
                        <div class="text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform">500+</div>
                        <div class="text-white/80 font-semibold">Étudiants<br/>accompagnés</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/15 hover:scale-105 transition-all duration-300 group">
                        <div class="text-5xl font-black text-accent-400 mb-2 group-hover:scale-110 transition-transform">50+</div>
                        <div class="text-white/80 font-semibold">Universités<br/>partenaires</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/15 hover:scale-105 transition-all duration-300 group">
                        <div class="text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform">95%</div>
                        <div class="text-white/80 font-semibold">Taux de<br/>réussite</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/15 hover:scale-105 transition-all duration-300 group">
                        <div class="text-5xl font-black text-accent-400 mb-2 group-hover:scale-110 transition-transform">100%</div>
                        <div class="text-white/80 font-semibold">Accompagnement<br/>personnalisé</div>
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
    <section id="pourquoi" class="relative py-32 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 -left-20 w-72 h-72 bg-primary-200/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 -right-20 w-96 h-96 bg-accent-200/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <!-- Section Header -->
            <div class="text-center mb-20 fade-in-up">
                <div class="inline-flex items-center space-x-2 bg-primary-100 px-4 py-2 rounded-full mb-6">
                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-primary-600 font-bold text-sm uppercase tracking-wider">Excellence & Confiance</span>
                </div>
                <h2 class="text-5xl md:text-6xl font-display font-black text-dark mb-6 tracking-apple-tight">
                    Pourquoi choisir <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-600">Travel Express</span> ?
                </h2>
                <p class="text-xl md:text-2xl text-gray max-w-3xl mx-auto leading-relaxed">
                    Une expertise reconnue et un accompagnement sur mesure pour garantir votre réussite
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Feature 1 - Enhanced -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 overflow-hidden card-3d">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-100 to-transparent rounded-bl-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-4 group-hover:text-primary-600 transition-colors">Expertise prouvée</h3>
                        <p class="text-gray leading-relaxed text-lg mb-4">
                            Plus de <strong class="text-primary-600">10 ans d'expérience</strong> et <strong class="text-primary-600">500+ étudiants</strong> accompagnés avec succès vers leurs destinations de rêve.
                        </p>
                        <div class="flex items-center text-primary-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="text-sm">En savoir plus</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 - Enhanced -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-accent-200 overflow-hidden card-3d">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-accent-100 to-transparent rounded-bl-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-accent-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-4 group-hover:text-accent-600 transition-colors">Bourses garanties</h3>
                        <p class="text-gray leading-relaxed text-lg mb-4">
                            Accès exclusif à des <strong class="text-accent-600">bourses complètes</strong> couvrant frais de scolarité, logement et allocation mensuelle.
                        </p>
                        <div class="flex items-center text-accent-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="text-sm">Découvrir les bourses</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 - Enhanced -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 overflow-hidden card-3d">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-100 to-transparent rounded-bl-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-4 group-hover:text-primary-600 transition-colors">Accompagnement 360°</h3>
                        <p class="text-gray leading-relaxed text-lg mb-4">
                            De la sélection du programme jusqu'à votre installation : nous sommes <strong class="text-primary-600">à vos côtés</strong> à chaque étape.
                        </p>
                        <div class="flex items-center text-primary-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="text-sm">Notre processus</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 - Enhanced -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-accent-200 overflow-hidden card-3d">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-accent-100 to-transparent rounded-bl-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-accent-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-4 group-hover:text-accent-600 transition-colors">Réseau mondial</h3>
                        <p class="text-gray leading-relaxed text-lg mb-4">
                            Partenariats avec <strong class="text-accent-600">50+ universités prestigieuses</strong> en Chine, Espagne et Allemagne.
                        </p>
                        <div class="flex items-center text-accent-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="text-sm">Voir les universités</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 - Enhanced -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 overflow-hidden card-3d">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-100 to-transparent rounded-bl-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-4 group-hover:text-primary-600 transition-colors">Processus rapide</h3>
                        <p class="text-gray leading-relaxed text-lg mb-4">
                            <strong class="text-primary-600">Délais optimisés</strong> pour vos admissions et visas. Commencez votre aventure plus rapidement.
                        </p>
                        <div class="flex items-center text-primary-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="text-sm">Nos délais</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 - Enhanced -->
                <div class="group relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-accent-200 overflow-hidden card-3d">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-accent-100 to-transparent rounded-bl-full opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-accent-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-dark mb-4 group-hover:text-accent-600 transition-colors">Suivi post-arrivée</h3>
                        <p class="text-gray leading-relaxed text-lg mb-4">
                            Notre <strong class="text-accent-600">assistance continue</strong> même après votre arrivée : logement, installation, intégration sociale.
                        </p>
                        <div class="flex items-center text-accent-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="text-sm">Nos services</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 text-center">
                <a href="#contact" class="inline-flex items-center space-x-3 px-10 py-5 bg-gradient-to-r from-primary-600 to-accent-600 text-white text-lg font-bold rounded-2xl shadow-2xl hover:shadow-accent-600/50 hover:scale-105 transition-all duration-300">
                    <span>Démarrer mon projet maintenant</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Destinations Section - Immersive Design -->
    <section id="programmes" class="relative py-24 bg-dark overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-5 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                    <span class="text-sm font-semibold text-white">🌍 Votre aventure commence ici</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-display font-bold text-white mb-6">
                    Choisissez votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400">destination</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Explorez nos destinations d'excellence et trouvez l'université parfaite pour réaliser vos ambitions
                </p>
            </div>

            <!-- Destination Cards - Full Width Immersive -->
            <div class="space-y-8">

                <!-- CHINA Card -->
                <div class="group relative rounded-3xl overflow-hidden cursor-pointer" @click="activeCountry = 'china'">
                    <!-- Background Image -->
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1508804185872-d7badad00f7d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                             alt="Chine - Shanghai skyline"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-900/90 via-red-800/70 to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 p-8 md:p-12 lg:p-16 min-h-[400px] flex flex-col justify-center">
                        <div class="max-w-2xl">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="text-5xl">🇨🇳</span>
                                <span class="px-4 py-1 bg-yellow-500 text-yellow-900 text-xs font-bold rounded-full uppercase tracking-wide">Destination #1</span>
                            </div>

                            <h3 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">
                                Chine
                            </h3>

                            <p class="text-lg text-white/80 mb-6 max-w-xl">
                                Plongez au cœur de la puissance économique mondiale. Étudiez dans des universités classées Top 100 mondial et vivez une expérience culturelle unique.
                            </p>

                            <!-- Key Points -->
                            <div class="flex flex-wrap gap-3 mb-8">
                                <span class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/20">
                                    🎯 Accompagnement personnalisé
                                </span>
                                <span class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/20">
                                    🎓 200+ programmes en anglais
                                </span>
                                <span class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/20">
                                    💼 Opportunités de bourses
                                </span>
                                <span class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/20">
                                    🏢 Accompagnement emploi
                                </span>
                            </div>

                            <!-- Universities Preview -->
                            <div class="flex items-center gap-4 mb-6">
                                <div class="flex -space-x-3">
                                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-lg border-2 border-white">
                                        <span class="text-xs font-bold text-red-600">THU</span>
                                    </div>
                                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-lg border-2 border-white">
                                        <span class="text-xs font-bold text-red-600">PKU</span>
                                    </div>
                                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-lg border-2 border-white">
                                        <span class="text-xs font-bold text-red-600">FDU</span>
                                    </div>
                                    <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center shadow-lg border-2 border-white">
                                        <span class="text-xs font-bold text-white">+50</span>
                                    </div>
                                </div>
                                <span class="text-white/70 text-sm">Universités partenaires</span>
                            </div>

                            <a href="#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-red-600 font-bold rounded-xl hover:bg-yellow-400 hover:text-red-700 transition-all duration-300 group-hover:translate-x-2">
                                Découvrir la Chine
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Stats Floating Cards -->
                    <div class="hidden lg:block absolute right-12 top-1/2 -translate-y-1/2 space-y-4">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-transform">
                            <div class="text-4xl font-display font-bold text-white mb-1">98%</div>
                            <div class="text-sm text-white/70">Taux d'admission</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-transform">
                            <div class="text-4xl font-display font-bold text-yellow-400 mb-1">A-Z</div>
                            <div class="text-sm text-white/70">Accompagnement complet</div>
                        </div>
                    </div>
                </div>

                <!-- Two Columns: Spain & Germany -->
                <div class="grid md:grid-cols-2 gap-8">

                    <!-- SPAIN Card - Modern Design -->
                    <div class="group relative rounded-3xl overflow-hidden cursor-pointer min-h-[550px] shadow-2xl" @click="activeCountry = 'spain'">
                        <!-- Background Image -->
                        <div class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1539037116277-4db20889f2d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                 alt="Espagne - Barcelone"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-orange-900/50 to-transparent"></div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="absolute top-6 right-6 z-20">
                            <div class="px-4 py-2 bg-gradient-to-r from-red-500 to-yellow-500 rounded-full shadow-lg">
                                <span class="text-white text-xs font-bold uppercase tracking-wider">Bourses disponibles</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="relative z-10 p-8 h-full flex flex-col justify-end">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl drop-shadow-lg">🇪🇸</span>
                                <div class="flex flex-col">
                                    <span class="text-yellow-400 text-xs font-bold uppercase tracking-widest">Europe</span>
                                    <h3 class="text-3xl md:text-4xl font-display font-bold text-white">Espagne</h3>
                                </div>
                            </div>

                            <p class="text-white/90 mb-6 text-lg leading-relaxed">
                                Vivez l'excellence européenne sous le soleil méditerranéen. Nous vous accompagnons de A à Z pour vos études et votre insertion professionnelle.
                            </p>

                            <!-- Modern Tags -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    🎯 Accompagnement études
                                </span>
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    💼 Aide à l'emploi
                                </span>
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    🏛️ Diplômes UE
                                </span>
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    🎨 Arts & Business
                                </span>
                            </div>

                            <!-- Stats Row -->
                            <div class="grid grid-cols-3 gap-3 mb-6 py-4 border-t border-white/10">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-yellow-400">30+</div>
                                    <div class="text-xs text-white/60">Universités</div>
                                </div>
                                <div class="text-center border-x border-white/10">
                                    <div class="text-2xl font-bold text-white">95%</div>
                                    <div class="text-xs text-white/60">Réussite</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-400">Job</div>
                                    <div class="text-xs text-white/60">Support</div>
                                </div>
                            </div>

                            <a href="#contact" class="inline-flex items-center justify-center gap-2 w-full px-6 py-4 bg-white text-gray-900 font-bold rounded-xl hover:bg-yellow-400 transition-all duration-300 group-hover:shadow-xl">
                                Démarrer mon projet
                                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- GERMANY Card - Modern Design -->
                    <div class="group relative rounded-3xl overflow-hidden cursor-pointer min-h-[550px] shadow-2xl" @click="activeCountry = 'germany'">
                        <!-- Background Image -->
                        <div class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                 alt="Allemagne - Berlin"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-gray-900/50 to-transparent"></div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="absolute top-6 right-6 z-20">
                            <div class="px-4 py-2 bg-gradient-to-r from-gray-800 to-yellow-500 rounded-full shadow-lg">
                                <span class="text-white text-xs font-bold uppercase tracking-wider">Bourses DAAD</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="relative z-10 p-8 h-full flex flex-col justify-end">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl drop-shadow-lg">🇩🇪</span>
                                <div class="flex flex-col">
                                    <span class="text-yellow-400 text-xs font-bold uppercase tracking-widest">Innovation</span>
                                    <h3 class="text-3xl md:text-4xl font-display font-bold text-white">Allemagne</h3>
                                </div>
                            </div>

                            <p class="text-white/90 mb-6 text-lg leading-relaxed">
                                Leader mondial de l'ingénierie et de l'innovation. Nous vous guidons vers les meilleures universités et opportunités de carrière.
                            </p>

                            <!-- Modern Tags -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    🎯 Accompagnement études
                                </span>
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    💼 Insertion professionnelle
                                </span>
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    ⚙️ Ingénierie & Tech
                                </span>
                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-medium border border-white/10">
                                    🚗 Automobile
                                </span>
                            </div>

                            <!-- Stats Row -->
                            <div class="grid grid-cols-3 gap-3 mb-6 py-4 border-t border-white/10">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-yellow-400">20+</div>
                                    <div class="text-xs text-white/60">Universités</div>
                                </div>
                                <div class="text-center border-x border-white/10">
                                    <div class="text-2xl font-bold text-white">97%</div>
                                    <div class="text-xs text-white/60">Réussite</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-400">Job</div>
                                    <div class="text-xs text-white/60">Support</div>
                                </div>
                            </div>

                            <a href="#contact" class="inline-flex items-center justify-center gap-2 w-full px-6 py-4 bg-white text-gray-900 font-bold rounded-xl hover:bg-yellow-400 transition-all duration-300 group-hover:shadow-xl">
                                Démarrer mon projet
                                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Stats -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div class="text-4xl md:text-5xl font-display font-bold text-white mb-2">500+</div>
                    <div class="text-gray-400">Étudiants accompagnés</div>
                </div>
                <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div class="text-4xl md:text-5xl font-display font-bold text-primary-400 mb-2">98%</div>
                    <div class="text-gray-400">Taux de réussite</div>
                </div>
                <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div class="text-4xl md:text-5xl font-display font-bold text-accent-400 mb-2">50+</div>
                    <div class="text-gray-400">Universités partenaires</div>
                </div>
                <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div class="text-4xl md:text-5xl font-display font-bold text-green-400 mb-2">24h</div>
                    <div class="text-gray-400">Réponse garantie</div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 text-center">
                <p class="text-gray-400 mb-6">Vous ne savez pas quelle destination choisir ?</p>
                <a href="#contact" class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-primary-500 to-accent-500 text-white text-lg font-bold rounded-2xl shadow-2xl hover:shadow-primary-500/25 hover:scale-105 transition-all duration-300">
                    <span>Consultation gratuite personnalisée</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </a>
                <p class="text-gray-500 text-sm mt-4">Accompagnement personnalisé pour chaque étudiant</p>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="processus" class="py-24 bg-white">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-dark mb-4 tracking-apple-tight">
                    Notre processus en 4 étapes
                </h2>
                <p class="text-xl text-gray ">
                    Un accompagnement structuré et transparent du début à la fin
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
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Consultation gratuite</h3>
                        <p class="text-gray leading-apple">
                            Évaluation de votre profil et définition de vos objectifs académiques et professionnels.
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
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Constitution du dossier</h3>
                        <p class="text-gray leading-apple">
                            Préparation complète de votre dossier : documents, lettres de motivation, recommandations.
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
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Admission</h3>
                        <p class="text-gray leading-apple">
                            Dépôt de vos candidatures dans les meilleures universités et suivi personnalisé jusqu'à votre admission.
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
                        <h3 class="text-2xl font-display font-bold text-dark mb-3">Visa & Départ</h3>
                        <p class="text-gray leading-apple">
                            Accompagnement pour le visa, logement, billets d'avion et préparation de votre départ.
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

    <!-- Testimonials Section -->
    <section id="temoignages" class="py-24 bg-gray-light">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-dark mb-4 tracking-apple-tight">
                    Ils nous font confiance
                </h2>
                <p class="text-xl text-gray ">
                    Découvrez les témoignages de nos étudiants qui réalisent leurs rêves à l'étranger
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="card p-8 fade-in-up stagger-1">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            AM
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-dark">Aminata Diallo</h4>
                            <p class="text-sm text-gray">Master en Informatique</p>
                            <p class="text-xs text-primary-600 font-semibold">🇨🇳 Université de Pékin</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray leading-apple">
                        "Travel Express m'a accompagnée du début à la fin. J'ai obtenu une bourse complète pour mon Master en IA à Pékin. Leur professionnalisme et leur disponibilité ont fait toute la différence."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="card p-8 fade-in-up stagger-2">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            MK
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-dark">Mohamed Konaté</h4>
                            <p class="text-sm text-gray">Licence en Ingénierie</p>
                            <p class="text-xs text-primary-600 font-semibold">🇩🇪 TU Munich</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray leading-apple">
                        "Grâce à Travel Express, j'étudie l'ingénierie automobile en Allemagne sans frais de scolarité. Leur réseau d'universités et leur expertise m'ont ouvert des portes incroyables."
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="card p-8 fade-in-up stagger-3">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            FS
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-dark">Fatou Sow</h4>
                            <p class="text-sm text-gray">MBA International</p>
                            <p class="text-xs text-primary-600 font-semibold">🇪🇸 ESADE Barcelona</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray leading-apple">
                        "L'accompagnement personnalisé de Travel Express m'a permis d'intégrer un MBA prestigieux à Barcelone. Ils m'ont aidée avec le visa, le logement et même l'adaptation culturelle."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 bg-white">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-dark mb-4 tracking-apple-tight">
                    Questions fréquentes
                </h2>
                <p class="text-xl text-gray ">
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
    <section id="contact" class="py-24 bg-gradient-to-br from-gray-light via-white to-primary-50">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-dark mb-4 tracking-apple-tight">
                    Démarrez votre aventure aujourd'hui
                </h2>
                <p class="text-xl text-gray ">
                    Remplissez ce formulaire et notre équipe vous contactera sous 24h pour une consultation gratuite
                </p>
            </div>

            <div class="card  p-8 md:p-12">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-dark mb-2">Nom complet *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-dark mb-2">Email *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-dark mb-2">Téléphone / WhatsApp *</label>
                            <input type="tel" id="phone" name="phone" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-semibold text-dark mb-2">Pays de résidence *</label>
                            <input type="text" id="country" name="country" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="destination" class="block text-sm font-semibold text-dark mb-2">Destination souhaitée *</label>
                            <select id="destination" name="destination" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                                <option value="">Sélectionnez...</option>
                                <option value="china">🇨🇳 Chine</option>
                                <option value="spain">🇪🇸 Espagne</option>
                                <option value="germany">🇩🇪 Allemagne</option>
                                <option value="other">Autre / Je ne sais pas encore</option>
                            </select>
                        </div>
                        <div>
                            <label for="level" class="block text-sm font-semibold text-dark mb-2">Niveau d'études souhaité *</label>
                            <select id="level" name="level" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                                <option value="">Sélectionnez...</option>
                                <option value="licence">Licence / Bachelor</option>
                                <option value="master">Master</option>
                                <option value="phd">Doctorat / PhD</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="field" class="block text-sm font-semibold text-dark mb-2">Domaine d'études *</label>
                        <input type="text" id="field" name="field" required
                               placeholder="Ex: Informatique, Médecine, Ingénierie..."
                               class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-dark mb-2">Parlez-nous de votre projet</label>
                        <textarea id="message" name="message" rows="5"
                                  placeholder="Décrivez brièvement votre parcours, vos objectifs et vos motivations..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-apple focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all"></textarea>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="consent" name="consent" required
                               class="mt-1 w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-600">
                        <label for="consent" class="ml-3 text-sm text-gray">
                            J'accepte que mes informations soient utilisées pour me contacter concernant ma candidature. *
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full text-center text-lg">
                        Envoyer ma candidature
                        <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>

                    <p class="text-center text-sm text-gray">
                        Réponse garantie sous 24 heures • Consultation gratuite
                    </p>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="grid md:grid-cols-3 gap-8 mt-16 ">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-dark mb-2">Email</h4>
                    <p class="text-gray">contact@travelexpress.com</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-dark mb-2">Téléphone</h4>
                    <p class="text-gray">+221 77 123 45 67</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <!-- Testimonials Section -->
    @include('components.testimonials')

    <!-- Footer -->
    <footer class="bg-dark text-white py-16">
        <div class="w-full px-6 lg:px-12 xl:px-16 2xl:px-24">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
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
                        <li><a href="#temoignages" class="text-gray-400 hover:text-white transition-colors">Témoignages</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Destinations -->
                <div>
                    <h4 class="font-display font-bold text-lg mb-4">Destinations</h4>
                    <ul class="space-y-2">
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">🇨🇳 Études en Chine</a></li>
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">🇪🇸 Études en Espagne</a></li>
                        <li><a href="#programmes" class="text-gray-400 hover:text-white transition-colors">🇩🇪 Études en Allemagne</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bourses d'études</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Nos universités</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Success stories</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="font-display font-bold text-lg mb-4">Ressources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Guide des bourses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Préparer son visa</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Vie étudiante</a></li>
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
        @keyframes blob {
            0%, 100% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>

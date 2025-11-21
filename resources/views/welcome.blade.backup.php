<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Express - Voyages, Bourses & Études</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-md shadow-lg z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 group">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-primary-900 leading-none">Travel <span class="text-accent-600">Express</span></h1>
                            <p class="text-xs text-gray-500 font-medium">Votre avenir commence ici</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#accueil" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-300 font-medium relative group">
                        Accueil
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#agence" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-300 font-medium relative group">
                        Programmes
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#destinations" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-300 font-medium relative group">
                        Destinations
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#services" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-300 font-medium relative group">
                        Services
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#contact" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-300 font-medium relative group">
                        Contact
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <div class="ml-4 flex items-center space-x-3">
                        <button class="px-5 py-2.5 text-primary-600 border-2 border-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300">
                            Connexion
                        </button>
                        <button class="btn-primary flex items-center space-x-2">
                            <span>Ma Bourse</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="p-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg focus:outline-none transition-all duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Slider Section -->
    <section id="accueil" class="pt-20 relative h-[600px] overflow-hidden slider-container">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/80 to-primary-600/60 z-10"></div>

        <!-- Slider Background -->
        <div class="slide absolute inset-0">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1920&h=800&fit=crop"
                 alt="Étudiants"
                 class="w-full h-full object-cover">
        </div>

        <!-- Hero Content -->
        <div class="relative z-20 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h2 class="text-5xl md:text-7xl font-bold mb-6 leading-tight animate-fade-in">
                    Transformez Vos Rêves<br>
                    <span class="text-accent-400">en Réalité Académique</span>
                </h2>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                    Depuis plus de 10 ans, Travel Express accompagne avec succès des centaines d'étudiants burkinabè vers les meilleures universités de <span class="text-accent-400 font-bold">Chine, d'Espagne</span> et du monde entier. Bourses complètes, assistance visa, et suivi personnalisé garantis.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="btn-primary text-lg px-8 py-4">Découvrir nos services</button>
                    <button class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-primary-900 transition-all duration-300">
                        En savoir plus
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Offres Académiques Section -->
    <section id="agence" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-primary-900 mb-4">Nos Programmes d'Excellence</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Que vous visiez une Licence, un Master ou un Doctorat, nous vous ouvrons les portes des meilleures institutions académiques internationales. Plus de 200 universités partenaires dans 35 pays.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Licence Card -->
                <div class="card p-8 group bg-white">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 mx-auto">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-center text-primary-900 mb-4">Licence</h3>
                    <p class="text-center text-accent-600 font-bold text-xl mb-4">BAC+3 | 3 ans</p>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Démarrez votre carrière avec un diplôme de Bachelor reconnu internationalement. Plus de 150 domaines d'études disponibles : Business, Ingénierie, Médecine, Sciences Sociales, Arts et bien plus encore.
                    </p>
                    <ul class="text-sm text-gray-600 mb-6 space-y-2">
                        <li class="flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Bourses jusqu'à 100%
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Admission garantie
                        </li>
                    </ul>
                    <div class="text-center">
                        <button class="btn-primary w-full">Découvrir</button>
                    </div>
                </div>

                <!-- Master Card -->
                <div class="card p-8 group bg-white border-2 border-accent-600">
                    <div class="w-20 h-20 bg-gradient-to-br from-accent-600 to-accent-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 mx-auto">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-center text-primary-900 mb-4">Master</h3>
                    <p class="text-center text-accent-600 font-bold text-xl mb-4">BAC+5 | 2 ans</p>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Devenez un expert dans votre domaine avec un Master d'excellence. MBA, MSc, MA - programmes enseignés en anglais ou français dans les universités les plus prestigieuses d'Europe, d'Amérique et d'Asie.
                    </p>
                    <ul class="text-sm text-gray-600 mb-6 space-y-2">
                        <li class="flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Bourses d'excellence
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Stage inclus
                        </li>
                    </ul>
                    <div class="text-center">
                        <button class="btn-primary w-full">Découvrir</button>
                    </div>
                </div>

                <!-- Doctorat Card -->
                <div class="card p-8 group bg-white">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 mx-auto">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-center text-primary-900 mb-4">Doctorat</h3>
                    <p class="text-center text-accent-600 font-bold text-xl mb-4">BAC+8 | 3-5 ans</p>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Rejoignez l'élite de la recherche mondiale avec un PhD. Financement complet, laboratoires d'excellence, supervision de professeurs renommés. Devenez un leader dans votre domaine de recherche.
                    </p>
                    <ul class="text-sm text-gray-600 mb-6 space-y-2">
                        <li class="flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Financement garanti
                        </li>
                        <li class="flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Recherche de pointe
                        </li>
                    </ul>
                    <div class="text-center">
                        <button class="btn-primary w-full">Découvrir</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-primary-900 mb-4">Pourquoi Plus de 1000 Étudiants Nous Font Confiance?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Travel Express n'est pas qu'une simple agence. Nous sommes votre partenaire de réussite, avec un taux de satisfaction de 98% et une présence dans toute l'Afrique de l'Ouest.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Voyages Card -->
                <div class="p-8 bg-gray-50 rounded-xl hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900 mb-4">Gestion Complète du Voyage</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        De A à Z, nous gérons tous les aspects logistiques de votre départ : réservation de billets d'avion aux meilleurs tarifs, assistance complète pour l'obtention du visa, recherche et réservation d'hébergement étudiant sécurisé.
                    </p>
                    <p class="text-sm text-accent-600 font-semibold">
                        ✈️ Partenariats avec 15+ compagnies aériennes
                    </p>
                </div>

                <!-- Bourses Card -->
                <div class="p-8 bg-accent-50 rounded-xl hover:shadow-xl transition-all duration-300 border-2 border-accent-600">
                    <div class="w-16 h-16 bg-gradient-to-br from-accent-600 to-accent-800 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900 mb-4">500+ Bourses d'Excellence</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Accédez à notre base de données exclusive de plus de 500 bourses actualisées quotidiennement. Bourses complètes (frais de scolarité + logement + allocation mensuelle), bourses partielles, bourses gouvernementales et privées. Taux de réussite : 85%.
                    </p>
                    <p class="text-sm text-accent-600 font-semibold">
                        💰 Bourses de 5,000€ à 50,000€/an disponibles
                    </p>
                </div>

                <!-- Accompagnement Card -->
                <div class="p-8 bg-gray-50 rounded-xl hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900 mb-4">Accompagnement 360° Premium</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Un conseiller dédié vous accompagne personnellement du choix de l'université jusqu'à votre intégration complète. Coaching pour entretiens, révision de dossiers, préparation culturelle, accueil à l'aéroport et suivi post-arrivée pendant 6 mois.
                    </p>
                    <p class="text-sm text-accent-600 font-semibold">
                        👥 Support 24/7 via WhatsApp
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations Section -->
    <section id="destinations" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-100 rounded-full blur-3xl opacity-30 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-100 rounded-full blur-3xl opacity-30 -z-10"></div>

        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-2 bg-accent-100 rounded-full mb-4">
                    <span class="text-accent-700 font-bold text-sm uppercase tracking-wider">Destinations Phares</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-primary-900 mb-4">Nous Vous Accompagnons Vers</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Profitez de notre expertise dans deux destinations d'excellence offrant des opportunités académiques exceptionnelles et des bourses généreuses
                </p>
            </div>

            <!-- China Section -->
            <div class="mb-20">
                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <!-- Hero Image Banner -->
                    <div class="relative h-96 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1508804185872-d7badad00f7d?w=1200&h=600&fit=crop"
                             alt="Chine - Shanghai"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute inset-0 flex items-end">
                            <div class="p-8 md:p-12 w-full">
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="text-7xl">🇨🇳</div>
                                    <div>
                                        <h3 class="text-5xl md:text-6xl font-bold text-white mb-2">Chine</h3>
                                        <p class="text-2xl text-red-200 font-semibold">中国 - Zhōngguó</p>
                                    </div>
                                </div>
                                <p class="text-xl text-white/90 max-w-3xl">
                                    La destination numéro 1 pour les étudiants africains - Plus de 60,000 étudiants africains étudient actuellement en Chine
                                </p>
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 px-6 py-3 bg-accent-600 rounded-full shadow-2xl">
                            <span class="text-white font-bold">⭐ Destination #1</span>
                        </div>
                    </div>

                    <!-- Content Grid -->
                    <div class="p-8 md:p-12">
                        <!-- Introduction -->
                        <div class="mb-12">
                            <h4 class="text-3xl md:text-4xl font-bold text-primary-900 mb-4">Pourquoi Étudier en Chine ?</h4>
                            <p class="text-lg text-gray-600 leading-relaxed mb-6">
                                La Chine s'est imposée comme la destination privilégiée pour les étudiants africains cherchant une éducation de classe mondiale. Avec son économie dynamique, ses universités de renommée internationale et son programme de bourses généreux, la Chine offre des opportunités incomparables pour votre avenir.
                            </p>
                        </div>

                        <!-- Image Gallery -->
                        <div class="grid md:grid-cols-3 gap-4 mb-12">
                            <div class="relative h-48 rounded-xl overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400&h=300&fit=crop"
                                     alt="Campus universitaire en Chine"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                    <p class="text-white font-semibold p-4">Campus Moderne</p>
                                </div>
                            </div>
                            <div class="relative h-48 rounded-xl overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400&h=300&fit=crop"
                                     alt="Étudiants internationaux"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                    <p class="text-white font-semibold p-4">Vie Étudiante</p>
                                </div>
                            </div>
                            <div class="relative h-48 rounded-xl overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1547981609-4b6bfe67ca0b?w=400&h=300&fit=crop"
                                     alt="Culture chinoise"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                    <p class="text-white font-semibold p-4">Culture Riche</p>
                                </div>
                            </div>
                        </div>

                        <!-- Avantages -->
                        <div class="mb-12">
                            <h5 class="text-2xl font-bold text-primary-900 mb-6">Les Avantages Incomparables</h5>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="p-6 bg-gradient-to-br from-red-50 to-orange-50 rounded-xl border border-red-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Bourses CSC Complètes</p>
                                            <p class="text-gray-600">Le programme de bourses du gouvernement chinois (CSC) couvre 100% des frais : scolarité, logement, assurance médicale et allocation mensuelle pour vivre confortablement.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Universités de Renommée Mondiale</p>
                                            <p class="text-gray-600">Accédez aux meilleures universités chinoises classées parmi le top mondial : Tsinghua, Peking University, Fudan, Shanghai Jiao Tong, Zhejiang University.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7zm2 6.172V4h2v4.172a3 3 0 00.879 2.12l1.027 1.028a4 4 0 00-2.171.102l-.47.156a4 4 0 01-2.53 0l-.563-.187a1.993 1.993 0 00-.114-.035l1.063-1.063A3 3 0 009 8.172z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Programmes en Anglais</p>
                                            <p class="text-gray-600">Plus de 500 programmes de Licence, Master et Doctorat enseignés entièrement en anglais. Cours de chinois mandarin gratuits inclus.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Coût de Vie Très Abordable</p>
                                            <p class="text-gray-600">Vivez confortablement avec un budget étudiant. Logement moderne, nourriture variée, transport ultra-efficace. Contactez-nous pour un devis personnalisé.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="mb-12">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-8 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl text-white">
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">350+</div>
                                    <div class="text-sm text-red-100">Étudiants Accompagnés</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">95%</div>
                                    <div class="text-sm text-red-100">Taux d'Admission</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">150+</div>
                                    <div class="text-sm text-red-100">Universités Partenaires</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">100%</div>
                                    <div class="text-sm text-red-100">Bourses Disponibles</div>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignages Chine -->
                        <div class="mb-12">
                            <h5 class="text-2xl font-bold text-primary-900 mb-6">Ce Que Disent Nos Étudiants en Chine</h5>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="p-6 bg-white border-2 border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition-all">
                                    <div class="flex items-center mb-4">
                                        <img src="https://ui-avatars.com/api/?name=Fatima+Ouedraogo&background=e2a60a&color=fff&size=60"
                                             alt="Fatima"
                                             class="w-14 h-14 rounded-full mr-4">
                                        <div>
                                            <h6 class="font-bold text-primary-900">Fatima Ouédraogo</h6>
                                            <p class="text-sm text-gray-600">Master en Ingénierie - Beijing</p>
                                        </div>
                                    </div>
                                    <div class="flex mb-3">
                                        <span class="text-yellow-400">★★★★★</span>
                                    </div>
                                    <p class="text-gray-700 italic leading-relaxed">
                                        "Grâce à Travel Express, j'ai obtenu une bourse CSC complète à l'Université de Beijing. Le processus était simple et leur équipe m'a accompagnée du début à la fin. Aujourd'hui, je vis mon rêve en Chine !"
                                    </p>
                                </div>

                                <div class="p-6 bg-white border-2 border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition-all">
                                    <div class="flex items-center mb-4">
                                        <img src="https://ui-avatars.com/api/?name=Abdoulaye+Sawadogo&background=2B6CB0&color=fff&size=60"
                                             alt="Abdoulaye"
                                             class="w-14 h-14 rounded-full mr-4">
                                        <div>
                                            <h6 class="font-bold text-primary-900">Abdoulaye Sawadogo</h6>
                                            <p class="text-sm text-gray-600">Doctorat en Médecine - Shanghai</p>
                                        </div>
                                    </div>
                                    <div class="flex mb-3">
                                        <span class="text-yellow-400">★★★★★</span>
                                    </div>
                                    <p class="text-gray-700 italic leading-relaxed">
                                        "La Chine offre des infrastructures médicales ultra-modernes. Travel Express m'a aidé à intégrer Shanghai Jiao Tong avec une bourse complète. Un investissement qui change une vie !"
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Chine -->
                        <div class="p-8 bg-gradient-to-r from-accent-50 to-yellow-50 rounded-2xl border-2 border-accent-200">
                            <div class="text-center mb-6">
                                <h5 class="text-2xl font-bold text-primary-900 mb-3">🎓 Prêt à Étudier en Chine ?</h5>
                                <p class="text-gray-700 max-w-2xl mx-auto">
                                    Obtenez votre devis personnalisé et découvrez les bourses disponibles pour votre profil. Nos conseillers spécialisés en admissions chinoises vous répondent sous 24h.
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button class="btn-primary flex items-center justify-center space-x-2 text-lg">
                                    <span>Contactez-nous</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                                <button class="px-8 py-3 border-2 border-primary-600 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300">
                                    Télécharger la Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Spain Section -->
            <div class="mb-20">
                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <!-- Hero Image Banner -->
                    <div class="relative h-96 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1543785734-4b6e564642f8?w=1200&h=600&fit=crop"
                             alt="Espagne - Barcelona"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute inset-0 flex items-end">
                            <div class="p-8 md:p-12 w-full">
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="text-7xl">🇪🇸</div>
                                    <div>
                                        <h3 class="text-5xl md:text-6xl font-bold text-white mb-2">Espagne</h3>
                                        <p class="text-2xl text-yellow-200 font-semibold">España</p>
                                    </div>
                                </div>
                                <p class="text-xl text-white/90 max-w-3xl">
                                    Votre porte d'entrée vers l'Europe - Éducation d'excellence, culture vibrante et opportunités infinies
                                </p>
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 px-6 py-3 bg-accent-600 rounded-full shadow-2xl">
                            <span class="text-white font-bold">⭐ Destination Premium</span>
                        </div>
                    </div>

                    <!-- Content Grid -->
                    <div class="p-8 md:p-12">
                        <!-- Introduction -->
                        <div class="mb-12">
                            <h4 class="text-3xl md:text-4xl font-bold text-primary-900 mb-4">Pourquoi Étudier en Espagne ?</h4>
                            <p class="text-lg text-gray-600 leading-relaxed mb-6">
                                L'Espagne combine l'excellence académique européenne avec un coût de vie abordable et une qualité de vie exceptionnelle. Avec ses diplômes reconnus dans toute l'Union Européenne, ses programmes innovants et sa culture accueillante, l'Espagne est le choix idéal pour votre réussite académique et professionnelle.
                            </p>
                        </div>

                        <!-- Image Gallery -->
                        <div class="grid md:grid-cols-3 gap-4 mb-12">
                            <div class="relative h-48 rounded-xl overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1558642452-9d2a7deb7f62?w=400&h=300&fit=crop"
                                     alt="Architecture espagnole"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                    <p class="text-white font-semibold p-4">Architecture Historique</p>
                                </div>
                            </div>
                            <div class="relative h-48 rounded-xl overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1571781418606-70265b9cce90?w=400&h=300&fit=crop"
                                     alt="Université en Espagne"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                    <p class="text-white font-semibold p-4">Universités Prestigieuses</p>
                                </div>
                            </div>
                            <div class="relative h-48 rounded-xl overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=400&h=300&fit=crop"
                                     alt="Vie en Espagne"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                    <p class="text-white font-semibold p-4">Qualité de Vie</p>
                                </div>
                            </div>
                        </div>

                        <!-- Avantages -->
                        <div class="mb-12">
                            <h5 class="text-2xl font-bold text-primary-900 mb-6">Les Avantages Exclusifs</h5>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="p-6 bg-gradient-to-br from-orange-50 to-red-50 rounded-xl border border-orange-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Diplômes Reconnus dans toute l'UE</p>
                                            <p class="text-gray-600">Système européen LMD (Licence-Master-Doctorat). Votre diplôme espagnol est automatiquement reconnu dans les 27 pays de l'Union Européenne, vous ouvrant les portes du marché du travail européen.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl border border-yellow-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Universités d'Excellence</p>
                                            <p class="text-gray-600">Universitat de Barcelona (classée top 200 mondial), Complutense de Madrid, Politècnica de València, IE Business School, et bien d'autres institutions de renommée internationale.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl border border-emerald-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Bourses et Aides Financières</p>
                                            <p class="text-gray-600">Bourses MEC (Ministère espagnol), Fondation Carolina pour étudiants africains, bourses régionales, réductions universitaires. Contactez-nous pour connaître votre éligibilité.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-primary-900 mb-2">Permis de Travail Post-Études</p>
                                            <p class="text-gray-600">Après vos études, restez 2 ans en Espagne pour chercher un emploi ou créer votre entreprise. L'Espagne facilite l'intégration professionnelle des diplômés internationaux.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="mb-12">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-8 bg-gradient-to-br from-orange-600 via-red-600 to-yellow-600 rounded-2xl text-white">
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">200+</div>
                                    <div class="text-sm text-orange-100">Étudiants en Espagne</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">92%</div>
                                    <div class="text-sm text-orange-100">Taux d'Admission</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">75+</div>
                                    <div class="text-sm text-orange-100">Universités Partenaires</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl md:text-5xl font-bold mb-2">80%</div>
                                    <div class="text-sm text-orange-100">Bourses Disponibles</div>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignages Espagne -->
                        <div class="mb-12">
                            <h5 class="text-2xl font-bold text-primary-900 mb-6">Témoignages de Nos Étudiants en Espagne</h5>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="p-6 bg-white border-2 border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition-all">
                                    <div class="flex items-center mb-4">
                                        <img src="https://ui-avatars.com/api/?name=Kadidia+Traore&background=e2a60a&color=fff&size=60"
                                             alt="Kadidia"
                                             class="w-14 h-14 rounded-full mr-4">
                                        <div>
                                            <h6 class="font-bold text-primary-900">Kadidia Traoré</h6>
                                            <p class="text-sm text-gray-600">MBA - IE Business School, Madrid</p>
                                        </div>
                                    </div>
                                    <div class="flex mb-3">
                                        <span class="text-yellow-400">★★★★★</span>
                                    </div>
                                    <p class="text-gray-700 italic leading-relaxed">
                                        "L'Espagne a transformé ma carrière ! J'ai obtenu mon MBA à IE Business School grâce à Travel Express. L'accompagnement est exceptionnel, du dossier de candidature jusqu'à mon installation à Madrid."
                                    </p>
                                </div>

                                <div class="p-6 bg-white border-2 border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition-all">
                                    <div class="flex items-center mb-4">
                                        <img src="https://ui-avatars.com/api/?name=Souleymane+Kone&background=2B6CB0&color=fff&size=60"
                                             alt="Souleymane"
                                             class="w-14 h-14 rounded-full mr-4">
                                        <div>
                                            <h6 class="font-bold text-primary-900">Souleymane Koné</h6>
                                            <p class="text-sm text-gray-600">Master en Architecture - Barcelona</p>
                                        </div>
                                    </div>
                                    <div class="flex mb-3">
                                        <span class="text-yellow-400">★★★★★</span>
                                    </div>
                                    <p class="text-gray-700 italic leading-relaxed">
                                        "Barcelone est incroyable ! La qualité de vie, les professeurs renommés et l'environnement multiculturel font de l'Espagne la destination parfaite. Merci Travel Express pour avoir rendu ce rêve possible !"
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Espagne -->
                        <div class="p-8 bg-gradient-to-r from-orange-50 via-yellow-50 to-red-50 rounded-2xl border-2 border-orange-200">
                            <div class="text-center mb-6">
                                <h5 class="text-2xl font-bold text-primary-900 mb-3">🇪🇸 Vivez l'Expérience Espagnole !</h5>
                                <p class="text-gray-700 max-w-2xl mx-auto">
                                    Découvrez comment étudier en Espagne peut changer votre vie. Contactez nos experts en admissions espagnoles pour un accompagnement personnalisé et des réponses sous 24h.
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button class="btn-primary flex items-center justify-center space-x-2 text-lg">
                                    <span>Contactez-nous</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                                <button class="px-8 py-3 border-2 border-primary-600 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300">
                                    Télécharger la Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Banner -->
            <div class="mt-12 p-8 bg-gradient-to-r from-primary-900 to-primary-700 rounded-2xl shadow-xl text-center text-white">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">
                    Nos Conseillers Spécialisés Vous Accompagnent
                </h3>
                <p class="text-lg text-blue-100 mb-6 max-w-3xl mx-auto">
                    Experts en admissions chinoises et espagnoles, nous maîtrisons chaque étape du processus : traduction de documents, obtention de visas, recherche de logement et intégration culturelle.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">Accompagnement en français</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">Support visa garanti</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">Réseau d'anciens étudiants</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white border-t border-b border-gray-200">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="group hover:scale-105 transition-transform duration-300">
                    <div class="text-5xl font-bold text-primary-600 mb-2">1000+</div>
                    <div class="text-gray-600 font-medium">Étudiants Accompagnés</div>
                    <div class="text-sm text-gray-500 mt-1">Depuis 2012</div>
                </div>
                <div class="group hover:scale-105 transition-transform duration-300">
                    <div class="text-5xl font-bold text-accent-600 mb-2">35</div>
                    <div class="text-gray-600 font-medium">Pays de Destination</div>
                    <div class="text-sm text-gray-500 mt-1">🇨🇳 Chine & 🇪🇸 Espagne en tête</div>
                </div>
                <div class="group hover:scale-105 transition-transform duration-300">
                    <div class="text-5xl font-bold text-primary-600 mb-2">98%</div>
                    <div class="text-gray-600 font-medium">Taux de Satisfaction</div>
                    <div class="text-sm text-gray-500 mt-1">Clients satisfaits</div>
                </div>
                <div class="group hover:scale-105 transition-transform duration-300">
                    <div class="text-5xl font-bold text-accent-600 mb-2">200+</div>
                    <div class="text-gray-600 font-medium">Universités Partenaires</div>
                    <div class="text-sm text-gray-500 mt-1">Institutions d'excellence</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-primary-900 to-primary-700">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Ils Ont Réussi Avec Nous</h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Des centaines d'étudiants burkinabè poursuivent aujourd'hui leurs rêves dans les plus grandes universités du monde grâce à Travel Express
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-xl">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Aminata+Traore&background=e2a60a&color=fff&size=64"
                             alt="Aminata"
                             class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-primary-900">Aminata Traoré</h4>
                            <p class="text-sm text-gray-600">Master au Canada</p>
                        </div>
                    </div>
                    <div class="flex mb-2">
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray-600 italic">
                        "Travel Express a complètement changé ma vie ! J'ai obtenu une bourse complète pour McGill University. Leur équipe m'a accompagnée du début à la fin avec professionnalisme. Merci infiniment !"
                    </p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-xl">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Ibrahim+Kone&background=2B6CB0&color=fff&size=64"
                             alt="Ibrahim"
                             class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-primary-900">Ibrahim Koné</h4>
                            <p class="text-sm text-gray-600">Doctorat en France</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Grâce à Travel Express, j'ai pu réaliser mon rêve d'étudier en France. L'équipe est très professionnelle."
                    </p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-xl">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Fatoumata+Sawadogo&background=e2a60a&color=fff&size=64"
                             alt="Fatoumata"
                             class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-primary-900">Fatoumata Sawadogo</h4>
                            <p class="text-sm text-gray-600">Licence aux USA</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Un accompagnement de qualité du début à la fin. Je suis très satisfaite de leur travail."
                    </p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-xl">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Moussa+Ouedraogo&background=2B6CB0&color=fff&size=64"
                             alt="Moussa"
                             class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-primary-900">Moussa Ouédraogo</h4>
                            <p class="text-sm text-gray-600">Master en Belgique</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Service rapide et efficace. Toute mon admiration pour cette équipe dévouée !"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-accent-600 to-accent-700">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Prêt à Réaliser Votre Rêve ?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Contactez-nous dès aujourd'hui et commencez votre aventure académique
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="px-8 py-4 bg-white text-accent-600 font-bold rounded-lg shadow-xl hover:bg-gray-100 transform hover:scale-105 transition-all duration-300">
                    Demander une Bourse
                </button>
                <button class="px-8 py-4 bg-transparent text-white font-bold rounded-lg border-2 border-white hover:bg-white hover:text-accent-600 transform hover:scale-105 transition-all duration-300">
                    Nous contacter
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 text-white overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full opacity-5">
            <div class="absolute top-10 left-10 w-72 h-72 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-primary-500 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Newsletter Section -->
            <div class="py-12 border-b border-white/10">
                <div class="max-w-3xl mx-auto text-center">
                    <h3 class="text-3xl font-bold mb-4">Restez Informé des Nouvelles Bourses</h3>
                    <p class="text-gray-300 mb-6">Recevez chaque semaine les dernières opportunités de bourses directement dans votre boîte mail</p>
                    <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <input type="email" placeholder="Votre adresse email" class="flex-1 px-6 py-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-accent-500">
                        <button class="px-8 py-3 bg-accent-600 hover:bg-accent-700 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                            S'abonner
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Footer Content -->
            <div class="py-12">
                <div class="grid md:grid-cols-5 gap-8">
                    <!-- Company Info -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-accent-600 to-accent-800 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold">Travel <span class="text-accent-400">Express</span></h3>
                                <p class="text-xs text-gray-400">Votre avenir commence ici</p>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Leader burkinabè de l'accompagnement académique international. Depuis 2012, nous transformons les rêves en réalité.
                        </p>
                        <div class="flex items-center space-x-2 text-sm text-gray-400">
                            <svg class="w-5 h-5 text-accent-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Agence certifiée et agréée</span>
                        </div>
                    </div>

                    <!-- Services -->
                    <div>
                        <h4 class="font-bold mb-4 text-lg flex items-center">
                            <span class="w-1 h-6 bg-accent-500 mr-2"></span>
                            Programmes
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                Licence (BAC+3)
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                Master (BAC+5)
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                Doctorat (BAC+8)
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                Bourses d'études
                            </a></li>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-bold mb-4 text-lg flex items-center">
                            <span class="w-1 h-6 bg-accent-500 mr-2"></span>
                            Ressources
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                À propos
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                FAQ
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                Blog
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-accent-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-accent-500 rounded-full mr-2 group-hover:scale-150 transition-transform"></span>
                                Témoignages
                            </a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="font-bold mb-4 text-lg flex items-center">
                            <span class="w-1 h-6 bg-accent-500 mr-2"></span>
                            Contact
                        </h4>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-accent-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm">Ouagadougou<br/>Burkina Faso</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-accent-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm">contact@travel-express.bf</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-accent-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-sm">+226 XX XX XX XX</span>
                            </li>
                        </ul>

                        <!-- Social Media -->
                        <div class="mt-6">
                            <p class="text-sm text-gray-400 mb-3">Suivez-nous</p>
                            <div class="flex gap-2">
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-green-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-blue-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="py-6 border-t border-white/10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        &copy; 2025 <span class="text-accent-400 font-semibold">Travel Express Burkina Faso</span>. Tous droits réservés.
                    </p>
                    <div class="flex gap-6 text-sm text-gray-400">
                        <a href="#" class="hover:text-accent-400 transition-colors">Politique de confidentialité</a>
                        <a href="#" class="hover:text-accent-400 transition-colors">Conditions d'utilisation</a>
                        <a href="#" class="hover:text-accent-400 transition-colors">Mentions légales</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/226XXXXXXXX"
       target="_blank"
       class="fixed bottom-6 right-6 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-2xl hover:bg-green-600 hover:scale-110 transition-all duration-300 z-50 animate-bounce">
        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>

    <!-- Scroll to top button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-6 left-6 w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center shadow-lg hover:bg-primary-700 transition-all duration-300 z-50 opacity-0 scroll-to-top">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Show scroll to top button
        window.addEventListener('scroll', () => {
            const scrollBtn = document.querySelector('.scroll-to-top');
            if (window.scrollY > 300) {
                scrollBtn.classList.remove('opacity-0');
                scrollBtn.classList.add('opacity-100');
            } else {
                scrollBtn.classList.remove('opacity-100');
                scrollBtn.classList.add('opacity-0');
            }
        });
    </script>
</body>
</html>

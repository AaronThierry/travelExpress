<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Travel Express</title>

    <!-- Google Fonts - Premium Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Flag Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display { font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif; }
        .font-sans { font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .slide-in { animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .fade-in { animation: fadeIn 0.4s ease-out; }

        .input-elegant {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .input-elegant:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 113, 227, 0.12);
        }

        .btn-elegant {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 113, 227, 0.3);
        }
        .btn-elegant:active {
            transform: translateY(0);
        }

        /* Animated background blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }
        .blob-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #0071e3, #0077ED);
            top: -200px;
            left: -200px;
            animation-delay: 0s;
        }
        .blob-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #FF9500, #FF6D00);
            bottom: -150px;
            right: -150px;
            animation-delay: 2s;
        }
        .blob-3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #2997FF, #0369a1);
            top: 50%;
            left: -100px;
            animation-delay: 4s;
        }

        /* Progress bar */
        .progress-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 9999px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #0071e3, #FF9500);
            transition: width 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Flag icons in select */
        #country option {
            padding-left: 30px;
            background-repeat: no-repeat;
            background-position: 6px center;
            background-size: 20px 15px;
        }
        .flag-icon {
            display: inline-block;
            width: 20px;
            height: 15px;
            margin-right: 8px;
            border-radius: 2px;
        }
    </style>
</head>
<body class="font-sans min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden">

    <!-- Animated Background Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
        <div class="w-full max-w-md slide-in">

            <!-- Logo -->
            <div class="text-center mb-8 fade-in">
                <a href="/" class="inline-flex items-center space-x-3.5 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-accent-500 to-accent-600 rounded-2xl blur-xl opacity-20 group-hover:opacity-40 transition-all duration-500 animate-pulse"></div>
                        <div class="relative w-16 h-16 bg-gradient-to-br from-primary-600 via-primary-700 to-accent-600 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl shadow-primary-600/20">
                            <svg class="w-9 h-9 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-display font-bold text-dark tracking-tight leading-none group-hover:text-primary-600 transition-colors duration-300" style="letter-spacing: -0.02em;">Travel Express</span>
                        <span class="text-xs font-sans font-bold text-primary-600 tracking-[0.15em] uppercase leading-none mt-1.5 opacity-90">Study Abroad Experts</span>
                    </div>
                </a>
            </div>

            <!-- Register Card -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/5 p-8 border border-white/20 relative overflow-hidden">
                <!-- Card gradient overlay -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-600 via-accent-500 to-accent-600"></div>

                <div class="mb-6">
                    <h2 class="text-3xl font-display font-bold text-dark mb-2" style="letter-spacing: -0.02em;">Créer un compte</h2>
                    <p class="text-sm text-gray-600 font-medium tracking-wide">Étape <span id="stepIndicator">1</span>/3</p>
                </div>

                <!-- Progress Bar -->
                <div class="progress-bar mb-6">
                    <div id="progressFill" class="progress-fill" style="width: 33.33%;"></div>
                </div>

                <div id="alert-container" class="mb-5"></div>

                <form id="registerForm" class="space-y-4">
                    <!-- Step 1: Personal Info -->
                    <div id="step1">
                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Nom et Prénom</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="name" required
                                    class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                    placeholder="Jean Dupont">
                            </div>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="name-error"></p>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Adresse e-mail</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" required
                                    class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                    placeholder="votre@email.com">
                            </div>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="email-error"></p>
                        </div>

                        <!-- Country -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Pays</label>
                            <div class="relative" x-data="countrySelector()">
                                <input type="hidden" id="country" name="country" required x-model="selectedValue">

                                <button type="button" @click="open = !open"
                                    class="w-full pl-4 pr-10 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark input-elegant transition-all text-left flex items-center gap-3"
                                    :class="{'border-primary-500 ring-2 ring-primary-500': open}">
                                    <span x-show="!selectedFlag" class="text-gray-400">Sélectionnez votre pays</span>
                                    <template x-if="selectedFlag">
                                        <div class="flex items-center gap-3">
                                            <img :src="`https://flagcdn.com/w20/${selectedFlag}.png`"
                                                 :alt="selectedCountry"
                                                 class="w-6 h-4 object-cover rounded shadow-sm">
                                            <span x-text="selectedCountry"></span>
                                        </div>
                                    </template>
                                    <svg class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 transition-transform"
                                         :class="{'rotate-180': open}"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open"
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute left-0 right-0 top-full mt-2 bg-white border-2 border-gray-200 rounded-xl shadow-2xl z-50 max-h-60 overflow-hidden"
                                     style="display: none;">

                                    <div class="sticky top-0 bg-white p-3 border-b border-gray-200">
                                        <input type="text"
                                               x-model="search"
                                               placeholder="Rechercher un pays..."
                                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    </div>

                                    <div class="overflow-y-auto max-h-48">
                                        <template x-for="country in filteredCountries" :key="country.value">
                                            <button type="button"
                                                    @click="selectCountry(country)"
                                                    class="w-full px-4 py-2.5 text-left hover:bg-primary-50 transition-colors flex items-center gap-3 text-sm"
                                                    :class="{'bg-primary-100': selectedValue === country.value}">
                                                <img :src="`https://flagcdn.com/w20/${country.flag}.png`"
                                                     :alt="country.name"
                                                     class="w-6 h-4 object-cover rounded shadow-sm">
                                                <span x-text="country.name"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                    </div>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="country-error"></p>
                        </div>

                        <button type="button" id="nextButton"
                            class="w-full py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg flex items-center justify-center space-x-2.5 btn-elegant tracking-wide">
                            <span>Suivant</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Step 2: Professional Info -->
                    <div id="step2" class="hidden">
                        <!-- Status -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Statut actuel</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <select id="status" required
                                    class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark input-elegant transition-all appearance-none">
                                    <option value="">Sélectionnez votre statut</option>
                                    <option value="student">Étudiant</option>
                                    <option value="professional">Professionnel</option>
                                    <option value="graduate">Diplômé</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="status-error"></p>
                        </div>

                        <!-- Specialty -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Spécialité / Poste actuel</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <input type="text" id="specialty" required
                                    class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                    placeholder="Ex: Étudiant en Réseaux à l'Université de Pékin">
                            </div>
                            <p class="text-xs text-gray-500 mt-1.5">Exemples: Étudiant en Réseaux à l'Université de Pékin, Ingénieur Système chez IBM</p>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="specialty-error"></p>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" id="prevButton"
                                class="flex-1 py-4 bg-gray-100 hover:bg-gray-200 text-dark text-sm font-bold rounded-xl shadow-md flex items-center justify-center space-x-2 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                                </svg>
                                <span>Retour</span>
                            </button>
                            <button type="button" id="nextButton2"
                                class="flex-1 py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg flex items-center justify-center space-x-2.5 btn-elegant tracking-wide">
                                <span>Suivant</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Security -->
                    <div id="step3" class="hidden">
                        <!-- Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Mot de passe</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" id="password" required
                                    class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                    placeholder="Minimum 8 caractères">
                            </div>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="password-error"></p>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-dark mb-2 tracking-wide">Confirmer le mot de passe</label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" id="password_confirmation" required
                                    class="w-full pl-12 pr-4 py-3.5 text-sm bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-dark placeholder-gray-400 input-elegant transition-all"
                                    placeholder="Confirmez votre mot de passe">
                            </div>
                            <p class="text-red-600 text-xs mt-2 hidden font-medium" id="password_confirmation-error"></p>
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start mb-4">
                            <input type="checkbox" id="terms" required class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-2 focus:ring-primary-500 transition-all mt-1">
                            <label for="terms" class="ml-2.5 text-sm text-gray-700">
                                J'accepte les <a href="#" class="text-primary-600 font-bold hover:text-primary-700 transition-colors relative group">
                                    <span>conditions d'utilisation</span>
                                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                                </a>
                            </label>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" id="prevButton2"
                                class="flex-1 py-4 bg-gray-100 hover:bg-gray-200 text-dark text-sm font-bold rounded-xl shadow-md flex items-center justify-center space-x-2 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                                </svg>
                                <span>Retour</span>
                            </button>
                            <button type="submit" id="registerButton"
                                class="flex-1 py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white text-sm font-bold rounded-xl shadow-lg flex items-center justify-center space-x-2.5 btn-elegant tracking-wide">
                                <span id="registerButtonText">Créer mon compte</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte?
                        <a href="/login" class="text-primary-600 font-bold hover:text-primary-700 transition-colors relative inline-block group">
                            <span>Se connecter</span>
                            <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-primary-600 to-accent-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </a>
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="/" class="inline-flex items-center space-x-2 text-sm text-gray-600 hover:text-dark transition-colors group font-medium">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Retour à l'accueil</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Alpine.js country selector component
        function countrySelector() {
            return {
                open: false,
                search: '',
                selectedValue: '',
                selectedCountry: '',
                selectedFlag: '',
                countries: [
                    {value: 'afghanistan', name: 'Afghanistan', flag: 'af'},
                    {value: 'south_africa', name: 'Afrique du Sud', flag: 'za'},
                    {value: 'albania', name: 'Albanie', flag: 'al'},
                    {value: 'algeria', name: 'Algérie', flag: 'dz'},
                    {value: 'germany', name: 'Allemagne', flag: 'de'},
                    {value: 'andorra', name: 'Andorre', flag: 'ad'},
                    {value: 'angola', name: 'Angola', flag: 'ao'},
                    {value: 'saudi_arabia', name: 'Arabie Saoudite', flag: 'sa'},
                    {value: 'argentina', name: 'Argentine', flag: 'ar'},
                    {value: 'armenia', name: 'Arménie', flag: 'am'},
                    {value: 'australia', name: 'Australie', flag: 'au'},
                    {value: 'austria', name: 'Autriche', flag: 'at'},
                    {value: 'azerbaijan', name: 'Azerbaïdjan', flag: 'az'},
                    {value: 'bahamas', name: 'Bahamas', flag: 'bs'},
                    {value: 'bahrain', name: 'Bahreïn', flag: 'bh'},
                    {value: 'bangladesh', name: 'Bangladesh', flag: 'bd'},
                    {value: 'barbados', name: 'Barbade', flag: 'bb'},
                    {value: 'belgium', name: 'Belgique', flag: 'be'},
                    {value: 'belize', name: 'Belize', flag: 'bz'},
                    {value: 'benin', name: 'Bénin', flag: 'bj'},
                    {value: 'bhutan', name: 'Bhoutan', flag: 'bt'},
                    {value: 'belarus', name: 'Biélorussie', flag: 'by'},
                    {value: 'bolivia', name: 'Bolivie', flag: 'bo'},
                    {value: 'bosnia', name: 'Bosnie-Herzégovine', flag: 'ba'},
                    {value: 'botswana', name: 'Botswana', flag: 'bw'},
                    {value: 'brazil', name: 'Brésil', flag: 'br'},
                    {value: 'brunei', name: 'Brunei', flag: 'bn'},
                    {value: 'bulgaria', name: 'Bulgarie', flag: 'bg'},
                    {value: 'burkina', name: 'Burkina Faso', flag: 'bf'},
                    {value: 'burundi', name: 'Burundi', flag: 'bi'},
                    {value: 'cambodia', name: 'Cambodge', flag: 'kh'},
                    {value: 'cameroon', name: 'Cameroun', flag: 'cm'},
                    {value: 'canada', name: 'Canada', flag: 'ca'},
                    {value: 'cape_verde', name: 'Cap-Vert', flag: 'cv'},
                    {value: 'chile', name: 'Chili', flag: 'cl'},
                    {value: 'china', name: 'Chine', flag: 'cn'},
                    {value: 'cyprus', name: 'Chypre', flag: 'cy'},
                    {value: 'colombia', name: 'Colombie', flag: 'co'},
                    {value: 'comoros', name: 'Comores', flag: 'km'},
                    {value: 'congo', name: 'Congo', flag: 'cg'},
                    {value: 'drc', name: 'Congo (RDC)', flag: 'cd'},
                    {value: 'north_korea', name: 'Corée du Nord', flag: 'kp'},
                    {value: 'south_korea', name: 'Corée du Sud', flag: 'kr'},
                    {value: 'costa_rica', name: 'Costa Rica', flag: 'cr'},
                    {value: 'ivory_coast', name: 'Côte d\'Ivoire', flag: 'ci'},
                    {value: 'croatia', name: 'Croatie', flag: 'hr'},
                    {value: 'cuba', name: 'Cuba', flag: 'cu'},
                    {value: 'denmark', name: 'Danemark', flag: 'dk'},
                    {value: 'djibouti', name: 'Djibouti', flag: 'dj'},
                    {value: 'dominica', name: 'Dominique', flag: 'dm'},
                    {value: 'egypt', name: 'Égypte', flag: 'eg'},
                    {value: 'uae', name: 'Émirats Arabes Unis', flag: 'ae'},
                    {value: 'ecuador', name: 'Équateur', flag: 'ec'},
                    {value: 'eritrea', name: 'Érythrée', flag: 'er'},
                    {value: 'spain', name: 'Espagne', flag: 'es'},
                    {value: 'estonia', name: 'Estonie', flag: 'ee'},
                    {value: 'eswatini', name: 'Eswatini', flag: 'sz'},
                    {value: 'usa', name: 'États-Unis', flag: 'us'},
                    {value: 'ethiopia', name: 'Éthiopie', flag: 'et'},
                    {value: 'fiji', name: 'Fidji', flag: 'fj'},
                    {value: 'finland', name: 'Finlande', flag: 'fi'},
                    {value: 'france', name: 'France', flag: 'fr'},
                    {value: 'gabon', name: 'Gabon', flag: 'ga'},
                    {value: 'gambia', name: 'Gambie', flag: 'gm'},
                    {value: 'georgia', name: 'Géorgie', flag: 'ge'},
                    {value: 'ghana', name: 'Ghana', flag: 'gh'},
                    {value: 'greece', name: 'Grèce', flag: 'gr'},
                    {value: 'grenada', name: 'Grenade', flag: 'gd'},
                    {value: 'guatemala', name: 'Guatemala', flag: 'gt'},
                    {value: 'guinea', name: 'Guinée', flag: 'gn'},
                    {value: 'guinea_bissau', name: 'Guinée-Bissau', flag: 'gw'},
                    {value: 'equatorial_guinea', name: 'Guinée équatoriale', flag: 'gq'},
                    {value: 'guyana', name: 'Guyana', flag: 'gy'},
                    {value: 'haiti', name: 'Haïti', flag: 'ht'},
                    {value: 'honduras', name: 'Honduras', flag: 'hn'},
                    {value: 'hungary', name: 'Hongrie', flag: 'hu'},
                    {value: 'india', name: 'Inde', flag: 'in'},
                    {value: 'indonesia', name: 'Indonésie', flag: 'id'},
                    {value: 'iraq', name: 'Irak', flag: 'iq'},
                    {value: 'iran', name: 'Iran', flag: 'ir'},
                    {value: 'ireland', name: 'Irlande', flag: 'ie'},
                    {value: 'iceland', name: 'Islande', flag: 'is'},
                    {value: 'israel', name: 'Israël', flag: 'il'},
                    {value: 'italy', name: 'Italie', flag: 'it'},
                    {value: 'jamaica', name: 'Jamaïque', flag: 'jm'},
                    {value: 'japan', name: 'Japon', flag: 'jp'},
                    {value: 'jordan', name: 'Jordanie', flag: 'jo'},
                    {value: 'kazakhstan', name: 'Kazakhstan', flag: 'kz'},
                    {value: 'kenya', name: 'Kenya', flag: 'ke'},
                    {value: 'kyrgyzstan', name: 'Kirghizistan', flag: 'kg'},
                    {value: 'kiribati', name: 'Kiribati', flag: 'ki'},
                    {value: 'kosovo', name: 'Kosovo', flag: 'xk'},
                    {value: 'kuwait', name: 'Koweït', flag: 'kw'},
                    {value: 'laos', name: 'Laos', flag: 'la'},
                    {value: 'lesotho', name: 'Lesotho', flag: 'ls'},
                    {value: 'latvia', name: 'Lettonie', flag: 'lv'},
                    {value: 'lebanon', name: 'Liban', flag: 'lb'},
                    {value: 'liberia', name: 'Libéria', flag: 'lr'},
                    {value: 'libya', name: 'Libye', flag: 'ly'},
                    {value: 'liechtenstein', name: 'Liechtenstein', flag: 'li'},
                    {value: 'lithuania', name: 'Lituanie', flag: 'lt'},
                    {value: 'luxembourg', name: 'Luxembourg', flag: 'lu'},
                    {value: 'north_macedonia', name: 'Macédoine du Nord', flag: 'mk'},
                    {value: 'madagascar', name: 'Madagascar', flag: 'mg'},
                    {value: 'malaysia', name: 'Malaisie', flag: 'my'},
                    {value: 'malawi', name: 'Malawi', flag: 'mw'},
                    {value: 'maldives', name: 'Maldives', flag: 'mv'},
                    {value: 'mali', name: 'Mali', flag: 'ml'},
                    {value: 'malta', name: 'Malte', flag: 'mt'},
                    {value: 'morocco', name: 'Maroc', flag: 'ma'},
                    {value: 'mauritius', name: 'Maurice', flag: 'mu'},
                    {value: 'mauritania', name: 'Mauritanie', flag: 'mr'},
                    {value: 'mexico', name: 'Mexique', flag: 'mx'},
                    {value: 'micronesia', name: 'Micronésie', flag: 'fm'},
                    {value: 'moldova', name: 'Moldavie', flag: 'md'},
                    {value: 'monaco', name: 'Monaco', flag: 'mc'},
                    {value: 'mongolia', name: 'Mongolie', flag: 'mn'},
                    {value: 'montenegro', name: 'Monténégro', flag: 'me'},
                    {value: 'mozambique', name: 'Mozambique', flag: 'mz'},
                    {value: 'myanmar', name: 'Myanmar', flag: 'mm'},
                    {value: 'namibia', name: 'Namibie', flag: 'na'},
                    {value: 'nauru', name: 'Nauru', flag: 'nr'},
                    {value: 'nepal', name: 'Népal', flag: 'np'},
                    {value: 'nicaragua', name: 'Nicaragua', flag: 'ni'},
                    {value: 'niger', name: 'Niger', flag: 'ne'},
                    {value: 'nigeria', name: 'Nigéria', flag: 'ng'},
                    {value: 'norway', name: 'Norvège', flag: 'no'},
                    {value: 'new_zealand', name: 'Nouvelle-Zélande', flag: 'nz'},
                    {value: 'oman', name: 'Oman', flag: 'om'},
                    {value: 'uganda', name: 'Ouganda', flag: 'ug'},
                    {value: 'uzbekistan', name: 'Ouzbékistan', flag: 'uz'},
                    {value: 'pakistan', name: 'Pakistan', flag: 'pk'},
                    {value: 'palau', name: 'Palaos', flag: 'pw'},
                    {value: 'palestine', name: 'Palestine', flag: 'ps'},
                    {value: 'panama', name: 'Panama', flag: 'pa'},
                    {value: 'papua_new_guinea', name: 'Papouasie-Nouvelle-Guinée', flag: 'pg'},
                    {value: 'paraguay', name: 'Paraguay', flag: 'py'},
                    {value: 'netherlands', name: 'Pays-Bas', flag: 'nl'},
                    {value: 'peru', name: 'Pérou', flag: 'pe'},
                    {value: 'philippines', name: 'Philippines', flag: 'ph'},
                    {value: 'poland', name: 'Pologne', flag: 'pl'},
                    {value: 'portugal', name: 'Portugal', flag: 'pt'},
                    {value: 'qatar', name: 'Qatar', flag: 'qa'},
                    {value: 'dominican_republic', name: 'République Dominicaine', flag: 'do'},
                    {value: 'czech_republic', name: 'République Tchèque', flag: 'cz'},
                    {value: 'romania', name: 'Roumanie', flag: 'ro'},
                    {value: 'uk', name: 'Royaume-Uni', flag: 'gb'},
                    {value: 'russia', name: 'Russie', flag: 'ru'},
                    {value: 'rwanda', name: 'Rwanda', flag: 'rw'},
                    {value: 'saint_kitts', name: 'Saint-Kitts-et-Nevis', flag: 'kn'},
                    {value: 'saint_lucia', name: 'Sainte-Lucie', flag: 'lc'},
                    {value: 'saint_vincent', name: 'Saint-Vincent-et-les-Grenadines', flag: 'vc'},
                    {value: 'samoa', name: 'Samoa', flag: 'ws'},
                    {value: 'san_marino', name: 'Saint-Marin', flag: 'sm'},
                    {value: 'sao_tome', name: 'São Tomé-et-Príncipe', flag: 'st'},
                    {value: 'senegal', name: 'Sénégal', flag: 'sn'},
                    {value: 'serbia', name: 'Serbie', flag: 'rs'},
                    {value: 'seychelles', name: 'Seychelles', flag: 'sc'},
                    {value: 'sierra_leone', name: 'Sierra Leone', flag: 'sl'},
                    {value: 'singapore', name: 'Singapour', flag: 'sg'},
                    {value: 'slovakia', name: 'Slovaquie', flag: 'sk'},
                    {value: 'slovenia', name: 'Slovénie', flag: 'si'},
                    {value: 'somalia', name: 'Somalie', flag: 'so'},
                    {value: 'sudan', name: 'Soudan', flag: 'sd'},
                    {value: 'south_sudan', name: 'Soudan du Sud', flag: 'ss'},
                    {value: 'sri_lanka', name: 'Sri Lanka', flag: 'lk'},
                    {value: 'sweden', name: 'Suède', flag: 'se'},
                    {value: 'switzerland', name: 'Suisse', flag: 'ch'},
                    {value: 'suriname', name: 'Suriname', flag: 'sr'},
                    {value: 'syria', name: 'Syrie', flag: 'sy'},
                    {value: 'tajikistan', name: 'Tadjikistan', flag: 'tj'},
                    {value: 'tanzania', name: 'Tanzanie', flag: 'tz'},
                    {value: 'chad', name: 'Tchad', flag: 'td'},
                    {value: 'thailand', name: 'Thaïlande', flag: 'th'},
                    {value: 'east_timor', name: 'Timor oriental', flag: 'tl'},
                    {value: 'togo', name: 'Togo', flag: 'tg'},
                    {value: 'tonga', name: 'Tonga', flag: 'to'},
                    {value: 'trinidad', name: 'Trinité-et-Tobago', flag: 'tt'},
                    {value: 'tunisia', name: 'Tunisie', flag: 'tn'},
                    {value: 'turkmenistan', name: 'Turkménistan', flag: 'tm'},
                    {value: 'turkey', name: 'Turquie', flag: 'tr'},
                    {value: 'tuvalu', name: 'Tuvalu', flag: 'tv'},
                    {value: 'ukraine', name: 'Ukraine', flag: 'ua'},
                    {value: 'uruguay', name: 'Uruguay', flag: 'uy'},
                    {value: 'vanuatu', name: 'Vanuatu', flag: 'vu'},
                    {value: 'vatican', name: 'Vatican', flag: 'va'},
                    {value: 'venezuela', name: 'Venezuela', flag: 've'},
                    {value: 'vietnam', name: 'Vietnam', flag: 'vn'},
                    {value: 'yemen', name: 'Yémen', flag: 'ye'},
                    {value: 'zambia', name: 'Zambie', flag: 'zm'},
                    {value: 'zimbabwe', name: 'Zimbabwe', flag: 'zw'}
                ],
                get filteredCountries() {
                    if (!this.search) return this.countries;
                    const searchLower = this.search.toLowerCase();
                    return this.countries.filter(c =>
                        c.name.toLowerCase().includes(searchLower)
                    );
                },
                selectCountry(country) {
                    this.selectedValue = country.value;
                    this.selectedCountry = country.name;
                    this.selectedFlag = country.flag;
                    this.open = false;
                    this.search = '';
                }
            }
        }

        let currentStep = 1;

        // Navigation entre les étapes
        // Step 1 -> Step 2
        document.getElementById('nextButton').addEventListener('click', function() {
            // Validation Step 1
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const country = document.getElementById('country').value;

            // Clear previous errors
            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));

            // Validate all fields
            if (!name || !email || !country) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            // Go to step 2
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '2';
            document.getElementById('progressFill').style.width = '66.66%';
            currentStep = 2;
        });

        // Step 2 -> Step 3
        document.getElementById('nextButton2').addEventListener('click', function() {
            // Validation Step 2
            const status = document.getElementById('status').value;
            const specialty = document.getElementById('specialty').value;

            // Clear previous errors
            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));

            // Validate all fields
            if (!status || !specialty) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            // Go to step 3
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '3';
            document.getElementById('progressFill').style.width = '100%';
            currentStep = 3;
        });

        // Step 2 -> Step 1
        document.getElementById('prevButton').addEventListener('click', function() {
            // Go back to step 1
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '1';
            document.getElementById('progressFill').style.width = '33.33%';
            currentStep = 1;
        });

        // Step 3 -> Step 2
        document.getElementById('prevButton2').addEventListener('click', function() {
            // Go back to step 2
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('stepIndicator').textContent = '2';
            document.getElementById('progressFill').style.width = '66.66%';
            currentStep = 2;
        });

        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const button = document.getElementById('registerButton');
            const buttonText = document.getElementById('registerButtonText');
            const alertContainer = document.getElementById('alert-container');

            document.querySelectorAll('[id$="-error"]').forEach(el => el.classList.add('hidden'));
            alertContainer.innerHTML = '';

            // Validate passwords
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password.length < 8) {
                const errorEl = document.getElementById('password-error');
                errorEl.textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
                errorEl.classList.remove('hidden');
                return;
            }

            if (password !== passwordConfirmation) {
                const errorEl = document.getElementById('password_confirmation-error');
                errorEl.textContent = 'Les mots de passe ne correspondent pas.';
                errorEl.classList.remove('hidden');
                return;
            }

            if (!document.getElementById('terms').checked) {
                alertContainer.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-red-800 text-sm font-bold">Veuillez accepter les conditions d'utilisation</p>
                    </div>
                `;
                return;
            }

            button.disabled = true;
            button.classList.add('opacity-75', 'cursor-not-allowed');
            buttonText.textContent = 'Inscription en cours...';

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        country: document.getElementById('country').value,
                        password: document.getElementById('password').value,
                        password_confirmation: document.getElementById('password_confirmation').value,
                        status: document.getElementById('status').value,
                        specialty: document.getElementById('specialty').value,
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));

                    alertContainer.innerHTML = `
                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-green-800 text-sm font-bold">${data.message}</p>
                        </div>
                    `;

                    setTimeout(() => window.location.href = '/', 1200);
                } else {
                    if (data.errors) {
                        // Check which step has errors
                        const step1Fields = ['name', 'email', 'country'];
                        const step2Fields = ['status', 'specialty'];
                        const step3Fields = ['password', 'password_confirmation'];

                        const hasStep1Error = Object.keys(data.errors).some(key => step1Fields.includes(key));
                        const hasStep2Error = Object.keys(data.errors).some(key => step2Fields.includes(key));
                        const hasStep3Error = Object.keys(data.errors).some(key => step3Fields.includes(key));

                        // Navigate to the step with errors
                        if (hasStep1Error && currentStep !== 1) {
                            document.getElementById('step2').classList.add('hidden');
                            document.getElementById('step3').classList.add('hidden');
                            document.getElementById('step1').classList.remove('hidden');
                            document.getElementById('stepIndicator').textContent = '1';
                            document.getElementById('progressFill').style.width = '33.33%';
                            currentStep = 1;
                        } else if (hasStep2Error && currentStep !== 2) {
                            document.getElementById('step1').classList.add('hidden');
                            document.getElementById('step3').classList.add('hidden');
                            document.getElementById('step2').classList.remove('hidden');
                            document.getElementById('stepIndicator').textContent = '2';
                            document.getElementById('progressFill').style.width = '66.66%';
                            currentStep = 2;
                        }

                        // Display individual field errors
                        Object.keys(data.errors).forEach(key => {
                            const el = document.getElementById(`${key}-error`);
                            if (el) {
                                el.textContent = data.errors[key][0];
                                el.classList.remove('hidden');
                            }
                        });

                        // Also display a general error message
                        const firstError = Object.values(data.errors)[0][0];
                        alertContainer.innerHTML = `
                            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-red-800 text-sm font-bold">${firstError}</p>
                            </div>
                        `;
                    } else if (data.message) {
                        alertContainer.innerHTML = `
                            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-red-800 text-sm font-bold">${data.message}</p>
                            </div>
                        `;
                    }
                }
            } catch (error) {
                alertContainer.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3 shadow-sm">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-red-800 text-sm font-bold">Erreur de connexion au serveur</p>
                    </div>
                `;
            } finally {
                button.disabled = false;
                button.classList.remove('opacity-75', 'cursor-not-allowed');
                buttonText.textContent = 'Créer mon compte';
            }
        });
    </script>
</body>
</html>

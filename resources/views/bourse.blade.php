<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Testez votre éligibilité aux bourses d'études - Travel Express Burkina Faso">
    <title>Ma Bourse - Travel Express</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display { font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif; }
        .font-sans { font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; }
    </style>
</head>
<body class="font-sans text-dark antialiased bg-gradient-to-br from-slate-50 via-white to-primary-50 min-h-screen" x-data="{
    moyenne: '',
    resultat: null,
    bourses: [],
    contactModalOpen: false,
    selectedBourse: null,
    formSuccess: false,
    formLoading: false,

    determinerBourse() {
        const moy = parseFloat(this.moyenne);

        if (isNaN(moy) || moy < 0 || moy > 20) {
            this.resultat = { message: 'Veuillez entrer une moyenne valide entre 0 et 20.', type: null, color: 'red' };
            this.bourses = [];
            return;
        }

        if (moy >= 16) {
            this.resultat = { message: 'Félicitations ! Vous avez droit à une bourse complète.', type: 'complète', color: 'green' };
        } else if (moy >= 14) {
            this.resultat = { message: 'Bravo ! Vous avez droit à une bourse complète.', type: 'complète', color: 'green' };
        } else if (moy >= 12) {
            this.resultat = { message: 'Vous avez droit à une bourse semi-complète.', type: 'semi-complète', color: 'blue' };
        } else if (moy >= 10) {
            this.resultat = { message: 'Vous êtes éligible à une bourse partielle.', type: 'partielle', color: 'yellow' };
        } else {
            this.resultat = { message: 'Malheureusement, votre moyenne ne vous permet pas d\'accéder à une bourse. Travaillez dur pour améliorer vos résultats !', type: null, color: 'red' };
            this.bourses = [];
            return;
        }

        this.filtrerBourses();
    },

    filtrerBourses() {
        const toutesLesBourses = [
            { nom: 'Bourse d\'Excellence Chine', type: 'complète', pays: 'Chine', destination: 'china', description: 'Couverture totale des frais de scolarité et hébergement', icon: '🇨🇳' },
            { nom: 'Bourse Gouvernementale CSC', type: 'complète', pays: 'Chine', destination: 'china', description: 'Programme officiel du gouvernement chinois', icon: '🎓' },
            { nom: 'Bourse Mérite Espagne', type: 'complète', pays: 'Espagne', destination: 'spain', description: 'Pour les étudiants excellents en sciences', icon: '🇪🇸' },
            { nom: 'Bourse DAAD Allemagne', type: 'complète', pays: 'Allemagne', destination: 'germany', description: 'Programme d\'échange académique allemand', icon: '🇩🇪' },
            { nom: 'Bourse Semi-Complète Chine', type: 'semi-complète', pays: 'Chine', destination: 'china', description: '50% des frais de scolarité couverts', icon: '🇨🇳' },
            { nom: 'Bourse Erasmus+', type: 'semi-complète', pays: 'Espagne', destination: 'spain', description: 'Programme européen de mobilité', icon: '🇪🇺' },
            { nom: 'Bourse Partielle Universitaire', type: 'partielle', pays: 'Chine', destination: 'china', description: 'Réduction sur les frais de scolarité', icon: '📚' },
            { nom: 'Aide à la Formation', type: 'partielle', pays: 'Allemagne', destination: 'germany', description: 'Soutien financier pour formations techniques', icon: '🛠️' }
        ];

        if (this.resultat && this.resultat.type) {
            const types = [];
            if (this.resultat.type === 'complète') {
                types.push('complète', 'semi-complète', 'partielle');
            } else if (this.resultat.type === 'semi-complète') {
                types.push('semi-complète', 'partielle');
            } else if (this.resultat.type === 'partielle') {
                types.push('partielle');
            }
            this.bourses = toutesLesBourses.filter(b => types.includes(b.type));
        }
    },

    getTypeColor(type) {
        switch(type) {
            case 'complète': return 'bg-green-100 text-green-800 border-green-200';
            case 'semi-complète': return 'bg-blue-100 text-blue-800 border-blue-200';
            case 'partielle': return 'bg-yellow-100 text-yellow-800 border-yellow-200';
            default: return 'bg-gray-100 text-gray-800 border-gray-200';
        }
    },

    openContactModal(bourse = null) {
        this.selectedBourse = bourse;
        this.contactModalOpen = true;
        this.formSuccess = false;
        document.body.style.overflow = 'hidden';

        // Pré-remplir les champs si une bourse est sélectionnée
        this.$nextTick(() => {
            if (bourse) {
                const destinationSelect = document.getElementById('modal-destination');
                if (destinationSelect && bourse.destination) {
                    destinationSelect.value = bourse.destination;
                }
                const projectSelect = document.getElementById('modal-project-type');
                if (projectSelect) {
                    projectSelect.value = 'etudes';
                }
                const messageField = document.getElementById('modal-message');
                if (messageField) {
                    messageField.value = `Je souhaite postuler pour la ${bourse.nom}. Ma moyenne est de ${this.moyenne}/20.`;
                }
            }
        });
    },

    closeContactModal() {
        this.contactModalOpen = false;
        this.selectedBourse = null;
        document.body.style.overflow = '';
    },

    async submitContactForm(event) {
        event.preventDefault();
        this.formLoading = true;

        const form = event.target;
        const formData = new FormData(form);

        // Récupérer le code téléphone
        const phoneCode = document.getElementById('modal-phone-code')?.value || '+226';
        const phone = phoneCode + formData.get('phone');

        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: phone,
            destination: formData.get('destination'),
            project_type: formData.get('project_type'),
            message: formData.get('message')
        };

        try {
            const response = await fetch('/api/contact-requests', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                this.formSuccess = true;
                form.reset();
            } else {
                const result = await response.json();
                alert(result.message || 'Une erreur est survenue. Veuillez réessayer.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue. Veuillez réessayer.');
        } finally {
            this.formLoading = false;
        }
    }
}">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-2xl border-b border-black/[0.08] shadow-sm">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between h-[70px]">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-accent-500 to-accent-600 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-all duration-500"></div>
                        <div class="relative w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-primary-600 via-primary-700 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-all duration-500 shadow-lg">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg sm:text-xl font-display font-extrabold text-dark leading-none">Travel Express</span>
                        <span class="text-[8px] sm:text-[9px] font-sans font-bold text-primary-600 tracking-widest uppercase leading-none mt-0.5 opacity-80">Study Abroad</span>
                    </div>
                </a>

                <!-- Back Button -->
                <a href="/" class="flex items-center space-x-2 px-4 py-2 text-sm font-semibold text-primary-600 hover:text-primary-700 hover:bg-primary-50 rounded-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="hidden sm:inline">Retour à l'accueil</span>
                    <span class="sm:hidden">Retour</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-[90px] sm:pt-[100px] pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <!-- Hero Section -->
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-primary-600 to-accent-600 rounded-2xl shadow-xl shadow-primary-600/30 mb-4 sm:mb-6">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-4xl font-display font-extrabold text-dark mb-3 sm:mb-4">
                    Testez votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-600">éligibilité</span>
                </h1>
                <p class="text-sm sm:text-lg text-gray-600 max-w-2xl mx-auto">
                    Entrez votre moyenne générale pour découvrir les bourses auxquelles vous pouvez prétendre
                </p>
            </div>

            <!-- Calculator Card -->
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 p-4 sm:p-8 mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label for="moyenne" class="block text-sm font-semibold text-gray-700 mb-2">
                            Votre moyenne générale <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="moyenne"
                                x-model="moyenne"
                                @keyup.enter="determinerBourse()"
                                min="0"
                                max="20"
                                step="0.01"
                                placeholder="Ex: 14.5"
                                class="w-full px-4 py-3 sm:py-4 text-base sm:text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all"
                            >
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-semibold">/20</span>
                        </div>
                    </div>
                    <div class="sm:self-end">
                        <button
                            @click="determinerBourse()"
                            class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-accent-600 text-white font-bold rounded-xl hover:shadow-xl hover:shadow-primary-600/30 transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <span>Vérifier</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Result Section -->
            <template x-if="resultat">
                <div
                    class="rounded-2xl sm:rounded-3xl p-4 sm:p-6 mb-6 sm:mb-8 border-2 transition-all duration-300"
                    :class="{
                        'bg-green-50 border-green-200': resultat.color === 'green',
                        'bg-blue-50 border-blue-200': resultat.color === 'blue',
                        'bg-yellow-50 border-yellow-200': resultat.color === 'yellow',
                        'bg-red-50 border-red-200': resultat.color === 'red'
                    }"
                >
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center"
                            :class="{
                                'bg-green-100': resultat.color === 'green',
                                'bg-blue-100': resultat.color === 'blue',
                                'bg-yellow-100': resultat.color === 'yellow',
                                'bg-red-100': resultat.color === 'red'
                            }"
                        >
                            <template x-if="resultat.type">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </template>
                            <template x-if="!resultat.type">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </template>
                        </div>
                        <div class="flex-1">
                            <h3
                                class="text-base sm:text-lg font-bold mb-1"
                                :class="{
                                    'text-green-800': resultat.color === 'green',
                                    'text-blue-800': resultat.color === 'blue',
                                    'text-yellow-800': resultat.color === 'yellow',
                                    'text-red-800': resultat.color === 'red'
                                }"
                            >
                                <span x-show="resultat.type">Éligible à une bourse <span x-text="resultat.type"></span></span>
                                <span x-show="!resultat.type">Non éligible</span>
                            </h3>
                            <p
                                class="text-sm sm:text-base"
                                :class="{
                                    'text-green-700': resultat.color === 'green',
                                    'text-blue-700': resultat.color === 'blue',
                                    'text-yellow-700': resultat.color === 'yellow',
                                    'text-red-700': resultat.color === 'red'
                                }"
                                x-text="resultat.message"
                            ></p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Scholarships List -->
            <template x-if="bourses.length > 0">
                <div>
                    <h2 class="text-lg sm:text-2xl font-display font-bold text-dark mb-4 sm:mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Bourses disponibles pour vous
                    </h2>

                    <div class="grid gap-3 sm:gap-4">
                        <template x-for="(bourse, index) in bourses" :key="index">
                            <div class="bg-white rounded-xl sm:rounded-2xl shadow-md border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-all duration-300 group">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                                    <div class="flex items-center gap-3 sm:gap-4 flex-1">
                                        <div class="text-2xl sm:text-3xl" x-text="bourse.icon"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                                <h3 class="font-bold text-dark text-sm sm:text-base" x-text="bourse.nom"></h3>
                                                <span
                                                    class="px-2 py-0.5 text-[10px] sm:text-xs font-semibold rounded-full border"
                                                    :class="getTypeColor(bourse.type)"
                                                    x-text="bourse.type"
                                                ></span>
                                            </div>
                                            <p class="text-xs sm:text-sm text-gray-600" x-text="bourse.description"></p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                <span class="font-medium">Pays :</span> <span x-text="bourse.pays"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <button
                                        @click="openContactModal(bourse)"
                                        class="w-full sm:w-auto px-4 py-2.5 bg-gradient-to-r from-accent-600 to-accent-500 text-white text-sm font-semibold rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group-hover:shadow-accent-600/30"
                                    >
                                        <span>Postuler</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <!-- Info Section -->
            <div class="mt-8 sm:mt-12 bg-gradient-to-br from-primary-50 to-accent-50 rounded-2xl sm:rounded-3xl p-4 sm:p-8 border border-primary-100">
                <h3 class="text-base sm:text-lg font-bold text-dark mb-3 sm:mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Comment ça marche ?
                </h3>
                <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base text-gray-700">
                    <li class="flex items-start gap-2 sm:gap-3">
                        <span class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-primary-600 text-white rounded-full flex items-center justify-center text-xs font-bold">1</span>
                        <span><strong>16-20/20 :</strong> Bourse complète - 100% des frais couverts</span>
                    </li>
                    <li class="flex items-start gap-2 sm:gap-3">
                        <span class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-primary-600 text-white rounded-full flex items-center justify-center text-xs font-bold">2</span>
                        <span><strong>14-16/20 :</strong> Bourse complète - Excellents résultats</span>
                    </li>
                    <li class="flex items-start gap-2 sm:gap-3">
                        <span class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">3</span>
                        <span><strong>12-14/20 :</strong> Bourse semi-complète - 50% des frais couverts</span>
                    </li>
                    <li class="flex items-start gap-2 sm:gap-3">
                        <span class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center text-xs font-bold">4</span>
                        <span><strong>10-12/20 :</strong> Bourse partielle - Réduction sur les frais</span>
                    </li>
                </ul>
            </div>

            <!-- CTA Section -->
            <div class="mt-8 sm:mt-12 text-center">
                <p class="text-gray-600 mb-4 text-sm sm:text-base">
                    Besoin d'aide pour votre dossier de bourse ?
                </p>
                <button
                    @click="openContactModal(null)"
                    class="inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-accent-600 text-white font-bold rounded-xl hover:shadow-xl hover:shadow-primary-600/30 transform hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>Contactez-nous</span>
                </button>
            </div>
        </div>
    </main>

    <!-- Contact Modal -->
    <div
        x-show="contactModalOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        @click.self="closeContactModal()"
        style="display: none;"
    >
        <div
            x-show="contactModalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto"
        >
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-gray-100 px-4 sm:px-6 py-4 flex items-center justify-between rounded-t-2xl sm:rounded-t-3xl z-10">
                <div>
                    <h3 class="text-lg sm:text-xl font-display font-bold text-dark">Postuler pour une bourse</h3>
                    <p class="text-xs sm:text-sm text-gray-500" x-show="selectedBourse" x-text="selectedBourse?.nom"></p>
                </div>
                <button @click="closeContactModal()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 sm:p-6">
                <!-- Success Message -->
                <div x-show="formSuccess" class="text-center py-8">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-green-500/30">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="text-xl sm:text-2xl font-display font-bold text-gray-900 mb-2">Demande envoyée !</h4>
                    <p class="text-gray-600 mb-6 text-sm sm:text-base">Notre équipe vous contactera sous 24h via WhatsApp ou email.</p>
                    <button @click="closeContactModal()" class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors">
                        Fermer
                    </button>
                </div>

                <!-- Contact Form -->
                <form x-show="!formSuccess" @submit="submitContactForm($event)" class="space-y-4">
                    <!-- Name & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label for="modal-name" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="modal-name" name="name" required placeholder="Votre nom"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm text-gray-900 placeholder-gray-400">
                        </div>
                        <div>
                            <label for="modal-email" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="modal-email" name="email" required placeholder="votre@email.com"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm text-gray-900 placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="modal-phone" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5">
                            WhatsApp / Téléphone <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2" x-data="{
                            open: false,
                            search: '',
                            selectedCode: '+226',
                            selectedIso: 'bf',
                            selectedCountry: 'Burkina Faso',
                            countries: [
                                { code: '+226', country: 'Burkina Faso', iso: 'bf' },
                                { code: '+225', country: 'Côte d\'Ivoire', iso: 'ci' },
                                { code: '+223', country: 'Mali', iso: 'ml' },
                                { code: '+221', country: 'Sénégal', iso: 'sn' },
                                { code: '+228', country: 'Togo', iso: 'tg' },
                                { code: '+229', country: 'Bénin', iso: 'bj' },
                                { code: '+227', country: 'Niger', iso: 'ne' },
                                { code: '+237', country: 'Cameroun', iso: 'cm' },
                                { code: '+33', country: 'France', iso: 'fr' },
                                { code: '+49', country: 'Allemagne', iso: 'de' },
                                { code: '+34', country: 'Espagne', iso: 'es' },
                                { code: '+86', country: 'Chine', iso: 'cn' },
                                { code: '+1', country: 'Canada/USA', iso: 'us' }
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
                                document.getElementById('modal-phone-code').value = c.code;
                            }
                        }">
                            <input type="hidden" id="modal-phone-code" name="phone_code" x-bind:value="selectedCode">

                            <div class="relative">
                                <button type="button" @click="open = !open"
                                        class="flex items-center gap-1.5 w-[100px] sm:w-[120px] px-2 sm:px-3 py-2.5 sm:py-3 bg-gray-50 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-gray-900 text-xs sm:text-sm font-medium hover:bg-gray-100">
                                    <img :src="'https://flagcdn.com/24x18/' + selectedIso + '.png'"
                                         :alt="selectedCountry"
                                         class="w-5 h-[14px] object-cover rounded shadow-sm border border-gray-200"
                                         onerror="this.style.display='none'">
                                    <span class="font-semibold" x-text="selectedCode"></span>
                                    <svg class="w-3 h-3 ml-auto text-gray-400" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                     x-transition
                                     class="absolute z-50 left-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden"
                                     style="display: none;">
                                    <div class="p-2 border-b border-gray-100">
                                        <input type="text" x-model="search" placeholder="Rechercher..."
                                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"
                                               @click.stop>
                                    </div>
                                    <div class="max-h-48 overflow-y-auto">
                                        <template x-for="c in filteredCountries" :key="c.iso">
                                            <button type="button" @click="selectCountry(c)"
                                                    class="flex items-center gap-3 w-full px-3 py-2.5 hover:bg-primary-50 transition-colors text-left"
                                                    :class="{ 'bg-primary-50': selectedIso === c.iso }">
                                                <img :src="'https://flagcdn.com/24x18/' + c.iso + '.png'"
                                                     :alt="c.country"
                                                     class="w-5 h-[14px] object-cover rounded shadow-sm border border-gray-200">
                                                <span class="flex-1 text-sm text-gray-700" x-text="c.country"></span>
                                                <span class="text-sm font-semibold text-gray-500" x-text="c.code"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <input type="tel" id="modal-phone" name="phone" required placeholder="65 60 45 92"
                                   class="flex-1 min-w-0 px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm text-gray-900 placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Destination & Project Type -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label for="modal-destination" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5">
                                Destination <span class="text-red-500">*</span>
                            </label>
                            <select id="modal-destination" name="destination" required
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm text-gray-900">
                                <option value="">Choisir...</option>
                                <option value="china">🇨🇳 Chine</option>
                                <option value="germany">🇩🇪 Allemagne</option>
                                <option value="spain">🇪🇸 Espagne</option>
                                <option value="other">🌍 Autre</option>
                            </select>
                        </div>
                        <div>
                            <label for="modal-project-type" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5">
                                Type de projet <span class="text-red-500">*</span>
                            </label>
                            <select id="modal-project-type" name="project_type" required
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm text-gray-900">
                                <option value="">Choisir...</option>
                                <option value="etudes">📚 Études</option>
                                <option value="travail">💼 Travail</option>
                                <option value="business">🏢 Business</option>
                                <option value="autre">📋 Autre</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="modal-message" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5">
                            Votre message
                        </label>
                        <textarea id="modal-message" name="message" rows="3"
                                  placeholder="Décrivez brièvement votre projet..."
                                  class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all text-sm text-gray-900 placeholder-gray-400 resize-none"></textarea>
                    </div>

                    <!-- Consent -->
                    <div class="flex items-start gap-2 sm:gap-3">
                        <input type="checkbox" id="modal-consent" name="consent" required
                               class="mt-0.5 w-4 h-4 text-primary-600 bg-gray-50 border-0 rounded focus:ring-primary-500 flex-shrink-0">
                        <label for="modal-consent" class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                            J'accepte d'être contacté(e) par Travel Express. <span class="text-red-500">*</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            :disabled="formLoading"
                            class="w-full py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-accent-600 text-white font-bold text-sm sm:text-base rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-xl hover:shadow-primary-500/40 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:scale-100">
                        <span x-show="!formLoading">Envoyer ma demande</span>
                        <svg x-show="!formLoading" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <svg x-show="formLoading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-show="formLoading">Envoi en cours...</span>
                    </button>

                    <!-- Trust badges -->
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 pt-2">
                        <div class="flex items-center gap-1.5 text-gray-500 text-[10px] sm:text-xs">
                            <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Sécurisé</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-gray-500 text-[10px] sm:text-xs">
                            <svg class="w-3.5 h-3.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Réponse 24h</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-gray-500 text-[10px] sm:text-xs">
                            <svg class="w-3.5 h-3.5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Gratuit</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-sm text-gray-600">
                &copy; 2024 Travel Express Burkina Faso. Tous droits réservés.
            </p>
        </div>
    </footer>
</body>
</html>

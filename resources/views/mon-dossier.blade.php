<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Dossier - Travel Express</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .font-display { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="antialiased min-h-screen" x-data="dossierApp()" x-init="init()">

    <!-- Header -->
    <header class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-indigo-300/50 transition-all">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900 font-display">Travel Express</h1>
                    <p class="text-xs text-indigo-600 font-semibold uppercase tracking-wider">Mon Dossier</p>
                </div>
            </a>
            <a href="/" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                Retour au site
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">

        <!-- Loading State -->
        <div x-show="loading" class="text-center py-20">
            <div class="inline-block w-12 h-12 border-4 border-indigo-100 border-t-indigo-600 rounded-full animate-spin"></div>
            <p class="mt-4 text-gray-500">Chargement de votre dossier...</p>
        </div>

        <!-- Not Logged In -->
        <div x-show="!loading && !isLoggedIn" class="text-center py-20">
            <div class="w-20 h-20 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 font-display mb-2">Connexion requise</h2>
            <p class="text-gray-500 mb-6">Connectez-vous pour acceder a votre dossier.</p>
            <a href="/login" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                Se connecter
            </a>
        </div>

        <!-- No Dossier Found -->
        <div x-show="!loading && isLoggedIn && applications.length === 0" class="text-center py-20">
            <div class="w-20 h-20 mx-auto bg-indigo-50 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 font-display mb-2">Aucun dossier trouve</h2>
            <p class="text-gray-500 mb-2">Aucun dossier n'est associe a votre adresse email.</p>
            <p class="text-sm text-gray-400" x-text="'Email : ' + userEmail"></p>
        </div>

        <!-- Dossier Content -->
        <template x-if="!loading && isLoggedIn && applications.length > 0">
            <div class="space-y-6">
                <template x-for="app in applications" :key="app.id">
                    <div class="space-y-6">
                        <!-- Application Header -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div>
                                        <h2 class="text-xl font-bold text-white font-display" x-text="app.student_name"></h2>
                                        <p class="text-indigo-200 text-sm mt-1" x-text="app.student_email"></p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider"
                                              :class="{
                                                  'bg-yellow-400/20 text-yellow-200': app.status === 'pending',
                                                  'bg-orange-400/20 text-orange-200': app.status === 'incomplete',
                                                  'bg-blue-400/20 text-blue-200': app.status === 'complete',
                                                  'bg-green-400/20 text-green-200': app.status === 'approved',
                                                  'bg-red-400/20 text-red-200': app.status === 'rejected'
                                              }"
                                              x-text="app.status_info.label">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Grid -->
                            <div class="p-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Programme</p>
                                    <p class="text-sm font-bold text-gray-900 mt-1 capitalize" x-text="app.program_type || '-'"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Etape</p>
                                    <p class="text-sm font-bold text-gray-900 mt-1" x-text="app.current_step_label"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Universite</p>
                                    <p class="text-sm font-bold text-gray-900 mt-1" x-text="app.university_name || '-'"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Cree le</p>
                                    <p class="text-sm font-bold text-gray-900 mt-1" x-text="app.created_at"></p>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="px-6 pb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-gray-500">Progression dossier initial</span>
                                    <span class="text-xs font-bold text-indigo-600" x-text="app.completion_percentage + '%'"></span>
                                </div>
                                <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-500"
                                         :style="'width: ' + app.completion_percentage + '%'"></div>
                                </div>

                                <!-- Complementary Progress -->
                                <template x-if="app.complementary_status && app.complementary_status !== 'not_started'">
                                    <div class="mt-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-semibold text-gray-500">Progression dossier complementaire</span>
                                            <span class="text-xs font-bold text-purple-600" x-text="app.complementary_completion_percentage + '%'"></span>
                                        </div>
                                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-500"
                                                 :style="'width: ' + app.complementary_completion_percentage + '%'"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 font-display">Documents enregistres</h3>
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full" x-text="app.documents.length + ' fichier(s)'"></span>
                            </div>

                            <!-- No Documents -->
                            <div x-show="app.documents.length === 0" class="p-8 text-center">
                                <p class="text-gray-400">Aucun document enregistre pour le moment.</p>
                            </div>

                            <!-- Documents List -->
                            <div x-show="app.documents.length > 0" class="divide-y divide-gray-50">
                                <template x-for="doc in app.documents" :key="doc.id">
                                    <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                                        <!-- File Icon -->
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                             :class="{
                                                 'bg-green-50': doc.status === 'approved',
                                                 'bg-red-50': doc.status === 'rejected',
                                                 'bg-gray-50': doc.status === 'pending'
                                             }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 :class="{
                                                     'text-green-500': doc.status === 'approved',
                                                     'text-red-500': doc.status === 'rejected',
                                                     'text-gray-400': doc.status === 'pending'
                                                 }">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>

                                        <!-- Document Info -->
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate" x-text="formatDocType(doc.document_type)"></p>
                                            <p class="text-xs text-gray-400 mt-0.5">
                                                <span x-text="doc.original_filename"></span>
                                                <span class="mx-1">&middot;</span>
                                                <span x-text="doc.file_size_human"></span>
                                                <span class="mx-1">&middot;</span>
                                                <span x-text="doc.uploaded_at"></span>
                                            </p>
                                            <template x-if="doc.rejection_reason">
                                                <p class="text-xs text-red-500 mt-1" x-text="'Motif : ' + doc.rejection_reason"></p>
                                            </template>
                                        </div>

                                        <!-- Status Badge -->
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold flex-shrink-0"
                                              :class="{
                                                  'bg-green-50 text-green-700': doc.status === 'approved',
                                                  'bg-red-50 text-red-700': doc.status === 'rejected',
                                                  'bg-gray-100 text-gray-500': doc.status === 'pending'
                                              }"
                                              x-text="doc.status === 'approved' ? 'Approuve' : doc.status === 'rejected' ? 'Rejete' : 'En attente'">
                                        </span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>

        <!-- Error State -->
        <div x-show="error" class="text-center py-20">
            <div class="w-20 h-20 mx-auto bg-red-50 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 font-display mb-2">Erreur</h2>
            <p class="text-gray-500" x-text="error"></p>
        </div>
    </main>

    <script>
        function dossierApp() {
            return {
                loading: true,
                isLoggedIn: false,
                userEmail: '',
                applications: [],
                error: null,

                async init() {
                    const token = localStorage.getItem('auth_token');
                    if (!token) {
                        this.loading = false;
                        this.isLoggedIn = false;
                        return;
                    }

                    try {
                        const response = await fetch('/api/my-dossier', {
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + token
                            }
                        });

                        if (response.status === 401) {
                            this.loading = false;
                            this.isLoggedIn = false;
                            return;
                        }

                        if (!response.ok) {
                            throw new Error('Erreur lors du chargement');
                        }

                        const data = await response.json();
                        this.isLoggedIn = true;
                        this.applications = data.data || [];

                        // Get user email from localStorage
                        const userData = localStorage.getItem('user');
                        if (userData) {
                            this.userEmail = JSON.parse(userData).email || '';
                        }
                    } catch (err) {
                        this.error = err.message;
                    } finally {
                        this.loading = false;
                    }
                },

                formatDocType(type) {
                    const labels = {
                        'photo_identite': 'Photo d\'identite',
                        'passeport': 'Passeport',
                        'diplome_attestation': 'Diplome / Attestation',
                        'releve_notes': 'Releve de notes',
                        'casier_judiciaire': 'Casier judiciaire',
                        'visite_medicale': 'Visite medicale',
                        'dernier_bulletin': 'Dernier bulletin',
                        'formulaire_candidature': 'Formulaire de candidature',
                        'carte_identite_parent': 'Carte d\'identite parent',
                        'certificat_anglais': 'Certificat d\'anglais',
                        'test_csca': 'Test CSCA',
                        'plan_etude': 'Plan d\'etude',
                        'lettre_motivation': 'Lettre de motivation',
                        'capacite_financiere': 'Capacite financiere',
                        'visa_chinois': 'Visa chinois',
                        'bilan_sante_chinois': 'Bilan de sante chinois',
                        'casier_judiciaire_chinois': 'Casier judiciaire chinois',
                        'passeport_complet': 'Passeport complet',
                        'certificat_langue': 'Certificat de langue',
                        'certificat_etude_chinois': 'Certificat d\'etude chinois',
                        'formulaire_inscription': 'Formulaire d\'inscription'
                    };
                    return labels[type] || type.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                }
            };
        }
    </script>
</body>
</html>

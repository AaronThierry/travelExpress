@extends('admin.layout')

@section('title', 'Gestion des Dossiers Étudiants')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900 p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-amber-200 via-yellow-400 to-amber-200 bg-clip-text text-transparent">
                Gestion des Dossiers Étudiants
            </h1>
            <p class="text-gray-400 mt-1">Vue unifiée des dossiers initiaux et complémentaires</p>
        </div>
        <button onclick="showCreateModal()" class="group relative px-6 py-3 bg-gradient-to-r from-amber-500 to-yellow-600 text-black font-bold rounded-xl hover:from-amber-400 hover:to-yellow-500 transition-all duration-300 shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40 flex items-center gap-2">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau Dossier
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8" id="stats-container">
        <div class="animate-pulse bg-gray-800/50 rounded-2xl p-6 h-32"></div>
        <div class="animate-pulse bg-gray-800/50 rounded-2xl p-6 h-32"></div>
        <div class="animate-pulse bg-gray-800/50 rounded-2xl p-6 h-32"></div>
        <div class="animate-pulse bg-gray-800/50 rounded-2xl p-6 h-32"></div>
        <div class="animate-pulse bg-gray-800/50 rounded-2xl p-6 h-32"></div>
        <div class="animate-pulse bg-gray-800/50 rounded-2xl p-6 h-32"></div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800/40 backdrop-blur-sm border border-amber-500/20 rounded-2xl p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
            <!-- Statut Dossier Initial -->
            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Statut Initial</label>
                <select id="filter-status" onchange="loadApplications()" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    <option value="all">Tous</option>
                    <option value="pending">En attente</option>
                    <option value="incomplete">Incomplet</option>
                    <option value="complete">Complet</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>

            <!-- Statut Complémentaire -->
            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Statut Complémentaire</label>
                <select id="filter-complementary" onchange="loadApplications()" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    <option value="all">Tous</option>
                    <option value="not_started">Non démarré</option>
                    <option value="in_progress">En cours</option>
                    <option value="submitted">Soumis</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>

            <!-- Programme -->
            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Programme</label>
                <select id="filter-program" onchange="loadApplications()" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    <option value="all">Tous</option>
                    <option value="license">Licence</option>
                    <option value="master">Master</option>
                </select>
            </div>

            <!-- Étape -->
            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Étape</label>
                <select id="filter-step" onchange="loadApplications()" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    <option value="all">Toutes</option>
                    <option value="1">Dossier Initial</option>
                    <option value="2">Complémentaire</option>
                    <option value="3">Finalisation</option>
                </select>
            </div>

            <!-- Recherche -->
            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Recherche</label>
                <div class="relative">
                    <input type="text" id="search" placeholder="Nom, email, université..." onkeyup="debounceSearch()" class="w-full px-4 py-3 pl-10 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    <svg class="w-5 h-5 text-amber-500/50 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Tri -->
            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Tri</label>
                <select id="sort-by" onchange="loadApplications()" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    <option value="created_at">Date création</option>
                    <option value="submitted_at">Date soumission</option>
                    <option value="student_name">Nom</option>
                    <option value="current_step">Étape</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Applications Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6" id="applications-container">
        <!-- Applications will be loaded here -->
    </div>

    <!-- Pagination -->
    <div id="pagination-container" class="mt-8 flex justify-center"></div>
</div>

<!-- Create Modal -->
<div id="create-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-amber-500/30 rounded-2xl max-w-lg w-full p-8 shadow-2xl shadow-amber-500/10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-amber-400">Nouveau Dossier</h2>
            <button onclick="closeCreateModal()" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="create-form" onsubmit="createApplication(event)" class="space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-amber-400 mb-2">Type de dossier *</label>
                    <select name="dossier_type" required class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                        <option value="nouveau">Dossier Initial (Nouveau)</option>
                        <option value="complementaire">Dossier Complémentaire</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-amber-400 mb-2">Programme *</label>
                    <select name="program_type" required class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                        <option value="">Sélectionnez</option>
                        <option value="license">Licence</option>
                        <option value="master">Master</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Nom complet (optionnel)</label>
                <input type="text" name="student_name" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500" placeholder="Sera rempli par l'étudiant">
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Email (optionnel)</label>
                <input type="email" name="student_email" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500" placeholder="Sera rempli par l'étudiant">
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Téléphone (optionnel)</label>
                <input type="text" name="student_phone" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500" placeholder="Sera rempli par l'étudiant">
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Validité du lien (jours)</label>
                <select name="expires_in_days" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    <option value="30">30 jours</option>
                    <option value="60">60 jours</option>
                    <option value="90">90 jours</option>
                    <option value="180">6 mois</option>
                    <option value="365">1 an</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-amber-500 to-yellow-600 text-black font-bold rounded-xl hover:from-amber-400 hover:to-yellow-500 transition-all">
                    Créer & Générer Lien
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-6 py-3 bg-gray-700 text-gray-300 rounded-xl hover:bg-gray-600 transition-all">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Link Modal -->
<div id="link-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-amber-500/30 rounded-2xl max-w-2xl w-full p-8 shadow-2xl shadow-amber-500/10">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-r from-amber-500 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-amber-400">Dossier créé avec succès!</h2>
            <p class="text-gray-400 mt-2">Envoyez ce lien à l'étudiant pour qu'il puisse remplir son dossier</p>
        </div>

        <div class="space-y-4">
            <!-- Student Form URL -->
            <div class="bg-gray-900/80 border border-amber-500/20 rounded-xl p-4">
                <label class="block text-sm font-medium text-amber-400 mb-2">Lien du formulaire étudiant</label>
                <div class="flex items-center gap-2">
                    <input type="text" id="student-form-url" readonly class="flex-1 px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg font-mono text-sm text-amber-400">
                    <button onclick="copyStudentFormUrl()" class="px-4 py-3 bg-gradient-to-r from-amber-500 to-yellow-600 text-black font-bold rounded-lg hover:from-amber-400 hover:to-yellow-500 transition-all whitespace-nowrap">
                        Copier
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-2" id="link-expiry-info">Expire le: --</p>
            </div>

            <!-- Instructions -->
            <div class="bg-blue-900/20 border border-blue-500/30 rounded-xl p-4">
                <h4 class="text-sm font-medium text-blue-400 mb-2">Instructions</h4>
                <ul class="text-sm text-gray-400 space-y-1">
                    <li>1. Copiez le lien ci-dessus</li>
                    <li>2. Envoyez-le à l'étudiant par email ou WhatsApp</li>
                    <li>3. L'étudiant pourra remplir ses informations et uploader ses documents</li>
                    <li>4. Vous recevrez une notification quand le dossier sera soumis</li>
                </ul>
            </div>
        </div>

        <button onclick="closeLinkModal()" class="w-full mt-6 px-6 py-3 bg-gray-700 text-gray-300 rounded-xl hover:bg-gray-600 transition-all">
            Fermer
        </button>
    </div>
</div>

<!-- Details Modal -->
<div id="details-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 overflow-y-auto">
    <div class="min-h-screen py-8 px-4 flex items-start justify-center">
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-amber-500/30 rounded-2xl max-w-5xl w-full shadow-2xl shadow-amber-500/10">
            <div class="sticky top-0 bg-gray-900/95 backdrop-blur-sm border-b border-amber-500/20 rounded-t-2xl px-8 py-6 flex justify-between items-center z-10">
                <h2 class="text-2xl font-bold text-amber-400">Détails du Dossier</h2>
                <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-white transition-colors p-2 hover:bg-gray-700 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="details-content" class="p-8">
                <!-- Content loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Complementary Edit Modal -->
<div id="complementary-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-amber-500/30 rounded-2xl max-w-2xl w-full p-8 my-8 shadow-2xl shadow-amber-500/10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-amber-400">Dossier Complémentaire</h2>
            <button onclick="closeComplementaryModal()" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="complementary-form" onsubmit="saveComplementary(event)" class="space-y-5">
            <input type="hidden" name="application_id" id="comp-app-id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-amber-400 mb-2">Visa actuel</label>
                    <input type="text" name="visa_current" id="comp-visa" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50" placeholder="Type de visa">
                </div>

                <div>
                    <label class="block text-sm font-medium text-amber-400 mb-2">Numéro chinois</label>
                    <input type="text" name="numero_chinois" id="comp-numero" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50" placeholder="+86 ...">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-amber-400 mb-2">Université</label>
                    <input type="text" name="university_name" id="comp-university" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50" placeholder="Nom de l'université">
                </div>

                <div>
                    <label class="block text-sm font-medium text-amber-400 mb-2">Filière</label>
                    <input type="text" name="field_of_study" id="comp-field" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50" placeholder="Ex: Informatique">
                </div>
            </div>

            <div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="casier_judiciaire_valide" id="comp-casier" class="w-5 h-5 rounded border-amber-500/30 bg-gray-900 text-amber-500 focus:ring-amber-500/50">
                    <span class="text-white">Casier judiciaire validé</span>
                </label>
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Informations complémentaires</label>
                <textarea name="complement_application" id="comp-notes" rows="3" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-amber-500/50" placeholder="Notes additionnelles..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-amber-400 mb-2">Statut complémentaire</label>
                <select name="complementary_status" id="comp-status" class="w-full px-4 py-3 bg-gray-900/80 border border-amber-500/30 rounded-xl text-white focus:ring-2 focus:ring-amber-500/50">
                    <option value="not_started">Non démarré</option>
                    <option value="in_progress">En cours</option>
                    <option value="submitted">Soumis</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-amber-500 to-yellow-600 text-black font-bold rounded-xl hover:from-amber-400 hover:to-yellow-500 transition-all">
                    Enregistrer
                </button>
                <button type="button" onclick="closeComplementaryModal()" class="px-6 py-3 bg-gray-700 text-gray-300 rounded-xl hover:bg-gray-600 transition-all">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div id="preview-modal" class="hidden fixed inset-0 bg-black/95 z-50 flex items-center justify-center p-4">
    <div class="relative w-full h-full max-w-6xl max-h-[90vh] bg-gray-900 rounded-2xl overflow-hidden border border-amber-500/30">
        <div class="absolute top-4 right-4 z-10">
            <button onclick="closePreview()" class="bg-gray-800 hover:bg-gray-700 text-white rounded-full p-3 shadow-lg transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="preview-content" class="w-full h-full flex items-center justify-center">
            <!-- Preview content -->
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="hidden fixed bottom-6 right-6 bg-gray-800 border border-amber-500/30 rounded-xl px-6 py-4 shadow-2xl z-50 flex items-center gap-3">
    <span id="toast-message" class="text-white"></span>
</div>

<script>
    let currentPage = 1;
    let searchTimeout;
    const authToken = window.authToken || localStorage.getItem('auth_token');

    document.addEventListener('DOMContentLoaded', () => {
        loadStats();
        loadApplications();
    });

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = message;
        toast.classList.remove('hidden');
        toast.classList.add(type === 'success' ? 'border-green-500/50' : 'border-red-500/50');
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('border-green-500/50', 'border-red-500/50');
        }, 3000);
    }

    function debounceSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentPage = 1;
            loadApplications();
        }, 500);
    }

    async function loadStats() {
        try {
            const response = await fetch('/admin/api/student-applications/stats', {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const stats = await response.json();

            document.getElementById('stats-container').innerHTML = `
                <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 border border-amber-500/20 rounded-2xl p-5 hover:border-amber-500/40 transition-all group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-amber-500/20 rounded-xl flex items-center justify-center group-hover:bg-amber-500/30 transition-all">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">${stats.total}</div>
                    <div class="text-sm text-gray-400">Total Dossiers</div>
                </div>

                <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 border border-blue-500/20 rounded-2xl p-5 hover:border-blue-500/40 transition-all group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center group-hover:bg-blue-500/30 transition-all">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">${stats.step_1}</div>
                    <div class="text-sm text-gray-400">Étape 1 - Initial</div>
                </div>

                <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 border border-purple-500/20 rounded-2xl p-5 hover:border-purple-500/40 transition-all group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center group-hover:bg-purple-500/30 transition-all">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">${stats.step_2}</div>
                    <div class="text-sm text-gray-400">Étape 2 - Complémentaire</div>
                </div>

                <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 border border-green-500/20 rounded-2xl p-5 hover:border-green-500/40 transition-all group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center group-hover:bg-green-500/30 transition-all">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">${stats.approved}</div>
                    <div class="text-sm text-gray-400">Approuvés</div>
                </div>

                <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 border border-emerald-500/20 rounded-2xl p-5 hover:border-emerald-500/40 transition-all group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center group-hover:bg-emerald-500/30 transition-all">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">${stats.fully_complete}</div>
                    <div class="text-sm text-gray-400">100% Complets</div>
                </div>

                <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 border border-yellow-500/20 rounded-2xl p-5 hover:border-yellow-500/40 transition-all group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center group-hover:bg-yellow-500/30 transition-all">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">${stats.incomplete}</div>
                    <div class="text-sm text-gray-400">Incomplets</div>
                </div>
            `;
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }

    async function loadApplications() {
        const status = document.getElementById('filter-status').value;
        const compStatus = document.getElementById('filter-complementary').value;
        const program = document.getElementById('filter-program').value;
        const step = document.getElementById('filter-step').value;
        const search = document.getElementById('search').value;
        const sortBy = document.getElementById('sort-by').value;

        const params = new URLSearchParams({
            page: currentPage,
            status: status,
            complementary_status: compStatus,
            program_type: program,
            current_step: step,
            search: search,
            sort_by: sortBy,
            sort_order: 'desc'
        });

        try {
            const response = await fetch(`/admin/api/student-applications?${params}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            const container = document.getElementById('applications-container');

            if (data.data.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-16">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-400">Aucun dossier trouvé</h3>
                        <p class="text-gray-500 mt-2">Modifiez vos filtres ou créez un nouveau dossier</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = data.data.map(app => renderApplicationCard(app)).join('');

            // Render pagination
            renderPagination(data);
        } catch (error) {
            console.error('Error loading applications:', error);
        }
    }

    function renderApplicationCard(app) {
        const statusColors = {
            'pending': 'bg-gray-500/20 text-gray-300 border-gray-500/30',
            'incomplete': 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30',
            'complete': 'bg-blue-500/20 text-blue-300 border-blue-500/30',
            'approved': 'bg-green-500/20 text-green-300 border-green-500/30',
            'rejected': 'bg-red-500/20 text-red-300 border-red-500/30'
        };

        const compStatusColors = {
            'not_started': 'bg-gray-500/20 text-gray-300',
            'in_progress': 'bg-blue-500/20 text-blue-300',
            'submitted': 'bg-yellow-500/20 text-yellow-300',
            'approved': 'bg-green-500/20 text-green-300',
            'rejected': 'bg-red-500/20 text-red-300'
        };

        const statusInfo = app.status_info || { label: app.status, color: 'gray' };
        const compStatusInfo = app.complementary_status_info || { label: 'Non démarré', color: 'gray' };

        return `
            <div class="bg-gradient-to-br from-gray-800/60 to-gray-900/60 border border-amber-500/20 rounded-2xl overflow-hidden hover:border-amber-500/40 transition-all group">
                <!-- Header -->
                <div class="p-5 border-b border-gray-700/50">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors">${app.student_name}</h3>
                            <p class="text-sm text-gray-400">${app.student_email}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold rounded-full ${app.program_type === 'master' ? 'bg-purple-500/20 text-purple-300' : 'bg-blue-500/20 text-blue-300'}">
                            ${app.program_type === 'master' ? 'Master' : 'Licence'}
                        </span>
                    </div>

                    <!-- Step Indicator -->
                    <div class="flex items-center gap-2 mt-4">
                        <div class="flex-1 flex items-center">
                            <div class="w-8 h-8 rounded-full ${app.current_step >= 1 ? 'bg-amber-500 text-black' : 'bg-gray-700 text-gray-400'} flex items-center justify-center text-sm font-bold">1</div>
                            <div class="flex-1 h-1 mx-1 ${app.current_step >= 2 ? 'bg-amber-500' : 'bg-gray-700'}"></div>
                            <div class="w-8 h-8 rounded-full ${app.current_step >= 2 ? 'bg-amber-500 text-black' : 'bg-gray-700 text-gray-400'} flex items-center justify-center text-sm font-bold">2</div>
                            <div class="flex-1 h-1 mx-1 ${app.current_step >= 3 ? 'bg-amber-500' : 'bg-gray-700'}"></div>
                            <div class="w-8 h-8 rounded-full ${app.current_step >= 3 ? 'bg-amber-500 text-black' : 'bg-gray-700 text-gray-400'} flex items-center justify-center text-sm font-bold">3</div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 text-center mt-2">${app.current_step_label || 'Étape ' + app.current_step}</p>
                </div>

                <!-- Progress Bars -->
                <div class="p-5 space-y-4">
                    <!-- Initial Dossier Progress -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-400">Dossier Initial</span>
                            <span class="text-sm font-bold text-amber-400">${app.completion_percentage || 0}%</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-amber-500 to-yellow-500 rounded-full transition-all duration-500" style="width: ${app.completion_percentage || 0}%"></div>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="px-2 py-0.5 text-xs font-medium rounded ${statusColors[app.status] || statusColors.pending}">${statusInfo.label}</span>
                        </div>
                    </div>

                    <!-- Complementary Dossier Progress -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-400">Dossier Complémentaire</span>
                            <span class="text-sm font-bold text-purple-400">${app.complementary_completion_percentage || 0}%</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-500" style="width: ${app.complementary_completion_percentage || 0}%"></div>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="px-2 py-0.5 text-xs font-medium rounded ${compStatusColors[app.complementary_status] || compStatusColors.not_started}">${compStatusInfo.label}</span>
                        </div>
                    </div>

                    <!-- Overall Progress -->
                    <div class="pt-3 border-t border-gray-700/50">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-white">Progression Globale</span>
                            <span class="text-sm font-bold text-emerald-400">${app.overall_completion_percentage || 0}%</span>
                        </div>
                        <div class="h-3 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transition-all duration-500" style="width: ${app.overall_completion_percentage || 0}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-5 py-4 bg-gray-900/50 border-t border-gray-700/50 flex flex-wrap gap-2">
                    <button onclick="viewDetails(${app.id})" class="flex-1 px-3 py-2 bg-amber-500/20 text-amber-400 rounded-lg hover:bg-amber-500/30 transition-all text-sm font-medium">
                        Détails
                    </button>
                    <button onclick="editComplementary(${app.id})" class="flex-1 px-3 py-2 bg-purple-500/20 text-purple-400 rounded-lg hover:bg-purple-500/30 transition-all text-sm font-medium">
                        Complémentaire
                    </button>
                    <button onclick="showLinkForApp(${app.id}, '${app.student_form_url || app.upload_link}')" class="px-3 py-2 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/30 transition-all text-sm" title="Voir/Copier lien étudiant">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </button>
                    <button onclick="deleteApplication(${app.id})" class="px-3 py-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition-all text-sm" title="Supprimer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        `;
    }

    function renderPagination(data) {
        if (data.last_page <= 1) {
            document.getElementById('pagination-container').innerHTML = '';
            return;
        }

        let html = '<div class="flex items-center gap-2">';

        if (data.current_page > 1) {
            html += `<button onclick="goToPage(${data.current_page - 1})" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-all">Précédent</button>`;
        }

        for (let i = 1; i <= data.last_page; i++) {
            if (i === data.current_page) {
                html += `<button class="px-4 py-2 bg-amber-500 text-black font-bold rounded-lg">${i}</button>`;
            } else if (i === 1 || i === data.last_page || (i >= data.current_page - 2 && i <= data.current_page + 2)) {
                html += `<button onclick="goToPage(${i})" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-all">${i}</button>`;
            } else if (i === data.current_page - 3 || i === data.current_page + 3) {
                html += `<span class="px-2 text-gray-500">...</span>`;
            }
        }

        if (data.current_page < data.last_page) {
            html += `<button onclick="goToPage(${data.current_page + 1})" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-all">Suivant</button>`;
        }

        html += '</div>';
        document.getElementById('pagination-container').innerHTML = html;
    }

    function goToPage(page) {
        currentPage = page;
        loadApplications();
    }

    // Modal Functions
    function showCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
        document.getElementById('create-form').reset();
    }

    async function createApplication(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('/admin/api/student-applications', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                closeCreateModal();
                // Show the student form URL
                document.getElementById('student-form-url').value = result.student_form_url || result.upload_link;
                document.getElementById('link-expiry-info').textContent = result.token_expires_at ? `Expire le: ${result.token_expires_at}` : 'Lien permanent';
                document.getElementById('link-modal').classList.remove('hidden');
                loadStats();
                loadApplications();
                showToast('Dossier créé avec succès');
            } else {
                showToast(result.message || 'Erreur lors de la création', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Une erreur est survenue', 'error');
        }
    }

    function closeLinkModal() {
        document.getElementById('link-modal').classList.add('hidden');
    }

    function copyStudentFormUrl() {
        const link = document.getElementById('student-form-url');
        link.select();
        navigator.clipboard.writeText(link.value).then(() => {
            showToast('Lien copié dans le presse-papier!');
        }).catch(() => {
            document.execCommand('copy');
            showToast('Lien copié!');
        });
    }

    function copyUploadLink(link) {
        navigator.clipboard.writeText(link).then(() => {
            showToast('Lien copié!');
        });
    }

    async function regenerateToken(appId) {
        if (!confirm('Régénérer le lien invalidera l\'ancien. Continuer?')) return;

        try {
            const response = await fetch(`/admin/api/student-applications/${appId}/regenerate-token`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ expires_in_days: 30 })
            });

            const result = await response.json();

            if (response.ok) {
                document.getElementById('student-form-url').value = result.data.student_form_url;
                document.getElementById('link-expiry-info').textContent = `Expire le: ${result.data.expires_at}`;
                document.getElementById('link-modal').classList.remove('hidden');
                showToast('Nouveau lien généré!');
            } else {
                showToast('Erreur lors de la régénération', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Une erreur est survenue', 'error');
        }
    }

    async function viewDetails(id) {
        try {
            const response = await fetch(`/admin/api/student-applications/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            const app = data.application;
            const docs = data.required_documents;
            const compDocs = data.complementary_documents;
            const visaDocs = data.visa_documents || {};

            const statusColors = {
                'pending': 'bg-gray-500/20 text-gray-300',
                'incomplete': 'bg-yellow-500/20 text-yellow-300',
                'complete': 'bg-blue-500/20 text-blue-300',
                'approved': 'bg-green-500/20 text-green-300',
                'rejected': 'bg-red-500/20 text-red-300'
            };

            const content = `
                <div class="space-y-8">
                    <!-- Student Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Nom</label>
                            <div class="text-white font-medium mt-1">${app.student_name}</div>
                        </div>
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Email</label>
                            <div class="text-white font-medium mt-1">${app.student_email}</div>
                        </div>
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Programme</label>
                            <div class="text-white font-medium mt-1">${app.program_type === 'master' ? 'Master' : 'Licence'}</div>
                        </div>
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Étape actuelle</label>
                            <div class="text-amber-400 font-medium mt-1">${data.current_step_label}</div>
                        </div>
                    </div>

                    ${app.university_name || app.numero_chinois ? `
                    <!-- Complementary Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        ${app.university_name ? `<div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Université</label>
                            <div class="text-white font-medium mt-1">${app.university_name}</div>
                        </div>` : ''}
                        ${app.field_of_study ? `<div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Filière</label>
                            <div class="text-white font-medium mt-1">${app.field_of_study}</div>
                        </div>` : ''}
                        ${app.visa_current ? `<div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">Visa</label>
                            <div class="text-white font-medium mt-1">${app.visa_current}</div>
                        </div>` : ''}
                        ${app.numero_chinois ? `<div class="bg-gray-800/50 rounded-xl p-4">
                            <label class="text-xs text-gray-500 uppercase tracking-wide">N° Chinois</label>
                            <div class="text-white font-medium mt-1">${app.numero_chinois}</div>
                        </div>` : ''}
                    </div>
                    ` : ''}

                    <!-- Initial Documents -->
                    <div>
                        <h3 class="text-lg font-bold text-amber-400 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Documents Initiaux (${data.initial_docs.length})
                        </h3>
                        <div class="space-y-2">
                            ${data.initial_docs.length > 0 ? data.initial_docs.map(doc => `
                                <div class="flex items-center justify-between p-4 bg-gray-800/50 rounded-xl border border-gray-700/50 hover:border-amber-500/30 transition-all">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">${docs[doc.document_type] || doc.document_type}</div>
                                        <div class="text-sm text-gray-500">${doc.original_filename} (${doc.file_size_human})</div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full ${statusColors[doc.status]}">${doc.status}</span>
                                        <button onclick="previewDocument(${doc.id})" class="text-purple-400 hover:text-purple-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        <a href="/document/${doc.id}/download" class="text-amber-400 hover:text-amber-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            `).join('') : '<p class="text-gray-500 text-center py-4">Aucun document initial uploadé</p>'}
                        </div>
                    </div>

                    <!-- Complementary Documents -->
                    <div>
                        <h3 class="text-lg font-bold text-purple-400 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Documents Complémentaires (${data.complementary_docs.length})
                        </h3>
                        <div class="space-y-2">
                            ${data.complementary_docs.length > 0 ? data.complementary_docs.map(doc => `
                                <div class="flex items-center justify-between p-4 bg-gray-800/50 rounded-xl border border-gray-700/50 hover:border-purple-500/30 transition-all">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">${compDocs[doc.document_type] || doc.document_type}</div>
                                        <div class="text-sm text-gray-500">${doc.original_filename} (${doc.file_size_human})</div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full ${statusColors[doc.status]}">${doc.status}</span>
                                        <button onclick="previewDocument(${doc.id})" class="text-purple-400 hover:text-purple-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        <a href="/document/${doc.id}/download" class="text-amber-400 hover:text-amber-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            `).join('') : '<p class="text-gray-500 text-center py-4">Aucun document complémentaire uploadé</p>'}
                        </div>
                    </div>

                    <!-- Visa Documents -->
                    <div>
                        <h3 class="text-lg font-bold text-blue-400 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Documents Visa (${data.visa_docs ? data.visa_docs.length : 0})
                        </h3>
                        <div class="space-y-2">
                            ${data.visa_docs && data.visa_docs.length > 0 ? data.visa_docs.map(doc => `
                                <div class="flex items-center justify-between p-4 bg-gray-800/50 rounded-xl border border-gray-700/50 hover:border-blue-500/30 transition-all">
                                    <div class="flex-1">
                                        <div class="font-medium text-white">${visaDocs[doc.document_type] || doc.document_type}</div>
                                        <div class="text-sm text-gray-500">${doc.original_filename} (${doc.file_size_human})</div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full ${statusColors[doc.status]}">${doc.status}</span>
                                        <button onclick="previewDocument(${doc.id})" class="text-blue-400 hover:text-blue-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        <a href="/document/${doc.id}/download" class="text-amber-400 hover:text-amber-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            `).join('') : '<p class="text-gray-500 text-center py-4">Aucun document visa uploadé</p>'}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-700/50">
                        <a href="/student-applications/${app.id}/download-all" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-yellow-600 text-black font-bold rounded-xl hover:from-amber-400 hover:to-yellow-500 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Télécharger tout (ZIP)
                        </a>
                        <button onclick="editComplementary(${app.id})" class="px-6 py-3 bg-purple-500/20 text-purple-400 rounded-xl hover:bg-purple-500/30 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Éditer Complémentaire
                        </button>
                        <button onclick="closeDetailsModal()" class="px-6 py-3 bg-gray-700 text-gray-300 rounded-xl hover:bg-gray-600 transition-all">
                            Fermer
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('details-content').innerHTML = content;
            document.getElementById('details-modal').classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            showToast('Erreur lors du chargement', 'error');
        }
    }

    function closeDetailsModal() {
        document.getElementById('details-modal').classList.add('hidden');
    }

    async function editComplementary(id) {
        try {
            const response = await fetch(`/admin/api/student-applications/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            const app = data.application;

            document.getElementById('comp-app-id').value = app.id;
            document.getElementById('comp-visa').value = app.visa_current || '';
            document.getElementById('comp-numero').value = app.numero_chinois || '';
            document.getElementById('comp-university').value = app.university_name || '';
            document.getElementById('comp-field').value = app.field_of_study || '';
            document.getElementById('comp-casier').checked = app.casier_judiciaire_valide || false;
            document.getElementById('comp-notes').value = app.complement_application || '';
            document.getElementById('comp-status').value = app.complementary_status || 'not_started';

            document.getElementById('complementary-modal').classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            showToast('Erreur lors du chargement', 'error');
        }
    }

    function closeComplementaryModal() {
        document.getElementById('complementary-modal').classList.add('hidden');
    }

    async function saveComplementary(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const id = formData.get('application_id');
        const data = {
            visa_current: formData.get('visa_current'),
            numero_chinois: formData.get('numero_chinois'),
            university_name: formData.get('university_name'),
            field_of_study: formData.get('field_of_study'),
            casier_judiciaire_valide: formData.get('casier_judiciaire_valide') === 'on',
            complement_application: formData.get('complement_application'),
            complementary_status: formData.get('complementary_status')
        };

        try {
            const response = await fetch(`/admin/api/student-applications/${id}/complementary`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                closeComplementaryModal();
                loadStats();
                loadApplications();
                showToast('Dossier complémentaire mis à jour');
            } else {
                showToast('Erreur lors de la mise à jour', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Une erreur est survenue', 'error');
        }
    }

    function previewDocument(documentId) {
        const previewContent = document.getElementById('preview-content');
        const previewUrl = `/document/${documentId}/preview`;

        fetch(previewUrl)
            .then(response => response.blob())
            .then(blob => {
                const url = URL.createObjectURL(blob);
                const mimeType = blob.type;

                if (mimeType === 'application/pdf') {
                    previewContent.innerHTML = `<iframe src="${url}" class="w-full h-full" frameborder="0"></iframe>`;
                } else if (mimeType.startsWith('image/')) {
                    previewContent.innerHTML = `<img src="${url}" class="max-w-full max-h-full object-contain" alt="Preview">`;
                }

                document.getElementById('preview-modal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Impossible de prévisualiser', 'error');
            });
    }

    function closePreview() {
        document.getElementById('preview-modal').classList.add('hidden');
        document.getElementById('preview-content').innerHTML = '';
    }

    async function deleteApplication(id) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer ce dossier? Cette action est irréversible.')) return;

        try {
            const response = await fetch(`/admin/api/student-applications/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });

            if (response.ok) {
                loadStats();
                loadApplications();
                showToast('Dossier supprimé');
            } else {
                showToast('Erreur lors de la suppression', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Une erreur est survenue', 'error');
        }
    }

    function showLinkForApp(appId, link) {
        if (link && link !== 'null' && link !== 'undefined') {
            document.getElementById('student-form-url').value = link;
            document.getElementById('link-expiry-info').innerHTML = `<button onclick="regenerateToken(${appId})" class="text-amber-400 hover:text-amber-300 underline">Régénérer le lien</button>`;
            document.getElementById('link-modal').classList.remove('hidden');
        } else {
            // Generate token if not exists
            regenerateToken(appId);
        }
    }
</script>
@endsection

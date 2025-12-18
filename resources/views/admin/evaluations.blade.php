@extends('admin.layout')

@section('title', 'Gestion des évaluations')
@section('page-title', 'Évaluations')
@section('page-description', 'Gérez les évaluations des collaborateurs accompagnés')

@section('content')
<!-- Modal de détail -->
<div id="detail-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDetailModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl my-8 max-h-[90vh] overflow-y-auto">
            <div id="detail-content">
                <!-- Contenu chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeConfirmModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
            <div class="pt-6 pb-4 text-center">
                <div id="confirm-icon" class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4"></div>
                <h3 id="confirm-title" class="text-xl font-bold text-gray-900 mb-2"></h3>
                <p id="confirm-message" class="text-gray-600 text-sm px-6"></p>
            </div>
            <div class="flex gap-3 p-5 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors">
                    Annuler
                </button>
                <button id="confirm-button" onclick="executeConfirmAction()" class="flex-1 px-4 py-3 text-white font-semibold rounded-xl transition-colors">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast notification -->
<div id="toast" class="fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300">
    <div class="bg-white rounded-xl shadow-2xl border border-gray-200 p-4 flex items-center gap-3 min-w-[300px]">
        <div id="toast-icon" class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"></div>
        <div class="flex-1">
            <p id="toast-title" class="font-semibold text-gray-900 text-sm"></p>
            <p id="toast-message" class="text-gray-600 text-xs"></p>
        </div>
        <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900" id="stat-total">0</p>
                <p class="text-xs text-gray-500">Total</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900" id="stat-pending">0</p>
                <p class="text-xs text-gray-500">En attente</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900" id="stat-verified">0</p>
                <p class="text-xs text-gray-500">Vérifiées</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900" id="stat-rating">0</p>
                <p class="text-xs text-gray-500">Note moyenne</p>
            </div>
        </div>
    </div>
</div>

<!-- Tabs -->
<div class="mb-4 sm:mb-6">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto">
            <button onclick="switchTab('all')" id="tab-all" class="tab-button border-emerald-600 text-emerald-600 whitespace-nowrap py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Toutes
            </button>
            <button onclick="switchTab('pending')" id="tab-pending" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm flex items-center gap-1 sm:gap-2">
                En attente
                <span id="pending-count" class="bg-amber-100 text-amber-800 py-0.5 px-1.5 sm:px-2.5 rounded-full text-[10px] sm:text-xs font-medium">0</span>
            </button>
            <button onclick="switchTab('verified')" id="tab-verified" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Vérifiées
            </button>
            <button onclick="switchTab('featured')" id="tab-featured" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Mises en avant
            </button>
        </nav>
    </div>
</div>

<!-- Loading State -->
<div id="loading" class="text-center py-8 sm:py-12 bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200">
    <div class="inline-block animate-spin rounded-full h-6 w-6 sm:h-8 sm:w-8 border-b-2 border-emerald-600"></div>
    <p class="mt-2 text-gray-600 text-sm">Chargement...</p>
</div>

<!-- Error State -->
<div id="error" class="hidden bg-red-50 border border-red-200 text-red-800 px-3 sm:px-4 py-2 sm:py-3 rounded-lg text-sm mb-4 sm:mb-6">
    <p id="error-message"></p>
</div>

<!-- Evaluations List -->
<div id="evaluations-list" class="hidden space-y-3 sm:space-y-4">
    <!-- Evaluations will be inserted here -->
</div>

<!-- Empty State -->
<div id="empty-state" class="hidden text-center py-8 sm:py-12 bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200">
    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune évaluation</h3>
    <p class="mt-1 text-xs sm:text-sm text-gray-500" id="empty-message"></p>
</div>

<style>
    .tab-button { transition: all 0.2s; }
    .tab-button.border-emerald-600 { border-bottom-color: #059669; color: #059669; }
</style>
@endsection

@section('scripts')
<!-- html2pdf.js - Modern HTML to PDF conversion -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    let currentTab = 'all';
    let pendingAction = null;
    let pendingId = null;
    let currentEvaluationData = null;

    // Load stats
    async function loadStats() {
        try {
            const response = await fetch('/api/admin/evaluations/stats', {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            if (response.ok) {
                const result = await response.json();
                const data = result.data;
                document.getElementById('stat-total').textContent = data.total || 0;
                document.getElementById('stat-pending').textContent = data.pending || 0;
                document.getElementById('stat-verified').textContent = data.verified || 0;
                document.getElementById('stat-rating').textContent = data.average_rating || '0';
                document.getElementById('pending-count').textContent = data.pending || 0;
            }
        } catch (e) {
            console.error('Stats error:', e);
        }
    }

    // Switch tabs
    function switchTab(tab) {
        currentTab = tab;
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-emerald-600', 'text-emerald-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        const activeTab = document.getElementById(`tab-${tab}`);
        activeTab.classList.remove('border-transparent', 'text-gray-500');
        activeTab.classList.add('border-emerald-600', 'text-emerald-600');
        loadEvaluations();
    }

    // Load evaluations
    async function loadEvaluations() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const listEl = document.getElementById('evaluations-list');
        const emptyEl = document.getElementById('empty-state');

        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
        listEl.classList.add('hidden');
        emptyEl.classList.add('hidden');

        try {
            let endpoint = '/api/admin/evaluations';
            if (currentTab === 'pending') endpoint = '/api/admin/evaluations/pending';
            else if (currentTab === 'verified') endpoint = '/api/admin/evaluations?verified=1';
            else if (currentTab === 'featured') endpoint = '/api/admin/evaluations?featured=1';

            const response = await fetch(endpoint, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur ' + response.status);
            }

            const result = await response.json();
            const evaluations = result.data?.data || result.data || [];

            loadingEl.classList.add('hidden');

            if (!evaluations || evaluations.length === 0) {
                emptyEl.classList.remove('hidden');
                document.getElementById('empty-message').textContent = getEmptyMessage();
            } else {
                listEl.classList.remove('hidden');
                renderEvaluations(evaluations);
            }
        } catch (error) {
            console.error('LoadEvaluations Error:', error);
            loadingEl.classList.add('hidden');
            errorEl.classList.remove('hidden');
            document.getElementById('error-message').textContent = error.message || 'Une erreur est survenue';
        }
    }

    function getEmptyMessage() {
        const messages = {
            'all': 'Aucune évaluation trouvée',
            'pending': 'Aucune évaluation en attente de vérification',
            'verified': 'Aucune évaluation vérifiée',
            'featured': 'Aucune évaluation mise en avant'
        };
        return messages[currentTab] || 'Aucune évaluation';
    }

    // Render evaluations
    function renderEvaluations(evaluations) {
        const listEl = document.getElementById('evaluations-list');
        listEl.innerHTML = evaluations.map(e => {
            const firstName = e.first_name || '';
            const lastName = e.last_name || '';
            const initials = (firstName.charAt(0) || '?') + (lastName.charAt(0) || '?');
            return `
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <!-- Header -->
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-lg">${initials}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 text-base">${firstName} ${lastName}</h3>
                                <p class="text-sm text-gray-600">${e.university || '-'}</p>
                                <p class="text-xs text-gray-500">${e.email || '-'}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <div class="flex gap-0.5">
                                    ${[1,2,3,4,5].map(i => `<svg class="w-4 h-4 ${i <= e.rating ? 'text-amber-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`).join('')}
                                </div>
                                ${e.signature ? '<span class="text-[10px] text-emerald-600 font-medium flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>Signé</span>' : ''}
                            </div>
                        </div>

                        <!-- Info pills -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium">${e.country_of_study}</span>
                            <span class="px-2 py-1 bg-purple-50 text-purple-700 rounded-lg text-xs font-medium">${getStudyLevelLabel(e.study_level)}</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium">${e.field_of_study}</span>
                            <span class="px-2 py-1 ${e.would_recommend ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'} rounded-lg text-xs font-medium">
                                ${e.would_recommend ? '👍 Recommande' : '👎 Ne recommande pas'}
                            </span>
                        </div>

                        <!-- Source -->
                        <div class="text-xs text-gray-500 mb-2">
                            <span class="font-medium">Source:</span> ${getDiscoverySourceLabel(e.discovery_source)}
                            ${e.discovery_source_detail ? `(${e.discovery_source_detail})` : ''}
                        </div>

                        <!-- Story excerpt -->
                        <p class="text-sm text-gray-700 line-clamp-2 mb-3">${e.project_story}</p>

                        <!-- Status badges -->
                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="px-2 py-1 rounded-full font-medium ${e.is_verified ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'}">
                                ${e.is_verified ? '✓ Vérifié' : '⏳ En attente'}
                            </span>
                            ${e.is_featured ? '<span class="px-2 py-1 rounded-full font-medium bg-yellow-100 text-yellow-800">⭐ Mis en avant</span>' : ''}
                            ${e.allow_public_display ? '<span class="px-2 py-1 rounded-full font-medium bg-blue-100 text-blue-800">📢 Public</span>' : ''}
                            <span class="text-gray-400">${formatDate(e.created_at)}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex lg:flex-col gap-2 pt-3 lg:pt-0 border-t lg:border-t-0 border-gray-100">
                        <button onclick="viewDetail(${e.id})" class="flex-1 lg:flex-none px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-xs font-medium">
                            Détails
                        </button>
                        ${!e.is_verified ? `
                            <button onclick="showConfirmModal('verify', ${e.id})" class="flex-1 lg:flex-none px-3 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-xs font-medium">
                                Vérifier
                            </button>
                        ` : `
                            <button onclick="showConfirmModal('unverify', ${e.id})" class="flex-1 lg:flex-none px-3 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors text-xs font-medium">
                                Retirer
                            </button>
                        `}
                        <button onclick="showConfirmModal('featured', ${e.id})" class="flex-1 lg:flex-none px-3 py-2 ${e.is_featured ? 'bg-yellow-100 text-yellow-800' : 'bg-yellow-500 text-white'} rounded-lg hover:opacity-90 transition-colors text-xs font-medium">
                            ${e.is_featured ? 'Retirer ⭐' : 'Mettre ⭐'}
                        </button>
                        <button onclick="showConfirmModal('delete', ${e.id})" class="flex-1 lg:flex-none px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-xs font-medium">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        `}).join('');
    }

    // View detail
    async function viewDetail(id) {
        try {
            const response = await fetch(`/api/admin/evaluations/${id}`, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) throw new Error('Erreur');
            const result = await response.json();
            const e = result.data;
            currentEvaluationData = e; // Store for PDF export

            document.getElementById('detail-content').innerHTML = `
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="text-2xl font-bold">${e.first_name.charAt(0)}${e.last_name.charAt(0)}</span>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">${e.first_name} ${e.last_name}</h2>
                                <p class="text-white/80">${e.email}</p>
                                ${e.phone ? `<p class="text-white/80 text-sm">${e.phone}</p>` : ''}
                            </div>
                        </div>
                        <button onclick="closeDetailModal()" class="text-white/80 hover:text-white p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Parcours académique -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            Parcours académique
                        </h3>
                        <div class="grid grid-cols-2 gap-4 bg-gray-50 rounded-xl p-4">
                            <div><span class="text-xs text-gray-500">Université</span><p class="font-medium text-sm">${e.university}</p></div>
                            <div><span class="text-xs text-gray-500">Pays</span><p class="font-medium text-sm">${e.country_of_study}</p></div>
                            <div><span class="text-xs text-gray-500">Niveau</span><p class="font-medium text-sm">${getStudyLevelLabel(e.study_level)}</p></div>
                            <div><span class="text-xs text-gray-500">Filière</span><p class="font-medium text-sm">${e.field_of_study}</p></div>
                            ${e.start_year ? `<div><span class="text-xs text-gray-500">Année de début</span><p class="font-medium text-sm">${e.start_year}</p></div>` : ''}
                            <div><span class="text-xs text-gray-500">Service</span><p class="font-medium text-sm">${getServiceLabel(e.service_used)}</p></div>
                        </div>
                    </div>

                    <!-- Histoire du projet -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-3">Comment avez-vous réalisé votre projet ?</h3>
                        <p class="text-sm text-gray-700 bg-blue-50 rounded-xl p-4">${e.project_story}</p>
                    </div>

                    <!-- Source de découverte -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-2">Comment avez-vous connu Travel Express ?</h3>
                        <p class="text-sm text-gray-700">${getDiscoverySourceLabel(e.discovery_source)} ${e.discovery_source_detail ? `(${e.discovery_source_detail})` : ''}</p>
                    </div>

                    <!-- Notes -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-3">Évaluations</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                            <div class="bg-amber-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-gray-500 mb-1">Globale</p>
                                <div class="flex justify-center gap-0.5">
                                    ${[1,2,3,4,5].map(i => `<svg class="w-4 h-4 ${i <= e.rating ? 'text-amber-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`).join('')}
                                </div>
                            </div>
                            ${e.rating_accompagnement ? `<div class="bg-gray-50 rounded-xl p-3 text-center"><p class="text-xs text-gray-500 mb-1">Accompagnement</p><p class="font-bold text-lg">${e.rating_accompagnement}/5</p></div>` : ''}
                            ${e.rating_communication ? `<div class="bg-gray-50 rounded-xl p-3 text-center"><p class="text-xs text-gray-500 mb-1">Communication</p><p class="font-bold text-lg">${e.rating_communication}/5</p></div>` : ''}
                            ${e.rating_delais ? `<div class="bg-gray-50 rounded-xl p-3 text-center"><p class="text-xs text-gray-500 mb-1">Délais</p><p class="font-bold text-lg">${e.rating_delais}/5</p></div>` : ''}
                            ${e.rating_rapport_qualite_prix ? `<div class="bg-gray-50 rounded-xl p-3 text-center"><p class="text-xs text-gray-500 mb-1">Qualité/Prix</p><p class="font-bold text-lg">${e.rating_rapport_qualite_prix}/5</p></div>` : ''}
                        </div>
                    </div>

                    <!-- Commentaire -->
                    ${e.comment ? `
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-2">Commentaire</h3>
                        <p class="text-sm text-gray-700 bg-gray-50 rounded-xl p-4">${e.comment}</p>
                    </div>
                    ` : ''}

                    <!-- Témoignage public -->
                    ${e.public_testimonial ? `
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-2">Témoignage public</h3>
                        <p class="text-sm text-gray-700 bg-emerald-50 rounded-xl p-4">${e.public_testimonial}</p>
                        <div class="flex gap-4 mt-2 text-xs">
                            <span class="${e.allow_public_display ? 'text-emerald-600' : 'text-gray-400'}">
                                ${e.allow_public_display ? '✓' : '✗'} Affichage autorisé
                            </span>
                            <span class="${e.allow_photo_display ? 'text-emerald-600' : 'text-gray-400'}">
                                ${e.allow_photo_display ? '✓' : '✗'} Photo autorisée
                            </span>
                        </div>
                    </div>
                    ` : ''}

                    <!-- Signature -->
                    ${e.signature ? `
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            Signature
                        </h3>
                        <div class="bg-amber-50 rounded-xl p-6 border-2 border-dashed border-amber-200">
                            <img src="${e.signature}" alt="Signature" class="max-h-32 w-auto mx-auto" style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                        </div>
                        ${e.signed_at ? `<p class="text-xs text-gray-500 mt-2">Signé le ${formatDate(e.signed_at)}</p>` : ''}
                    </div>
                    ` : ''}

                    <!-- Statut -->
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                        <span class="px-3 py-1.5 rounded-full text-xs font-medium ${e.is_verified ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'}">
                            ${e.is_verified ? '✓ Vérifié' : '⏳ En attente de vérification'}
                        </span>
                        ${e.is_featured ? '<span class="px-3 py-1.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">⭐ Mis en avant</span>' : ''}
                        <span class="px-3 py-1.5 rounded-full text-xs font-medium ${e.would_recommend ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800'}">
                            ${e.would_recommend ? '👍 Recommande Travel Express' : '👎 Ne recommande pas'}
                        </span>
                    </div>

                    <!-- Export PDF Button -->
                    <div class="pt-4 border-t border-gray-100">
                        <button onclick="exportPDF(${e.id})" class="w-full px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Exporter en PDF
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('detail-modal').classList.remove('hidden');
        } catch (error) {
            showToast('error', 'Erreur', 'Impossible de charger les détails');
        }
    }

    function closeDetailModal() {
        document.getElementById('detail-modal').classList.add('hidden');
    }

    // Confirmation modal
    function showConfirmModal(type, id) {
        pendingAction = type;
        pendingId = id;

        const modal = document.getElementById('confirm-modal');
        const iconEl = document.getElementById('confirm-icon');
        const titleEl = document.getElementById('confirm-title');
        const messageEl = document.getElementById('confirm-message');
        const buttonEl = document.getElementById('confirm-button');

        if (type === 'verify') {
            iconEl.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-emerald-100';
            iconEl.innerHTML = '<svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            titleEl.textContent = 'Vérifier cette évaluation ?';
            messageEl.textContent = 'Cette évaluation sera marquée comme vérifiée.';
            buttonEl.className = 'flex-1 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-colors';
            buttonEl.textContent = 'Vérifier';
        } else if (type === 'unverify') {
            iconEl.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-amber-100';
            iconEl.innerHTML = '<svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
            titleEl.textContent = 'Retirer la vérification ?';
            messageEl.textContent = 'Cette évaluation ne sera plus marquée comme vérifiée.';
            buttonEl.className = 'flex-1 px-4 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-xl transition-colors';
            buttonEl.textContent = 'Retirer';
        } else if (type === 'featured') {
            iconEl.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-yellow-100';
            iconEl.innerHTML = '<svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
            titleEl.textContent = 'Modifier la mise en avant ?';
            messageEl.textContent = 'Le statut de mise en avant sera modifié.';
            buttonEl.className = 'flex-1 px-4 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-xl transition-colors';
            buttonEl.textContent = 'Modifier';
        } else if (type === 'delete') {
            iconEl.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-red-100';
            iconEl.innerHTML = '<svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>';
            titleEl.textContent = 'Supprimer cette évaluation ?';
            messageEl.textContent = 'Cette action est irréversible.';
            buttonEl.className = 'flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-colors';
            buttonEl.textContent = 'Supprimer';
        }

        modal.classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
        pendingAction = null;
        pendingId = null;
    }

    async function executeConfirmAction() {
        if (!pendingAction || !pendingId) return;
        closeConfirmModal();

        const action = pendingAction;
        const id = pendingId;

        try {
            let endpoint = '';
            let method = 'POST';
            if (action === 'verify') endpoint = `/api/admin/evaluations/${id}/verify`;
            else if (action === 'unverify') endpoint = `/api/admin/evaluations/${id}/unverify`;
            else if (action === 'featured') endpoint = `/api/admin/evaluations/${id}/toggle-featured`;
            else if (action === 'delete') { endpoint = `/api/admin/evaluations/${id}`; method = 'DELETE'; }

            const response = await fetch(endpoint, {
                method: method,
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Une erreur est survenue');

            const messages = {
                'verify': ['Évaluation vérifiée', 'L\'évaluation a été vérifiée avec succès.'],
                'unverify': ['Vérification retirée', 'L\'évaluation n\'est plus vérifiée.'],
                'featured': ['Statut modifié', 'Le statut de mise en avant a été modifié.'],
                'delete': ['Évaluation supprimée', 'L\'évaluation a été supprimée.']
            };

            showToast('success', messages[action][0], messages[action][1]);
            loadEvaluations();
            loadStats();
        } catch (error) {
            showToast('error', 'Erreur', error.message);
        }
    }

    // Toast
    function showToast(type, title, message) {
        const toast = document.getElementById('toast');
        const iconEl = document.getElementById('toast-icon');
        document.getElementById('toast-title').textContent = title;
        document.getElementById('toast-message').textContent = message;

        if (type === 'success') {
            iconEl.className = 'w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 bg-emerald-100';
            iconEl.innerHTML = '<svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        } else {
            iconEl.className = 'w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 bg-red-100';
            iconEl.innerHTML = '<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
        }

        toast.classList.remove('translate-x-full');
        setTimeout(() => hideToast(), 4000);
    }

    function hideToast() {
        document.getElementById('toast').classList.add('translate-x-full');
    }

    function showError(message) {
        const errorEl = document.getElementById('error');
        document.getElementById('error-message').textContent = message;
        errorEl.classList.remove('hidden');
        setTimeout(() => errorEl.classList.add('hidden'), 5000);
    }

    // Helpers
    function getStudyLevelLabel(level) {
        const labels = {
            'licence_1': 'Licence 1', 'licence_2': 'Licence 2', 'licence_3': 'Licence 3',
            'master_1': 'Master 1', 'master_2': 'Master 2', 'doctorat': 'Doctorat',
            'formation_professionnelle': 'Formation pro', 'autre': 'Autre'
        };
        return labels[level] || level;
    }

    function getDiscoverySourceLabel(source) {
        const labels = {
            'ambassadeur_la_bobolaise': '👩‍💼 La Bobolaise', 'ambassadeur_ley_ley': '👨‍💼 Ley Ley',
            'ambassadeur_autre': '🤝 Autre ambassadeur', 'facebook': '📘 Facebook',
            'tiktok': '🎵 TikTok', 'instagram': '📸 Instagram', 'youtube': '▶️ YouTube',
            'bouche_a_oreille': '🗣️ Bouche à oreille', 'site_web': '🌐 Site web',
            'evenement': '📅 Événement', 'autre': '❓ Autre'
        };
        return labels[source] || source;
    }

    function getServiceLabel(service) {
        const labels = {
            'etudes': 'Études', 'business': 'Business', 'tourisme': 'Tourisme',
            'visa_seul': 'Visa seul', 'autre': 'Autre'
        };
        return labels[service] || service;
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        return date.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    function formatDateLong(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        return date.toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }

    // Export PDF Function - Modern HTML2PDF with Montserrat
    async function exportPDF(id) {
        if (!window.html2pdf) {
            showToast('error', 'Erreur', 'La bibliothèque PDF n\'est pas encore chargée. Réessayez.');
            return;
        }

        let e = currentEvaluationData;
        if (!e || e.id !== id) {
            try {
                const response = await fetch(`/api/admin/evaluations/${id}`, {
                    headers: { 'Authorization': `Bearer ${authToken}`, 'Accept': 'application/json' }
                });
                if (!response.ok) throw new Error('Erreur');
                const result = await response.json();
                e = result.data;
            } catch (error) {
                showToast('error', 'Erreur', 'Impossible de charger les données');
                return;
            }
        }

        showToast('success', 'Génération PDF', 'Création du document en cours...');

        // Build ratings HTML
        const ratingsData = [
            ['Accompagnement', e.rating_accompagnement],
            ['Communication', e.rating_communication],
            ['Délais', e.rating_delais],
            ['Qualité/Prix', e.rating_rapport_qualite_prix]
        ].filter(r => r[1]);

        const ratingsHTML = ratingsData.map(([label, val]) => `
            <div style="text-align: center; flex: 1;">
                <div style="font-size: 9px; color: #6b7280; margin-bottom: 6px;">${label}</div>
                <div style="background: #e5e7eb; border-radius: 10px; height: 6px; margin: 0 10px;">
                    <div style="background: linear-gradient(90deg, #10b981, #059669); height: 6px; border-radius: 10px; width: ${(val/5)*100}%;"></div>
                </div>
                <div style="font-size: 14px; font-weight: 700; color: #111827; margin-top: 6px;">${val}/5</div>
            </div>
        `).join('');

        // Generate stars
        const stars = Array(5).fill(0).map((_, i) =>
            `<span style="color: ${i < e.rating ? '#fbbf24' : '#d1d5db'}; font-size: 16px;">★</span>`
        ).join('');

        // Truncate story
        let story = e.project_story || '';
        if (story.length > 500) story = story.substring(0, 497) + '...';

        // Source label clean
        const srcClean = getDiscoverySourceLabel(e.discovery_source).replace(/[^\w\s\-àâäéèêëïîôùûüçÀÂÄÉÈÊËÏÎÔÙÛÜÇ\']/g, '').trim();

        // Create the HTML template
        const htmlContent = `
        <div id="pdf-content" style="font-family: 'Montserrat', sans-serif; width: 210mm; min-height: 297mm; padding: 0; margin: 0; background: #fff; color: #111827; position: relative; box-sizing: border-box;">
            <!-- Google Font -->
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

            <!-- Top accent bar -->
            <div style="height: 5px; background: linear-gradient(90deg, #10b981, #059669);"></div>

            <!-- Header -->
            <div style="padding: 20px 28px 16px; display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #e5e7eb;">
                <div>
                    <img src="/images/logo/logo_travel.png" alt="Travel Express" style="height: 45px; margin-bottom: 4px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div style="display: none; font-size: 22px; font-weight: 700; color: #059669;">TRAVEL <span style="color: #111827;">EXPRESS</span></div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 10px; color: #9ca3af; letter-spacing: 1px; text-transform: uppercase;">Fiche d'Évaluation</div>
                    <div style="font-size: 20px; font-weight: 700; color: #111827; margin-top: 2px;">#${String(e.id).padStart(4, '0')}</div>
                </div>
            </div>

            <!-- Main Info Section -->
            <div style="padding: 24px 28px; display: flex; gap: 24px;">
                <!-- Left: Personal Info -->
                <div style="flex: 1;">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 20px;">
                            ${(e.first_name?.charAt(0) || '?')}${(e.last_name?.charAt(0) || '?')}
                        </div>
                        <div>
                            <div style="font-size: 22px; font-weight: 700; color: #111827;">${e.first_name} ${e.last_name}</div>
                            <div style="font-size: 12px; color: #6b7280;">${e.email}</div>
                            ${e.phone ? `<div style="font-size: 11px; color: #9ca3af;">${e.phone}</div>` : ''}
                        </div>
                    </div>

                    <!-- Info Grid -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div>
                            <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Université</div>
                            <div style="font-size: 12px; font-weight: 600; color: #111827;">${e.university || '—'}</div>
                        </div>
                        <div>
                            <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Pays d'études</div>
                            <div style="font-size: 12px; font-weight: 600; color: #111827;">${e.country_of_study || '—'}</div>
                        </div>
                        <div>
                            <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Niveau</div>
                            <div style="font-size: 12px; font-weight: 600; color: #111827;">${getStudyLevelLabel(e.study_level)}</div>
                        </div>
                        <div>
                            <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Filière</div>
                            <div style="font-size: 12px; font-weight: 600; color: #111827;">${e.field_of_study || '—'}</div>
                        </div>
                        <div>
                            <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Service</div>
                            <div style="font-size: 12px; font-weight: 600; color: #111827;">${getServiceLabel(e.service_used)}</div>
                        </div>
                        <div>
                            <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Source</div>
                            <div style="font-size: 12px; font-weight: 600; color: #111827;">${srcClean}</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Rating Card -->
                <div style="width: 140px; background: linear-gradient(135deg, #f0fdf4, #ecfdf5); border-radius: 16px; padding: 20px; text-align: center; border: 1px solid #d1fae5;">
                    <div style="font-size: 9px; color: #059669; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 8px;">Note Globale</div>
                    <div style="font-size: 48px; font-weight: 700; color: #059669; line-height: 1;">${e.rating}</div>
                    <div style="font-size: 14px; color: #10b981; margin-top: -4px;">/5</div>
                    <div style="margin-top: 8px;">${stars}</div>
                    <div style="margin-top: 12px; padding: 6px 12px; border-radius: 20px; font-size: 9px; font-weight: 600; ${e.would_recommend ? 'background: #dcfce7; color: #166534;' : 'background: #fee2e2; color: #991b1b;'}">
                        ${e.would_recommend ? '✓ Recommande' : '✗ Ne recommande pas'}
                    </div>
                </div>
            </div>

            <!-- Ratings Bar -->
            ${ratingsData.length > 0 ? `
            <div style="margin: 0 28px 20px; padding: 16px; background: #f9fafb; border-radius: 12px; display: flex; gap: 8px;">
                ${ratingsHTML}
            </div>
            ` : ''}

            <!-- Testimonial Section -->
            <div style="margin: 0 28px 20px; padding: 20px; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; position: relative;">
                <div style="position: absolute; top: 12px; left: 16px; font-size: 48px; color: #e5e7eb; font-family: Georgia, serif; line-height: 1;">"</div>
                <div style="font-size: 10px; color: #059669; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 12px; padding-left: 28px;">Témoignage</div>
                <div style="font-size: 11px; color: #374151; line-height: 1.6; padding-left: 28px;">${story}</div>
            </div>

            <!-- Comment if exists -->
            ${e.comment ? `
            <div style="margin: 0 28px 20px; padding: 16px; background: #fefce8; border-radius: 12px; border-left: 4px solid #eab308;">
                <div style="font-size: 10px; color: #a16207; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 8px;">Commentaire</div>
                <div style="font-size: 11px; color: #713f12; line-height: 1.5; font-style: italic;">${e.comment.length > 200 ? e.comment.substring(0, 197) + '...' : e.comment}</div>
            </div>
            ` : ''}

            <!-- Signature & Verification Row -->
            <div style="margin: 0 28px; display: flex; gap: 20px; align-items: flex-start;">
                <!-- Signature -->
                <div style="flex: 1; padding: 16px; background: #f9fafb; border-radius: 12px; border: 1px dashed #d1d5db;">
                    <div style="font-size: 9px; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Signature</div>
                    ${e.signature ? `<img src="${e.signature}" style="max-height: 50px; max-width: 100%;">` : '<div style="color: #d1d5db; font-size: 11px;">Non signée</div>'}
                    ${e.signed_at ? `<div style="font-size: 9px; color: #9ca3af; margin-top: 6px;">Signé le ${formatDate(e.signed_at)}</div>` : ''}
                </div>

                <!-- Verification Status -->
                <div style="width: 140px; text-align: center;">
                    ${e.is_verified ? `
                    <div style="padding: 12px; background: #dcfce7; border-radius: 12px; border: 2px solid #22c55e;">
                        <div style="font-size: 24px; color: #22c55e;">✓</div>
                        <div style="font-size: 11px; font-weight: 700; color: #166534;">VÉRIFIÉ</div>
                        ${e.verified_at ? `<div style="font-size: 9px; color: #15803d; margin-top: 4px;">${formatDate(e.verified_at)}</div>` : ''}
                    </div>
                    ` : `
                    <div style="padding: 12px; background: #fef3c7; border-radius: 12px; border: 2px solid #f59e0b;">
                        <div style="font-size: 24px; color: #f59e0b;">⏳</div>
                        <div style="font-size: 11px; font-weight: 700; color: #92400e;">EN ATTENTE</div>
                    </div>
                    `}
                </div>
            </div>

            <!-- Footer -->
            <div style="position: absolute; bottom: 0; left: 0; right: 0;">
                <div style="padding: 12px 28px; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 9px; color: #9ca3af;">
                        Évaluation du ${formatDate(e.created_at)} • Réf: EVAL-${String(e.id).padStart(4, '0')}
                    </div>
                    ${e.is_featured ? `<div style="padding: 4px 10px; background: linear-gradient(90deg, #fbbf24, #f59e0b); border-radius: 12px; font-size: 9px; font-weight: 600; color: white;">★ EN VEDETTE</div>` : ''}
                </div>
                <div style="padding: 10px 28px; background: linear-gradient(90deg, #10b981, #059669); color: white; font-size: 10px; text-align: center;">
                    Travel Express SARL • Burkina Faso • www.travelexpress.bf • contact@travelexpress.bf
                </div>
            </div>
        </div>
        `;

        // Create temporary container
        const container = document.createElement('div');
        container.innerHTML = htmlContent;
        container.style.position = 'absolute';
        container.style.left = '-9999px';
        container.style.top = '0';
        document.body.appendChild(container);

        // Get the actual content element
        const pdfContent = container.querySelector('#pdf-content');
        if (!pdfContent) {
            showToast('error', 'Erreur', 'Impossible de générer le contenu PDF');
            document.body.removeChild(container);
            return;
        }

        // Wait for fonts to load
        await document.fonts.ready;
        await new Promise(resolve => setTimeout(resolve, 500));

        // PDF options
        const opt = {
            margin: 0,
            filename: `TravelExpress_Evaluation_${e.first_name}_${e.last_name}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2,
                useCORS: true,
                letterRendering: true,
                logging: false,
                allowTaint: true
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        try {
            await html2pdf().set(opt).from(pdfContent).save();
            showToast('success', 'PDF téléchargé', 'Document créé avec succès');
        } catch (err) {
            console.error('PDF Error:', err);
            showToast('error', 'Erreur', 'Impossible de générer le PDF');
        } finally {
            document.body.removeChild(container);
        }
    }

    // Initialize
    loadStats();
    loadEvaluations();
</script>
@endsection

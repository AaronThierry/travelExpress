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
<div class="grid grid-cols-2 gap-4 mb-6">
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

<script>
    const authToken = localStorage.getItem('auth_token');
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
                document.getElementById('stat-rating').textContent = data.average_rating || '0';
            }
        } catch (e) {
            console.error('Stats error:', e);
        }
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
            const response = await fetch('/api/admin/evaluations', {
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
                        <button onclick="viewDetail(${e.id})" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Détails
                        </button>
                        <button onclick="showConfirmModal('delete', ${e.id})" class="flex-1 px-4 py-2.5 bg-rose-600 text-white rounded-lg hover:bg-rose-700 transition-colors text-sm font-medium flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
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

                        <!-- Ambassador Details -->
                        ${(e.discovery_source === 'ambassadeur_la_bobolaise' || e.discovery_source === 'ambassadeur_ley_ley' || e.discovery_source === 'ambassadeur_autre') ? `
                            <div class="mt-4 space-y-3">
                                ${e.ambassador_direct_contact !== null ? `
                                    <div class="bg-gradient-to-r from-[#d4af37]/10 to-amber-50 rounded-xl p-4 border border-[#d4af37]/30">
                                        <p class="text-xs text-gray-600 mb-1">Mise en relation directe par l'ambassadeur :</p>
                                        <p class="font-semibold text-sm ${e.ambassador_direct_contact ? 'text-emerald-600' : 'text-gray-600'}">
                                            ${e.ambassador_direct_contact ? '✅ Oui' : '❌ Non'}
                                        </p>
                                    </div>
                                ` : ''}

                                ${e.conversation_screenshots && e.conversation_screenshots.length > 0 ? `
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <h4 class="text-xs font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Captures d'écran de conversation (${e.conversation_screenshots.length})
                                        </h4>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                            ${e.conversation_screenshots.map(screenshot => `
                                                <a href="/storage/${screenshot}" target="_blank" class="group relative aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-[#d4af37] transition-all cursor-pointer shadow-sm hover:shadow-lg">
                                                    <img src="/storage/${screenshot}" alt="Capture d'écran" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                        </svg>
                                                    </div>
                                                </a>
                                            `).join('')}
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        ` : ''}
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
                        <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            Signature
                        </h3>
                        <div class="bg-white rounded-xl p-4 border-2 border-[#0a0a0a] shadow-sm">
                            <div class="bg-gradient-to-b from-gray-50 to-white rounded-lg p-4 min-h-[120px] flex items-center justify-center">
                                <img src="${e.signature}" alt="Signature" class="max-h-28 w-auto" style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                            </div>
                            <div class="mt-3 pt-3 border-t-2 border-[#d4af37]">
                                <p class="text-center text-xs text-gray-600 font-medium">${e.first_name} ${e.last_name}</p>
                            </div>
                        </div>
                        ${e.signed_at ? `<p class="text-xs text-gray-500 mt-2 text-center">Signé le ${formatDate(e.signed_at)}</p>` : ''}
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

                    <!-- Action Buttons -->
                    <div class="pt-4 border-t border-gray-100 space-y-3">
                        <button onclick="exportPDF(${e.id})" class="w-full px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Exporter en PDF
                        </button>
                        <button onclick="showConfirmModal('delete', ${e.id}); closeDetailModal();" class="w-full px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-700 text-white font-semibold rounded-xl hover:from-rose-700 hover:to-rose-800 transition-all flex items-center justify-center gap-2 shadow-lg hover:shadow-rose-500/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer
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

            const headers = {
                'Authorization': `Bearer ${authToken}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            };

            // For DELETE method, we need to use POST with _method override
            let fetchMethod = method;
            let fetchBody = null;
            if (method === 'DELETE') {
                fetchMethod = 'POST';
                headers['X-HTTP-Method-Override'] = 'DELETE';
            }

            const response = await fetch(endpoint, {
                method: fetchMethod,
                headers: headers,
                body: fetchBody
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
            'siao': '🏢 SIAO',
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

    // Export PDF Function - Using Puppeteer (server-side)
    async function exportPDF(id) {
        showToast('success', 'Génération PDF', 'Création du document en cours...');

        try {
            const response = await fetch(`/api/admin/evaluations/${id}/pdf`, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.message || 'Erreur lors de la génération');
            }

            const result = await response.json();

            if (result.success && result.data.pdf) {
                // Convert base64 to blob and download
                const byteCharacters = atob(result.data.pdf);
                const byteNumbers = new Array(byteCharacters.length);
                for (let i = 0; i < byteCharacters.length; i++) {
                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                }
                const byteArray = new Uint8Array(byteNumbers);
                const blob = new Blob([byteArray], { type: 'application/pdf' });

                // Create download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = result.data.filename || `evaluation_${id}.pdf`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                showToast('success', 'PDF téléchargé', `${result.data.filename} créé avec succès`);
            } else {
                throw new Error('Données PDF invalides');
            }
        } catch (error) {
            console.error('PDF Export Error:', error);
            showToast('error', 'Erreur', error.message || 'Impossible de générer le PDF');
        }
    }

    // Initialize
    loadStats();
    loadEvaluations();
</script>
@endsection

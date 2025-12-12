@extends('admin.layout')

@section('title', 'Gestion des témoignages')
@section('page-title', 'Témoignages')
@section('page-description', 'Gérez et validez les témoignages des utilisateurs')

@section('content')
<!-- Tabs -->
<div class="mb-4 sm:mb-6">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto">
            <button onclick="switchTab('all')" id="tab-all" class="tab-button border-primary-600 text-primary-600 whitespace-nowrap py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm">
                Tous
            </button>
            <button onclick="switchTab('pending')" id="tab-pending" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 sm:py-4 px-1 border-b-2 font-medium text-xs sm:text-sm flex items-center gap-1 sm:gap-2">
                En attente
                <span id="pending-count" class="bg-yellow-100 text-yellow-800 py-0.5 px-1.5 sm:px-2.5 rounded-full text-[10px] sm:text-xs font-medium">0</span>
            </button>
        </nav>
    </div>
</div>

<!-- Loading State -->
<div id="loading" class="text-center py-8 sm:py-12 bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200">
    <div class="inline-block animate-spin rounded-full h-6 w-6 sm:h-8 sm:w-8 border-b-2 border-primary-600"></div>
    <p class="mt-2 text-gray-600 text-sm">Chargement...</p>
</div>

<!-- Error State -->
<div id="error" class="hidden bg-red-50 border border-red-200 text-red-800 px-3 sm:px-4 py-2 sm:py-3 rounded-lg text-sm mb-4 sm:mb-6">
    <p id="error-message"></p>
</div>

<!-- Testimonials List -->
<div id="testimonials-list" class="hidden space-y-3 sm:space-y-4">
    <!-- Testimonials will be inserted here -->
</div>

<!-- Empty State -->
<div id="empty-state" class="hidden text-center py-8 sm:py-12 bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200">
    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun témoignage</h3>
    <p class="mt-1 text-xs sm:text-sm text-gray-500" id="empty-message"></p>
</div>

<style>
    .tab-button {
        transition: all 0.2s;
    }

    .tab-button.border-primary-600 {
        border-bottom-color: #4F46E5;
        color: #4F46E5;
    }
</style>
@endsection

@section('scripts')
<script>
    let currentTab = 'all';

    // Switch tabs
    function switchTab(tab) {
        currentTab = tab;

        // Update tab styles
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-primary-600', 'text-primary-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });

        const activeTab = document.getElementById(`tab-${tab}`);
        activeTab.classList.remove('border-transparent', 'text-gray-500');
        activeTab.classList.add('border-primary-600', 'text-primary-600');

        // Load testimonials
        loadTestimonials();
    }

    // Load testimonials
    async function loadTestimonials() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const listEl = document.getElementById('testimonials-list');
        const emptyEl = document.getElementById('empty-state');

        // Show loading
        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
        listEl.classList.add('hidden');
        emptyEl.classList.add('hidden');

        try {
            const endpoint = currentTab === 'pending' ? '/api/admin/testimonials/pending' : '/api/admin/testimonials';
            const response = await fetch(endpoint, {
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors du chargement des témoignages');
            }

            const result = await response.json();
            const testimonials = result.data;

            // Update pending count
            const pendingCount = testimonials.filter(t => !t.is_approved).length;
            document.getElementById('pending-count').textContent = pendingCount;

            loadingEl.classList.add('hidden');

            if (testimonials.length === 0) {
                emptyEl.classList.remove('hidden');
                document.getElementById('empty-message').textContent =
                    currentTab === 'pending' ? 'Aucun témoignage en attente' : 'Aucun témoignage trouvé';
            } else {
                listEl.classList.remove('hidden');
                renderTestimonials(testimonials);
            }
        } catch (error) {
            console.error('Error:', error);
            loadingEl.classList.add('hidden');
            showError(error.message);
        }
    }

    // Render testimonials
    function renderTestimonials(testimonials) {
        const listEl = document.getElementById('testimonials-list');
        listEl.innerHTML = testimonials.map(t => `
            <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200 p-3 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <span class="text-white font-bold text-sm sm:text-lg">${t.user.name.charAt(0).toUpperCase()}</span>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">${t.user.name}</h3>
                                <p class="text-xs sm:text-sm text-gray-600 truncate">${t.user.position || ''} ${t.user.country ? '• ' + t.user.country : ''}</p>
                                <p class="text-[10px] sm:text-xs text-gray-500 truncate">${t.user.email}</p>
                            </div>
                            <!-- Stars on mobile -->
                            <div class="flex sm:hidden gap-0.5 flex-shrink-0">
                                ${Array(5).fill(0).map((_, i) => `
                                    <svg class="w-3 h-3 ${i < t.rating ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                `).join('')}
                            </div>
                        </div>

                        <div class="mb-2 sm:mb-3">
                            <div class="hidden sm:flex items-center gap-2 mb-2">
                                <div class="flex">
                                    ${Array(5).fill(0).map((_, i) => `
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ${i < t.rating ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    `).join('')}
                                </div>
                                ${t.destination ? `<span class="text-xs sm:text-sm text-gray-600">• ${t.destination}</span>` : ''}
                            </div>
                            <p class="text-gray-700 text-xs sm:text-sm line-clamp-3">${t.content}</p>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm">
                            <span class="text-gray-500">${t.created_at}</span>
                            <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-[10px] sm:text-xs font-medium ${t.is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${t.is_approved ? 'Approuvé' : 'En attente'}
                            </span>
                        </div>
                    </div>

                    <div class="flex sm:flex-col gap-2 pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100">
                        ${!t.is_approved ? `
                            <button onclick="approveTestimonial(${t.id})" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-xs sm:text-sm font-medium">
                                Approuver
                            </button>
                            <button onclick="rejectTestimonial(${t.id})" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-xs sm:text-sm font-medium">
                                Rejeter
                            </button>
                        ` : `
                            <button onclick="unapproveTestimonial(${t.id})" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors text-xs sm:text-sm font-medium">
                                Désapprouver
                            </button>
                        `}
                    </div>
                </div>
            </div>
        `).join('');
    }

    // Approve testimonial
    async function approveTestimonial(id) {
        if (!confirm('Voulez-vous approuver ce témoignage ?')) return;

        try {
            const response = await fetch(`/api/admin/testimonials/${id}/approve`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors de l\'approbation');
            }

            loadTestimonials();
        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    // Reject testimonial
    async function rejectTestimonial(id) {
        if (!confirm('Voulez-vous rejeter et supprimer ce témoignage ? Cette action est irréversible.')) return;

        try {
            const response = await fetch(`/api/admin/testimonials/${id}/reject`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors du rejet');
            }

            loadTestimonials();
        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    // Unapprove testimonial
    async function unapproveTestimonial(id) {
        if (!confirm('Voulez-vous désapprouver ce témoignage ?')) return;

        try {
            const response = await fetch(`/api/admin/testimonials/${id}/unapprove`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${authToken}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Erreur lors de la désapprobation');
            }

            loadTestimonials();
        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    // Show error
    function showError(message) {
        const errorEl = document.getElementById('error');
        const errorMessageEl = document.getElementById('error-message');
        errorMessageEl.textContent = message;
        errorEl.classList.remove('hidden');

        setTimeout(() => {
            errorEl.classList.add('hidden');
        }, 5000);
    }

    // Initialize
    loadTestimonials();
</script>
@endsection

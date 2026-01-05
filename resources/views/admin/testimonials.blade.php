@extends('admin.layout')

@section('title', 'Gestion des temoignages')
@section('page-title', 'Temoignages')

@push('styles')
<style>
    .tab-btn {
        position: relative;
        transition: all 0.3s ease;
    }

    .tab-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 3px 3px 0 0;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .tab-btn.active::after {
        transform: scaleX(1);
    }

    .tab-btn.active {
        color: #6366f1;
    }

    .testimonial-card {
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-slide-in {
        animation: slideIn 0.4s ease-out forwards;
    }
</style>
@endpush

@section('content')
<!-- Modal de confirmation -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeConfirmModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all scale-95 opacity-0" id="modal-content">
            <div class="pt-8 pb-6 text-center">
                <div id="confirm-icon" class="mx-auto w-20 h-20 rounded-full flex items-center justify-center mb-5 shadow-lg"></div>
                <h3 id="confirm-title" class="text-xl font-bold text-slate-900 mb-2"></h3>
                <p id="confirm-message" class="text-slate-500 text-sm px-8"></p>
            </div>
            <div class="flex gap-3 p-5 border-t border-slate-100 bg-slate-50 rounded-b-2xl">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-3 border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-100 transition-colors">
                    Annuler
                </button>
                <button id="confirm-button" onclick="executeConfirmAction()" class="flex-1 px-4 py-3 text-white font-semibold rounded-xl transition-all shadow-lg">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Header with Tabs -->
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Gestion des temoignages</h2>
            <p class="text-slate-500 mt-1">Moderez et gerez les avis de vos clients</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-slate-500">Total:</span>
            <span id="total-count" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">0</span>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex gap-1 p-1 bg-slate-100 rounded-xl w-fit">
        <button onclick="switchTab('all')" id="tab-all" class="tab-btn active px-6 py-3 rounded-lg font-semibold text-sm transition-all bg-white shadow-sm text-indigo-600">
            Tous les temoignages
        </button>
        <button onclick="switchTab('pending')" id="tab-pending" class="tab-btn px-6 py-3 rounded-lg font-semibold text-sm transition-all text-slate-600 hover:text-slate-900 flex items-center gap-2">
            En attente
            <span id="pending-count" class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full text-xs font-bold">0</span>
        </button>
    </div>
</div>

<!-- Loading State -->
<div id="loading" class="flex flex-col items-center justify-center py-20">
    <div class="relative">
        <div class="w-16 h-16 border-4 border-slate-100 rounded-full"></div>
        <div class="w-16 h-16 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin absolute top-0"></div>
    </div>
    <p class="mt-6 text-slate-500 font-medium">Chargement des temoignages...</p>
</div>

<!-- Error State -->
<div id="error" class="hidden">
    <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p id="error-message" class="text-red-600 font-medium"></p>
        <button onclick="loadTestimonials()" class="mt-4 px-6 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
            Reessayer
        </button>
    </div>
</div>

<!-- Testimonials List -->
<div id="testimonials-list" class="hidden space-y-4">
    <!-- Testimonials will be inserted here -->
</div>

<!-- Empty State -->
<div id="empty-state" class="hidden">
    <div class="text-center py-20 bg-white rounded-2xl border border-slate-200 shadow-sm">
        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Aucun temoignage</h3>
        <p class="text-slate-500" id="empty-message">Les temoignages apparaitront ici</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentTab = 'all';
    let pendingAction = null;
    let pendingId = null;

    // Confirmation modal
    function showConfirmModal(type, id) {
        pendingAction = type;
        pendingId = id;

        const modal = document.getElementById('confirm-modal');
        const modalContent = document.getElementById('modal-content');
        const iconEl = document.getElementById('confirm-icon');
        const titleEl = document.getElementById('confirm-title');
        const messageEl = document.getElementById('confirm-message');
        const buttonEl = document.getElementById('confirm-button');

        const configs = {
            approve: {
                iconClass: 'bg-gradient-to-br from-emerald-400 to-teal-500',
                iconSvg: '<svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
                title: 'Approuver ce temoignage ?',
                message: 'Ce temoignage sera visible publiquement sur le site.',
                buttonClass: 'bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 shadow-emerald-500/25',
                buttonText: 'Approuver'
            },
            reject: {
                iconClass: 'bg-gradient-to-br from-red-400 to-rose-500',
                iconSvg: '<svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>',
                title: 'Rejeter ce temoignage ?',
                message: 'Ce temoignage sera definitivement supprime. Cette action est irreversible.',
                buttonClass: 'bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-red-500/25',
                buttonText: 'Rejeter et supprimer'
            },
            unapprove: {
                iconClass: 'bg-gradient-to-br from-amber-400 to-orange-500',
                iconSvg: '<svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                title: 'Desapprouver ce temoignage ?',
                message: 'Ce temoignage ne sera plus visible publiquement sur le site.',
                buttonClass: 'bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 shadow-amber-500/25',
                buttonText: 'Desapprouver'
            }
        };

        const config = configs[type];
        iconEl.className = `mx-auto w-20 h-20 rounded-full flex items-center justify-center mb-5 shadow-lg ${config.iconClass}`;
        iconEl.innerHTML = config.iconSvg;
        titleEl.textContent = config.title;
        messageEl.textContent = config.message;
        buttonEl.className = `flex-1 px-4 py-3 text-white font-semibold rounded-xl transition-all shadow-lg ${config.buttonClass}`;
        buttonEl.textContent = config.buttonText;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirm-modal');
        const modalContent = document.getElementById('modal-content');

        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            pendingAction = null;
            pendingId = null;
        }, 200);
    }

    async function executeConfirmAction() {
        if (!pendingAction || !pendingId) return;

        const action = pendingAction;
        const id = pendingId;
        closeConfirmModal();

        try {
            const endpoint = `/admin/api/testimonials/${id}/${action}`;
            await apiCall(endpoint, { method: 'POST' });

            const messages = {
                approve: 'Temoignage approuve avec succes',
                reject: 'Temoignage rejete et supprime',
                unapprove: 'Temoignage desapprouve'
            };

            showToast(messages[action], 'success');
            loadTestimonials();
        } catch (error) {
            console.error('Error:', error);
            showToast(error.message, 'error');
        }
    }

    // Switch tabs
    function switchTab(tab) {
        currentTab = tab;

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-white', 'shadow-sm', 'text-indigo-600');
            btn.classList.add('text-slate-600');
        });

        const activeTab = document.getElementById(`tab-${tab}`);
        activeTab.classList.add('active', 'bg-white', 'shadow-sm', 'text-indigo-600');
        activeTab.classList.remove('text-slate-600');

        loadTestimonials();
    }

    // Load testimonials
    async function loadTestimonials() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const listEl = document.getElementById('testimonials-list');
        const emptyEl = document.getElementById('empty-state');

        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
        listEl.classList.add('hidden');
        emptyEl.classList.add('hidden');

        try {
            const endpoint = currentTab === 'pending' ? '/admin/api/testimonials/pending' : '/admin/api/testimonials';
            const result = await apiCall(endpoint);
            const testimonials = result.data;

            // Update counts
            const allCount = currentTab === 'all' ? testimonials.length : 0;
            const pendingCount = testimonials.filter(t => !t.is_approved).length;

            document.getElementById('pending-count').textContent = pendingCount;
            if (currentTab === 'all') {
                document.getElementById('total-count').textContent = testimonials.length;
            }

            loadingEl.classList.add('hidden');

            if (testimonials.length === 0) {
                emptyEl.classList.remove('hidden');
                document.getElementById('empty-message').textContent =
                    currentTab === 'pending' ? 'Aucun temoignage en attente de moderation' : 'Aucun temoignage pour le moment';
            } else {
                listEl.classList.remove('hidden');
                renderTestimonials(testimonials);
            }
        } catch (error) {
            console.error('Error:', error);
            loadingEl.classList.add('hidden');
            errorEl.classList.remove('hidden');
            document.getElementById('error-message').textContent = error.message;
        }
    }

    // Render testimonials
    function renderTestimonials(testimonials) {
        const listEl = document.getElementById('testimonials-list');

        listEl.innerHTML = testimonials.map((t, index) => `
            <div class="testimonial-card bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-slide-in" style="animation-delay: ${index * 50}ms">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-start gap-5">
                        <!-- Avatar & User Info -->
                        <div class="flex items-start gap-4 flex-1 min-w-0">
                            <div class="flex-shrink-0">
                                ${t.user.avatar
                                    ? `<img src="/storage/${t.user.avatar}" alt="${t.user.name}" class="w-14 h-14 rounded-xl object-cover shadow-md ring-2 ring-white">`
                                    : `<div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center shadow-md ring-2 ring-white">
                                            <span class="text-white font-bold text-xl">${t.user.name.charAt(0).toUpperCase()}</span>
                                       </div>`
                                }
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <h3 class="font-bold text-slate-900 text-lg">${t.user.name}</h3>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold ${t.is_approved
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : 'bg-amber-100 text-amber-700'
                                    }">
                                        ${t.is_approved ? 'Approuve' : 'En attente'}
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500 mb-3">
                                    ${t.user.country ? `<span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>${t.user.country}</span>` : ''}
                                    ${t.destination ? `<span class="text-indigo-600 font-medium">→ ${t.destination}</span>` : ''}
                                </div>

                                <!-- Rating -->
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="flex gap-0.5">
                                        ${[1,2,3,4,5].map(star => `
                                            <svg class="w-5 h-5 ${star <= t.rating ? 'text-amber-400' : 'text-slate-200'}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        `).join('')}
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700">${t.rating}/5</span>
                                </div>

                                <!-- Content -->
                                <p class="text-slate-600 leading-relaxed">${t.content}</p>

                                <!-- Meta -->
                                <div class="flex items-center gap-4 mt-4 pt-4 border-t border-slate-100">
                                    <span class="text-sm text-slate-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        ${t.created_at}
                                    </span>
                                    <span class="text-sm text-slate-400">${t.user.email}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex lg:flex-col gap-2 pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100">
                            ${!t.is_approved ? `
                                <button onclick="showConfirmModal('approve', ${t.id})" class="flex-1 lg:flex-none px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all font-semibold text-sm shadow-lg shadow-emerald-500/25">
                                    Approuver
                                </button>
                                <button onclick="showConfirmModal('reject', ${t.id})" class="flex-1 lg:flex-none px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl hover:from-red-600 hover:to-rose-700 transition-all font-semibold text-sm shadow-lg shadow-red-500/25">
                                    Rejeter
                                </button>
                            ` : `
                                <button onclick="showConfirmModal('unapprove', ${t.id})" class="flex-1 lg:flex-none px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all font-semibold text-sm shadow-lg shadow-amber-500/25">
                                    Desapprouver
                                </button>
                            `}
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', loadTestimonials);
</script>
@endpush
